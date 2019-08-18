<?php

namespace Featherwebs\Mari\Controllers;

use Illuminate\Support\Facades\File;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Models\PageType;
use Featherwebs\Mari\Requests\StorePostType;
use Featherwebs\Mari\Requests\UpdatePostType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PageTypeController extends BaseController
{
    public function api()
    {
        $pageTypes = PageType::query();

        return DataTables::of($pageTypes)->make(true);
    }

    public function index()
    {
        return view('featherwebs::admin.page-type.index');
    }

    public function create()
    {
        $postTypes = PostType::all();
        $templates = collect(File::allFiles(resource_path('views/pages')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        });

        return view('featherwebs::admin.page-type.create', compact('postTypes', 'templates'));
    }

    public function store(StorePostType $request)
    {
        $pageType = DB::transaction(function () use ($request) {
            $pageType = PageType::create($request->data());

            return $pageType;
        });

        return redirect()
            ->route('admin.page-type.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Page Type '" . str_limit($pageType->title, 20) . "'" ]));
    }

    public function edit(PageType $pageType)
    {
        $postTypes = PostType::all();
        $templates = collect(File::allFiles(resource_path('views/pages')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        });

        return view('featherwebs::admin.page-type.edit', compact('pageType', 'postTypes', 'templates'));
    }

    public function update(UpdatePostType $request, PageType $pageType)
    {
        $pageType = DB::transaction(function () use ($request, $pageType) {
            $pageType->update($request->data());

            return $pageType;
        });

        return redirect()
            ->route('admin.page-type.edit', $pageType->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Page Type '" . str_limit($pageType->title, 20) . "'" ]));
    }

    public function destroy(PageType $pageType)
    {
        $title = $pageType->title;

        $pageType->delete();

        return redirect()
            ->route('admin.page-type.index')
            ->withSuccess(trans('messages.delete_success', [ 'entity' => "Page type '" . $title . "'" ]));
    }
}
