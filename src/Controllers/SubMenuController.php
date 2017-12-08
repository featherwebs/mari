<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Requests\StoreSubMenu;
use Featherwebs\Mari\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class SubMenuController extends BaseController
{
    public function store(StoreSubMenu $request, Menu $menu)
    {
        DB::transaction(function () use ($request, $menu) {
            $menu->subMenus()->delete();
            $menu->subMenus()->insert($request->data());
        });

        return redirect()
            ->route('admin.menu.show', $menu->slug)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "Menu '" . str_limit($menu->title, 20) . "'" ]));
    }
}
