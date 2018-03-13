<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Image;
use Featherwebs\Mari\Models\Page;
use Featherwebs\Mari\Requests\StorePost;
use Featherwebs\Mari\Requests\UpdatePost;
use Featherwebs\Mari\Models\Post;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Models\Tag;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Yajra\DataTables\Facades\DataTables;

class PostController extends BaseController
{
    public function api(Request $request)
    {
        $type  = PostType::whereSlug($request->get('post_type', 'news'))->first();
        $posts = Post::with('postType', 'tags', 'files');

        if ($type) {
            $posts = $posts->where('post_type_id', $type->id);
        }

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
        $posts = Post::select('post_type_id', 'id', 'title')->get()->toArray();
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
            if($request->customdata()){
                foreach($request->customData() as $customData)
                {
                    $post->custom()->create($customData);
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
        $post->load('images', 'tags', 'postType', 'custom');
        $tags      = Tag::pluck('title', 'id')->unique();
        $postTypes = PostType::all();
        $posts = Post::select('post_type_id', 'id', 'title')->get()->toArray();
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
            if($request->customdata()){
                $post->custom()->delete();
                foreach($request->customData() as $customData)
                {
                    $post->custom()->create($customData);
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
        $post->load('images', 'tags', 'postType');
        if ( ! empty($post->view) && view()->exists('posts.' . $post->view)) {
            $view = $post->view;
        }

        return view('posts.' . $view, compact('post'));
    }

    public function archive(Request $request)
    {
        $posts = Post::published()->latest();
        $title = "Posts";

        if ($request->has('q')) {
            $q     = $request->get('q');
            $posts = $posts->where(function ($query) use ($q) {
                $query->where('title', 'like', '%' . $query . '%')->orWhere('sub_title', 'like', '%' . $query . '%');
            });
        }

        if ($request->has('type')) {
            $t    = $request->get('type');
            $type = PostType::where('slug', $t)->first();
            if ($type) {
                $title = ucwords(str_plural($type->title));
                $posts = $posts->type($type->id);
            }
        }

        $posts = $posts->paginate($request->get('limit', 12))->appends($request->except('page'));

        return view()->first([
            'postTypes.' . $type->slug,
            'postTypes.default'
        ], compact('posts', 'title'));
    }
}
