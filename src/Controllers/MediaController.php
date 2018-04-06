<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Requests\StoreMedia;
use Featherwebs\Mari\Models\Image;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaController extends BaseController
{

    public function api()
    {
        return Image::latest()->get();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $medias = Image::latest()->get();

        return view('featherwebs::admin.media.index', compact('medias'));
    }

    public function store(StoreMedia $request)
    {
        $image = DB::transaction(function () use ($request) {

        });

        return $image->id;
    }

    public function show()
    {
        $images = request('image', []);
        if (count($images) > 0) {
            $medias = Image::find($images);

            return view('featherwebs::admin.media.edit', compact('medias'));
        }

        return redirect()->route('admin.media.index')->withWarning('Select one or more media first');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->input('image') as $id => $data) {
                $file  = $request->file('image.' . $id . '.image');
                $meta  = $request->input('image.' . $id . '.pivot.slug');
                $image = Image::findOrFail($id);
                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename  = $file->getClientOriginalName();
                    $data      = [
                        'custom' => [ 'title' => $filename ],
                        'meta'   => $meta,
                        'path'   => $file->storeAs('misc', str_random() . '.' . $extension, 'public'),
                        'id'     => $image->id
                    ];
                    $image->delete();
                    Image::create($data);
                } else {
                    $image->update([
                        'meta'   => $meta,
                        'custom' => $data['custom']
                    ]);
                }
            }
        });

        return back()->withSuccess(trans('messages.update_success', [ 'entity' => 'Media' ]));
    }

    public function destroy()
    {
        $ids = request('ids', []);
        if (count($ids) > 0) {
            $images = Image::whereIn('id', $ids)->get();
            foreach ($images as $image) $image->delete();

            return redirect()
                ->route('admin.media.index')
                ->withSuccess(trans('messages.delete_success', [ 'entity' => "Media" ]));
        }

        return redirect()->route('admin.media.index')->withWarning('Select one or more media first');
    }
}