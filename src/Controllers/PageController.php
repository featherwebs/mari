<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Page;
use Illuminate\Support\Facades\DB;
use Featherwebs\Mari\Models\Setting;
use Illuminate\Support\Facades\File;
use Featherwebs\Mari\Requests\StorePage;
use Yajra\DataTables\Facades\DataTables;
use Featherwebs\Mari\Requests\UpdatePage;
use Illuminate\Routing\Controller as BaseController;

class PageController extends BaseController
{
    public function api()
    {
        $pages = Page::latest();

        return DataTables::of($pages)->make(true);
    }

    public function index()
    {
        return view('featherwebs::admin.page.index');
    }

    public function create()
    {
        $pages     = Page::whereNull('page_id')->pluck('title', 'id');
        $templates = collect(File::allFiles(resource_path('views/pages')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        });

        return view('featherwebs::admin.page.create', compact('pages', 'templates'));
    }

    public function store(StorePage $request)
    {
        $page = DB::transaction(function () use ($request) {
            $page             = Page::create($request->data());
            $page->lb_content = $request->data()['content'];
            $page->syncImages($request);

            if ($request->get('homepage', 0) == 1) {
                Setting::fetch('homepage')->update([ 'value' => $page->id ]);
            }

            return $page;
        });

        cache()->flush();

        return redirect()
            ->route('admin.page.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Page '" . str_limit($page->title, 20) . "'" ]));
    }

    public function edit(Page $page)
    {
        $page->load('images');
        $pages     = Page::whereNull('page_id')->pluck('title', 'id');
        $templates = collect(File::allFiles(resource_path('views/pages')))->map(function ($item) {
            return explode('.', $item->getFilename())[0];
        });

        return view('featherwebs::admin.page.edit', compact('page', 'pages', 'templates'));
    }

    public function update(UpdatePage $request, Page $page)
    {
        DB::transaction(function () use ($request, $page) {
            $page->update($request->data());
            $page->lb_content = $request->data()['content'];
            $page->syncImages($request);
            if ($request->get('homepage', 0) == 1) {
                Setting::fetch('homepage')->update([ 'value' => $page->id ]);
            }

            return $page;
        });

        cache()->flush();

        return redirect()
            ->route('admin.page.edit', $page->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Page '" . str_limit($page->title, 20) . "'" ]));
    }

    public function destroy(Page $page)
    {
        $title = str_limit($page->title, 20);
        $page->delete();

        cache()->flush();

        return redirect()
            ->route('admin.page.index')
            ->withSuccess(trans('messages.delete_success', [ 'entity' => "Page '" . $title . "'" ]));
    }
}
