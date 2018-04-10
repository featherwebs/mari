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
            $setting = Setting::fetch($key);
            if ($setting) {
                $setting->update([ 'value' => $value ]);
            }
        }

        $logo = Setting::firstOrCreate(['slug' => 'logo'])->first();

        $path = $request->input('setting.logo');

        if ( ! empty($path)) {
            $filename = basename($path);
            $image = Image::where('path', 'like', '%'.$filename)->first();
            if($image) {
                $logo->images()->detach();
                $logo->images()->save($image, []);
            }
        }

        $item = $request->input('newsetting', []);
        if ($item) {
            Setting::create([
                'slug'  => str_slug($item['slug'], '_'),
                'value' => $item['value']
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
