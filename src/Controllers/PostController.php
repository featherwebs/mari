<?php

namespace Featherwebs\Mari\Controllers;

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
        $type  = PostType::whereSlug($request->get('post_type', ''))->first();
        $posts = Post::with('postType', 'tags');

        if ($type) {
            $posts = $posts->where('post_type_id', $type->id);
        }

        return DataTables::of($posts)->make(true);
    }

    public function index(Request $request)
    {
        $postType = PostType::whereSlug($request->get('post_type', ''))->first();

        return view('featherwebs::admin.post.index', compact('postType'));
    }

    public function create(Request $request)
    {
        $meta      = [];
        $pages     = Page::published()->pluck('title');
        $tags      = Tag::pluck('title', 'id')->merge($pages)->unique();
        $postTypes = PostType::all();
        $postType  = PostType::whereSlug($request->get('post_type', ''))->first();
        $templates = collect(File::allFiles(resource_path('views/posts')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        })->filter(function ($item) {
            return $item != 'index';
        });

        if ($request->has('template')) {
            $meta = fw_get_file_data(resource_path('views/posts/') . $request->get('template') . '.blade.php');
        }

        return view('featherwebs::admin.post.create', compact('tags', 'postTypes', 'templates', 'meta', 'postType'));
    }

    public function store(StorePost $request)
    {
        $post = DB::transaction(function () use ($request) {
            $post = Post::create($request->data());
            $post->syncTags($request->input('tags'));
            foreach ($request->get('images', []) as $k => $img) {
                $image = $request->file('images.' . $k . '.file');
                $meta  = $request->file('images.' . $k . '.meta');
                if ($image && $image instanceof UploadedFile) {
                    fw_upload_image($image, $post, $single = false, $meta);
                }
            }

            return $post;
        });

        return redirect()
            ->route('admin.post.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Post '" . str_limit($post->title, 20) . "'" ]));
    }

    public function edit(Post $post)
    {
        $post->load('images', 'tags', 'postType');
        $pages     = Page::published()->pluck('title');
        $tags      = Tag::pluck('title', 'id')->merge($pages)->unique();
        $postTypes = PostType::all();
        $postType  = $post->postType;
        $templates = collect(File::allFiles(resource_path('views/posts')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        });

        return view('featherwebs::admin.post.edit', compact('post', 'tags', 'postTypes', 'templates', 'postType'));
    }

    public function update(UpdatePost $request, Post $post)
    {
        DB::transaction(function () use ($request, $post) {
            $post->update($request->data());
            $post->syncTags($request->input('tags'));

            // Delete images marked to be deleted
            $deleted_image_ids = $request->get('deleted_image_ids');
            if ( ! empty($deleted_image_ids)) {
                $post->images()->whereIn('id', $deleted_image_ids)->delete();
            }
            foreach ($request->get('images', []) as $k => $img) {
                $id    = $request->input('images.' . $k . '.image_id');
                $image = $request->file('images.' . $k . '.file');
                $meta  = $request->input('images.' . $k . '.meta');

                // if existing image update the image/meta else create a new image
                if ($id) {
                    if ($image && $image instanceof UploadedFile) {
                        $post->images()->find($id)->delete();
                        fw_upload_image($image, $post, $single = false, $meta);
                    } else {
                        $post->images()->find($id)->update([ 'meta' => str_slug($meta, '_') ]);
                    }
                } else {
                    if ($image && $image instanceof UploadedFile) {
                        fw_upload_image($image, $post, $single = false, $meta);
                    }
                }
            }

            return $post;
        });

        return redirect()
            ->route('admin.post.edit', $post->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Post '" . str_limit($post->title, 20) . "'" ]));
    }

    public function destroy(Post $post)
    {
        $title = str_limit($post->title, 20);
        $post->delete();

        return redirect()
            ->route('admin.post.index')
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
        $posts = Post::published();
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

        return view('posts.index', compact('posts', 'title'));
    }
}
