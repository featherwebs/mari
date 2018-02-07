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
        $templates = collect(File::allFiles(resource_path('views/posts')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        })->filter(function ($item) {
            return $item != 'index';
        });

        return view('featherwebs::admin.post.create', compact('tags', 'postTypes', 'templates', 'postType'));
    }

    public function store(StorePost $request)
    {
        $post = DB::transaction(function () use ($request) {
            $post = Post::create($request->data());
            $post->syncTags($request->input('post.tags'));
            foreach ($request->input('post.images', []) as $k => $img) {
                $id    = $request->input('post.images.' . $k . '.id');
                $image = $request->file('post.images.' . $k . '.file');
                $slug  = $request->input('post.images.' . $k . '.pivot.slug');
                if ($image && $image instanceof UploadedFile) {
                    fw_upload_image($image, $post, $single = false, $slug);
                } elseif ($id) {
                    $image = Image::find($id);
                    if ($image) {
                        $post->images()->save($image, [ 'slug' => $slug ]);
                    }
                }
            }

            return $post;
        });

        return redirect()
            ->route('admin.post.index', [ 'post_type' => $post->postType->slug ])
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Post '" . str_limit($post->title, 20) . "'" ]));
    }

    public function edit(Post $post)
    {
        $post->load('images', 'tags', 'postType');
        $tags      = Tag::pluck('title', 'id')->unique();
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
            $post->syncTags($request->input('post.tags'));

            // Delete images marked to be deleted
            $deleted_image_ids = $request->input('post.deleted_image_ids');
            if ( ! empty($deleted_image_ids)) {
                $post->images()->whereIn('id', $deleted_image_ids)->detach();
            }
            foreach ($request->input('post.images', []) as $k => $img) {
                $id       = $request->input('post.images.' . $k . '.id'); // new image id
                $image_id = $request->input('post.images.' . $k . '.image_id'); // existing image id
                $image    = $request->file('post.images.' . $k . '.file'); // file
                $slug     = $request->input('post.images.' . $k . '.pivot.slug'); // slug

                // if existing image update the image/slug else create a new image
                if ($image_id) {
                    if ($image && $image instanceof UploadedFile) {
                        $img = Image::find($image_id);
                        if ($img) {
                            $post->images()->detach($img);
                        }
                        fw_upload_image($image, $post, $single = false, $slug);
                    } elseif ($id) {
                        $image = Image::find($image_id);
                        $post->images()->detach($image);
                        $image = Image::find($id);
                        $post->images()->save($image, [ 'slug' => str_slug($slug, '_') ]);
                    } else {
                        $post->images()->find($image_id)->pivot->update([ 'slug' => str_slug($slug, '_') ]);
                    }
                } else {
                    if ($image && $image instanceof UploadedFile) {
                        fw_upload_image($image, $post, $single = false, $slug);
                    } elseif ($id) {
                        $image = Image::find($id);
                        $post->images()->save($image, [ 'slug' => str_slug($slug, '_') ]);
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
