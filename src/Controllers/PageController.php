<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Requests\StorePage;
use Featherwebs\Mari\Requests\UpdatePage;
use Featherwebs\Mari\Models\Page;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Yajra\DataTables\Facades\DataTables;

class PageController extends BaseController
{
    public function api()
    {
        $pages = Page::query();

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
            $page = Page::create($request->data());
            foreach ($request->get('images', []) as $k => $img)
            {
                $image = $request->file('images.' . $k . '.file');
                $meta  = $request->file('images.' . $k . '.meta');
                if ($image && $image instanceof UploadedFile)
                {
                    fw_upload_image($image, $page, $single = false, $meta);
                }
            }

            return $page;
        });

        return redirect()->route('admin.page.index')->withSuccess(trans('messages.create_success', [ 'entity' => "Page '" . str_limit($page->title, 20) . "'" ]));
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

            // Delete images marked to be deleted
            $deleted_image_ids = $request->get('deleted_image_ids');
            if ( ! empty($deleted_image_ids))
            {
                $page->images()->whereIn('id', $deleted_image_ids)->delete();
            }
            foreach ($request->get('images', []) as $k => $img)
            {
                $id    = $request->input('images.' . $k . '.image_id');
                $image = $request->file('images.' . $k . '.file');
                $meta  = $request->input('images.' . $k . '.meta');

                // if existing image update the image/meta else create a new image
                if ($id)
                {
                    if ($image && $image instanceof UploadedFile)
                    {
                        $page->images()->find($id)->delete();
                        fw_upload_image($image, $page, $single = false, $meta);
                    }
                    else
                    {
                        $page->images()->find($id)->update([ 'meta' => str_slug($meta, '_') ]);
                    }
                }
                else
                {
                    if ($image && $image instanceof UploadedFile)
                    {
                        fw_upload_image($image, $page, $single = false, $meta);
                    }
                }
            }

            return $page;
        });

        return redirect()->route('admin.page.edit', $page->slug)->withSuccess(trans('messages.update_success', [ 'entity' => "Page '" . str_limit($page->title, 20) . "'" ]));
    }

    public function destroy(Page $page)
    {
        $title = str_limit($page->title, 20);
        $page->delete();

        return redirect()->route('admin.page.index')->withSuccess(trans('messages.delete_success', [ 'entity' => "Page '" . $title . "'" ]));
    }
}
