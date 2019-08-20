<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Page;
use Featherwebs\Mari\Models\Post;
use Illuminate\Support\Facades\DB;
use Featherwebs\Mari\Models\Setting;
use Illuminate\Support\Facades\File;
use Featherwebs\Mari\Models\PageType;
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
        $posts     = Post::select('post_type_id', 'id', 'title')->get()->toArray();
        $pages     = Page::whereNull('page_id')->pluck('title', 'id');
        $pageTypes = PageType::all();

        return view('featherwebs::admin.page.create', compact('pages', 'pageTypes', 'posts'));
    }

    public function store(StorePage $request)
    {
        $page = DB::transaction(function () use ($request) {
            $page             = Page::create($request->data());
            $page->lb_content = $request->data()['content'];
            $page->save();

            if ($request->customdata()) {
                foreach ($request->customData() as $customData) {
                    $page->custom()->create($customData);
                }
            }

            if ($request->postsData()) {
                foreach ($request->postsData() as $customData) {
                    foreach ($customData['value'] as $value) {
                        $page->posts()->attach($value, [ 'slug' => $customData['slug'] ]);
                    }
                }
            }

            $page->syncImages($request);

            if ($request->get('homepage', 0) == 1) {
                Setting::fetch('homepage')->update([ 'value' => $page->id ]);
            }

            return $page;
        });

        return redirect()
            ->route('admin.page.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Page '" . str_limit($page->title, 20) . "'" ]));
    }

    public function edit(Page $page)
    {
        $page->load('images', 'pageType', 'posts', 'custom');

        $pages     = Page::whereNull('page_id')->pluck('title', 'id');
        $posts     = Post::select('post_type_id', 'id', 'title')->get()->toArray();
        $pageTypes = PageType::all();

        return view('featherwebs::admin.page.edit', compact('page', 'pages', 'pageTypes', 'posts'));
    }

    public function update(UpdatePage $request, Page $page)
    {
        DB::transaction(function () use ($request, $page) {
            $page->update($request->data());
            $page->lb_content = $request->data()['content'];
            $page->save();

            if ($request->postsData()) {
                $page->posts()->detach();
                foreach ($request->postsData() as $customData) {
                    foreach ($customData['value'] as $value) {
                        $page->posts()->attach($value, [ 'slug' => $customData['slug'] ]);
                    }
                }
            }
            if ($request->customdata()) {
                $page->custom()->delete();
                foreach ($request->customData() as $customData) {
                    $page->custom()->create($customData);
                }
            }

            $page->syncImages($request);

            if ($request->get('homepage', 0) == 1) {
                Setting::fetch('homepage')->update([ 'value' => $page->id ]);
            }

            return $page;
        });

        return redirect()
            ->route('admin.page.edit', $page->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Page '" . str_limit($page->title, 20) . "'" ]));
    }

    public function destroy(Page $page)
    {
        $title = str_limit($page->title, 20);
        $page->delete();

        return redirect()
            ->route('admin.page.index')
            ->withSuccess(trans('messages.delete_success', [ 'entity' => "Page '" . $title . "'" ]));
    }
}
