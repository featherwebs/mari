<?php

namespace Featherwebs\Mari\Controllers;

use App\Http\Controllers\Controller;
use Featherwebs\Mari\Models\Gallery;
use Featherwebs\Mari\Requests\StoreGallery;
use Featherwebs\Mari\Requests\StoreMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function api()
    {
        $gallery = Gallery::query();

        return DataTables::of($gallery)->make(true);
    }

    public function index()
    {
        $galleries = Gallery::all();

        return view('featherwebs::gallery.index', compact('galleries'));
    }

    public function store(StoreGallery $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->data();

            Gallery::create($data);
        });
    }

    public function edit(Gallery $gallery)
    {
        $medias = $gallery->images;

        return view('featherwebs::gallery.edit', compact('gallery', 'medias'));
    }

    public function storeImages(Gallery $gallery, StoreMedia $request){
        DB::transaction(function () use ($request, $gallery) {
            $file = $request->file('file');

            fw_upload_image($file, $gallery, false);
        });
    }

}
