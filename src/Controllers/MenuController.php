<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Post;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Requests\StoreMenu;
use Featherwebs\Mari\Requests\UpdateMenu;
use Featherwebs\Mari\Models\Menu;
use Featherwebs\Mari\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends BaseController
{
    public function api()
    {
        $menus = Menu::with('subMenus');

        return DataTables::of($menus)->make(true);
    }

    public function index()
    {
        return view('featherwebs::admin.menu.index');
    }

    public function create()
    {
        $pages     = Page::all()->map(function ($page) {
            if ($page->id == fw_setting('homepage')) {
                return [ 'title' => 'Home', 'url' => url('/') ];
            } else {
                return [ 'title' => $page->title, 'url' => $page->url ];
            }
        });
        $postTypes = PostType::all();
        $posts     = Post::all();

        return view('featherwebs::admin.menu.create', compact('pages', 'posts', 'postTypes'));
    }

    public function store(StoreMenu $request)
    {
        $menu = DB::transaction(function () use ($request) {
            $menu = Menu::create($request->data());
            foreach ($request->subMenuData() as $i => $data) {
                $data['order'] = $i + 1;
                $subMenu       = $menu->subMenus()->create($data);
                if (array_key_exists('sub_menus', $data)) {
                    foreach ($data['sub_menus'] as $j => $dat) {
                        $dat['order'] = $j + 1;
                        $subSubMenu   = $subMenu->subMenus()->create($dat);
                        if (array_key_exists('sub_menus', $dat)) {
                            foreach ($dat['sub_menus'] as $k => $da) {
                                $da['order'] = $k + 1;
                                $subSubMenu->subMenus()->create($da);
                            }
                        }
                    }
                }
            }

            return $menu;
        });

        return redirect()
            ->route('admin.menu.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "Menu '" . str_limit($menu->title, 20) . "'" ]));
    }

    public function edit(Menu $menu)
    {
        $menu->load('subMenus.subMenus.subMenus.subMenus');
        $pages     = Page::all()->map(function ($page) {
            if ($page->id == fw_setting('homepage')) {
                return [ 'title' => 'Home', 'url' => url('/') ];
            } else {
                return [ 'title' => $page->title, 'url' => $page->url ];
            }
        });
        $postTypes = PostType::all();
        $posts     = Post::all();

        return view('featherwebs::admin.menu.edit', compact('menu', 'pages', 'posts', 'postTypes'));
    }

    public function update(UpdateMenu $request, Menu $menu)
    {
        DB::transaction(function () use ($request, $menu) {
            $menu->update($request->data());
            $menu->subMenus()->delete();
            foreach ($request->subMenuData() as $i => $data) {
                $data['order'] = $i + 1;
                $subMenu       = $menu->subMenus()->create($data);
                if (array_key_exists('sub_menus', $data)) {
                    foreach ($data['sub_menus'] as $j => $dat) {
                        $dat['order'] = $j + 1;
                        $subSubMenu   = $subMenu->subMenus()->create($dat);
                        if (array_key_exists('sub_menus', $dat)) {
                            foreach ($dat['sub_menus'] as $k => $da) {
                                $da['order'] = $k + 1;
                                $subSubMenu->subMenus()->create($da);
                            }
                        }
                    }
                }
            }
        });

        return redirect()
            ->route('admin.menu.edit', $menu->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Menu '" . str_limit($menu->title, 20) . "'" ]));
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()
            ->route('admin.menu.index')
            ->withSuccess(trans('messages.delete_success', [ 'entity' => "Menu '" . str_limit($menu->title, 20) . "'" ]));
    }
}
