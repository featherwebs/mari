<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Image;
use Featherwebs\Mari\Models\Page;
use Featherwebs\Mari\Models\Setting;
use Featherwebs\Mari\Requests\StoreSettings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SettingController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::custom()->get();
        $pages    = Page::pluck('title', 'id');

        return view('featherwebs::admin.setting.index', compact('settings', 'pages'));
    }

    public function store(StoreSettings $request)
    {
        foreach ($request->get('setting', []) as $key => $value) {
            Setting::firstOrCreate([
                'slug'      => $key
            ])->update([ 'value' => $value ]);
        }

        foreach ($request->get('images', []) as $key => $path) {
            $setting = Setting::firstOrCreate([ 'slug' => $key ]);
            if ( ! empty($path)) {
                $filename = basename($path);
                $image    = Image::where('path', 'like', '%' . $filename)->first();
                if ($image) {
                    $setting->images()->detach();
                    $setting->images()->save($image, []);
                }
            }
        }

        $item = $request->input('newsetting', []);
        if ($item) {
            Setting::create([
                'slug'  => str_slug($item['title']),
                'type'  => $item['type'],
                'title' => ucwords($item['title'])
            ]);
        }

        return back()->withSuccess(trans('messages.update_success', [ 'entity' => 'Setting(s)' ]));
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return back()->withSuccess(trans('messages.delete_success', [ 'entity' => 'Setting(s)' ]));
    }
}
