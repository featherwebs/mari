<?php

namespace Featherwebs\Mari\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Featherwebs\Mari\Models\Post;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Models\Tag;
use Featherwebs\Mari\Requests\StorePost;
use Featherwebs\Mari\Requests\UpdatePost;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class PostController extends BaseController
{
    public function api(Request $request)
    {
        $type  = PostType::whereSlug($request->get('post_type', 'news'))->first();
        $posts = Post::with('postType', 'tags', 'files', 'custom')->latest();

        if ($type) {
            $posts->where('post_type_id', $type->id);
        }
        $posts->select('posts.*');

        return DataTables::of($posts)->make(true);
    }

    public function index(PostType $postType)
    {
        return view()->first([
            'admin.posts.' . $postType->slug . '.index',
            'featherwebs::admin.post.index'
        ], compact('postType'));
    }

    public function create(PostType $postType)
    {
        $tags      = Tag::pluck('title', 'id')->unique();
        $postTypes = PostType::all();
        $posts     = Post::select('post_type_id', 'id', 'title')->get()->toArray();
        $templates = collect(File::allFiles(resource_path('views/posts')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        })->filter(function ($item) {
            return $item != 'index';
        });

        return view('featherwebs::admin.post.create', compact('tags', 'postTypes', 'templates', 'postType', 'posts'));
    }

    public function store(StorePost $request)
    {
        $post = DB::transaction(function () use ($request) {
            $post = Post::create($request->data());
            if ($request->customdata()) {
                foreach ($request->customData() as $customData) {
                    $post->custom()->create($customData);
                }
            }

            if ($request->hasFile('post.custom.*.file')) {
                foreach ($request->input('post.custom') as $key => $custom) {
                    if ($file = $request->file('post.custom.' . $key . '.file')) {
                        fw_upload($file, $post, false, $custom['slug']);
                    }
                }
            }
            $post->syncTags($request->input('post.tags'));
            $post->syncImages($request);

            return $post;
        });

        return redirect()
            ->route('admin.post.index', [ 'post_type' => $post->postType->slug ])
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Post '" . str_limit($post->title, 20) . "'" ]));
    }

    public function edit(Post $post)
    {
        $post->load('images', 'tags', 'postType', 'custom', 'files');
        $tags      = Tag::pluck('title', 'id')->unique();
        $postTypes = PostType::all();
        $posts     = Post::select('post_type_id', 'id', 'title')->get()->toArray();
        $postType  = $post->postType;
        $templates = collect(File::allFiles(resource_path('views/posts')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        });

        return view('featherwebs::admin.post.edit', compact('post', 'tags', 'postTypes', 'templates', 'postType', 'posts'));
    }

    public function update(UpdatePost $request, Post $post)
    {
        DB::transaction(function () use ($request, $post) {
            $post->update($request->data());
            if ($request->customdata()) {
                $post->custom()->delete();
                foreach ($request->customData() as $customData) {
                    $post->custom()->create($customData);
                }
            }

            if ($request->hasFile('post.custom.*.file')) {
                foreach ($request->input('post.custom') as $key => $custom) {
                    if ($file = $request->file('post.custom.' . $key . '.file')) {
                        if ($existingFile = $post->files()->whereSlug($custom['slug'])->first()) {
                            $existingFile->delete();
                        }
                        fw_upload($file, $post, false, $custom['slug']);
                    }
                }
            }

            $post->syncTags($request->input('post.tags'));
            $post->syncImages($request);

            return $post;
        });

        return redirect()
            ->route('admin.post.edit', $post->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Post '" . str_limit($post->title, 20) . "'" ]));
    }

    public function destroy(Post $post)
    {
        $title = str_limit($post->title, 20);
        $type  = $post->postType->slug;
        $post->delete();

        return redirect()
            ->route('admin.post.index', [ 'post_type' => $type ])
            ->withSuccess(trans('messages.delete_success', [ 'entity' => "Post '" . $title . "'" ]));
    }

    public function show(Post $post)
    {
        $view = 'default';
        $post->load('images', 'tags', 'postType', 'files');
        if ( ! empty($post->view) && view()->exists('posts.' . $post->view)) {
            $view = $post->view;
        }

        $title       = current(array_filter([ $post->meta_title, $post->title, fw_setting('title') ]));
        $description = current(array_filter([
            $post->meta_description,
            str_limit(strip_tags($post->content), 200),
            fw_setting('description')
        ]));
        $images      = $post->images->push(fw_setting('logo'))->toArray();
        $keywords    = array_filter(array_merge(explode(',', $post->meta_keywords), explode(',', fw_setting('keywords'))));

        SEOMeta::setTitleDefault(fw_setting('title'))
               ->setTitle($title)
               ->setDescription($description)
               ->addMeta('article:published_time', $post->updated_at->toW3CString(), 'property')
               ->addMeta('title', $title, 'property')
               ->addKeyword($keywords);
        SEOTools::setTitle($title)->setDescription($description)->addImages($images)->setCanonical(request()->url());
        SEOTools::opengraph()
                ->setUrl(request()->url())
                ->setTitle($title)
                ->setDescription($description)
                ->addProperty('type', 'website')
                ->addProperty('locale', 'en_US')
                ->addProperty('site_name', fw_setting('title'));
        SEOTools::twitter()->setTitle($title)->setDescription($description)->addValue('card', 'summary_large_image');

        return view('posts.' . $view, compact('post'));
    }

    public function archive(Request $request)
    {
        $posts = Post::published()->latest();
        $view  = $request->get('view', 'default');
        $title = 'Posts';
        $q     = '';

        if ($request->has('q')) {
            $q     = $request->get('q');
            $posts = $posts->where(function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%')->orWhere('sub_title', 'like', '%' . $q . '%');
            });
        }

        if ($request->has('type')) {
            $posts = $posts->type($request->get('type'));
        }
        $posts = $posts->paginate($request->get('limit', 12))->appends($request->except('page'));

        $title = fw_setting('title');
        $description = fw_setting('description');
        $images = [fw_setting('logo')];
        SEOMeta::setTitleDefault($title)
               ->setTitle('Posts')
               ->setDescription($description)
               ->addMeta('title',$title, 'property')
               ->addKeyword(fw_setting('keywords'));
        SEOTools::setTitle('Posts')->setDescription($description)->addImages($images)->setCanonical(request()->url());
        SEOTools::opengraph()
                ->setUrl(request()->url())
                ->setTitle('Posts')
                ->setDescription($description)
                ->addProperty('type', 'website')
                ->addProperty('locale', 'en_US')
                ->addProperty('site_name',$title);
        SEOTools::twitter()->setTitle($title)->setDescription($description)->addValue('card', 'summary_large_image');

        return view()->first([
            'postTypes.' . $view,
            'posts.index'
        ], compact('posts', 'title', 'q'));
    }

    public function showTag(Tag $tag)
    {
        return view()->first([
            'posts.tag',
            'posts.index'
        ], compact('tag'));
    }
}
