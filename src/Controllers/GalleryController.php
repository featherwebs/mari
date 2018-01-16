<?php

namespace Featherwebs\Mari\Controllers;

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

        return view('gallery.index', compact('galleries'));
    }

    public function store(StoreGallery $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->data();
            $data['user_id'] = auth()->user()->id;
            Gallery::create($data);
        });
    }

    public function edit(Gallery $gallery)
    {
        $medias = $gallery->images;
        return view('gallery.edit', compact('gallery', 'medias'));
    }

    public function storeImages(Gallery $gallery, StoreMedia $request){
        DB::transaction(function () use ($request, $gallery) {
            $file = $request->file('file');

            $extension = $file->getClientOriginalExtension();
            $filename  = $file->getClientOriginalName();
            $data      = [
                'custom' => [ 'title' => $filename ],
                'path'   => $file->storeAs('misc', str_random() . '.' . $extension, 'public')
            ];

            $gallery->images()->create($data);
        });
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
