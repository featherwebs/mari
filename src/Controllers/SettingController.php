<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Page;
use Featherwebs\Mari\Models\Setting;
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

    public function store(Request $request)
    {
        foreach ($request->get('setting', []) as $key => $value) {
            $setting = Setting::fetch($key);
            if ($setting) {
                $setting->update([ 'value' => $value ]);
            }
        }
        foreach ($request->file('setting', []) as $key => $file) {
            $setting = Setting::fetch($key)->first();
            if ($setting) {
                fw_upload_image($file, $setting);
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
