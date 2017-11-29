<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Requests\StoreMenu;
use Featherwebs\Mari\Requests\UpdateMenu;
use Featherwebs\Mari\Models\Menu;
use Featherwebs\Mari\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class MenuController extends BaseController
{
    public function index()
    {
        $menus = Menu::all();

        return view('featherwebs::admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('featherwebs::admin.menu.create');
    }

    public function store(StoreMenu $request)
    {
        $menu = DB::transaction(function () use ($request) {
            return Menu::create($request->data());
        });

        return redirect()->route('admin.menu.index')->withSuccess(trans('messages.create_success', [ 'entity' => "Menu '" . str_limit($menu->title, 20) . "'" ]));
    }

    public function show(Menu $menu)
    {
        $menu->load('subMenus');
        $pages = Page::all()->map(function ($page) {
            if ($page->id == fw_setting('homepage'))
            {
                return [ 'title' => 'Home', 'url' => url('/') ];
            }
            else
            {
                return [ 'title' => $page->title, 'url' => $page->url ];
            }
        });

        return view('featherwebs::admin.menu.show', compact('menu', 'pages'));
    }

    public function edit(Menu $menu)
    {
        return view('featherwebs::admin.menu.edit', compact('menu'));
    }

    public function update(UpdateMenu $request, Menu $menu)
    {
        DB::transaction(function () use ($request, $menu) {
            $menu->update($request->data());
        });

        return redirect()->route('admin.menu.edit', $menu->slug)->withSuccess(trans('messages.update_success', [ 'entity' => "Menu '" . str_limit($menu->title, 20) . "'" ]));
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menu.index')->withSuccess(trans('messages.delete_success', [ 'entity' => "Menu '" . str_limit($menu->title, 20) . "'" ]));
    }
}
