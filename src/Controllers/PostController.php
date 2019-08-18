<?php

namespace Featherwebs\Mari\Controllers;

use Illuminate\Http\Request;
use Featherwebs\Mari\Models\Tag;
use Featherwebs\Mari\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Requests\StorePost;
use Yajra\DataTables\Facades\DataTables;
use Featherwebs\Mari\Requests\UpdatePost;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    public function __construct()
    {
    }

    public function api(Request $request)
    {
        $type  = PostType::whereSlug($request->get('post_type', 'news'))->first();
        $posts = Post::with('postType', 'posts', 'files', 'custom')->latest();

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
            'featherwebs::admin.post.index',
        ], compact('postType'));
    }

    public function create(PostType $postType)
    {
        $postTypes = PostType::all();
        $posts     = Post::select('post_type_id', 'id', 'title')->get()->toArray();
        $templates = collect(File::allFiles(resource_path('views/posts')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        })->filter(function ($item) {
            return $item != 'index';
        });

        return view('featherwebs::admin.post.create', compact('posts', 'postTypes', 'templates', 'postType', 'posts'));
    }

    public function store(StorePost $request)
    {
        $post = DB::transaction(function () use ($request) {
            $post             = Post::create($request->data());
            $post->lb_content = $request->data()['content'];
            if ($request->customdata()) {
                foreach ($request->customData() as $customData) {
                    $post->custom()->create($customData);
                }
            }

            if ($request->postsData()) {
                foreach ($request->postsData() as $customData) {
                    foreach ($customData['value'] as $value) {
                        $post->posts()->attach($value, [ 'slug' => $customData['slug'] ]);
                    }
                }
            }

            $post->syncImages($request);

            return $post;
        });

        return redirect()
            ->route('admin.post.index', [ 'post_type' => $post->postType->slug ])
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Post '" . str_limit($post->title, 20) . "'" ]));
    }

    public function edit(Post $post)
    {
        $post->load('images', 'posts', 'postType', 'custom', 'files');
        $postTypes = PostType::all();
        $posts     = Post::select('post_type_id', 'id', 'title')->get()->toArray();
        $postType  = $post->postType;
        $templates = collect(File::allFiles(resource_path('views/posts')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        });

        return view('featherwebs::admin.post.edit', compact('post', 'posts', 'postTypes', 'templates', 'postType', 'posts'));
    }

    public function update(UpdatePost $request, Post $post)
    {
        DB::transaction(function () use ($request, $post) {
            $post->update($request->data());
            $post->lb_content = $request->data()['content'];
            if ($request->customdata()) {
                $post->custom()->delete();
                foreach ($request->customData() as $customData) {
                    $post->custom()->create($customData);
                }
            }

            if ($request->postsData()) {
                $post->posts()->detach();
                foreach ($request->postsData() as $customData) {
                    foreach ($customData['value'] as $value) {
                        $post->posts()->attach($value, [ 'slug' => $customData['slug'] ]);
                    }
                }
            }

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
        $post->load('images', 'posts', 'postType', 'files');
        if ( ! empty($post->view) && view()->exists('posts.' . $post->view)) {
            $view = $post->view;
        }
        fw_init_seo($post);
        $post->visit();

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

        return view()->first([
            'postTypes.' . $view,
            'posts.index',
        ], compact('posts', 'title', 'q'));
    }

    public function showTag(Tag $tag)
    {
        return view()->first([
            'posts.tag',
            'posts.index',
        ], compact('tag'));
    }
}
