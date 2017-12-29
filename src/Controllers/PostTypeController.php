<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Requests\StorePostType;
use Featherwebs\Mari\Requests\UpdatePostType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PostTypeController extends BaseController
{
    public function api()
    {
        $postTypes = PostType::query();

        return DataTables::of($postTypes)->make(true);
    }

    public function index()
    {
        return view('featherwebs::admin.post-type.index');
    }

    public function create()
    {
        return view('featherwebs::admin.post-type.create');
    }

    public function store(StorePostType $request)
    {
        $postType = DB::transaction(function () use ($request) {
            $postType = PostType::create($request->data());

            return $postType;
        });

        return redirect()
            ->route('admin.post-type.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Post '" . str_limit($postType->title, 20) . "'" ]));
    }

    public function edit(PostType $postType)
    {
        return view('featherwebs::admin.post-type.edit', compact('postType'));
    }

    public function update(UpdatePostType $request, PostType $postType)
    {
        $postType = DB::transaction(function () use ($request, $postType) {
            $postType->update($request->data());

            return $postType;
        });

        return redirect()
            ->route('admin.post-type.edit', $postType->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Post '" . str_limit($postType->title, 20) . "'" ]));
    }

    public function destroy(PostType $postType)
    {
        $title = $postType->title;

        $postType->delete();

        return redirect()
            ->route('admin.post-type.index')
            ->withSuccess(trans('messages.delete_success', [ 'entity' => "Post type '" . $title . "'" ]));
    }
}
