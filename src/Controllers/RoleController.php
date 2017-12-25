<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Page;
use Featherwebs\Mari\Models\Permission;
use Featherwebs\Mari\Models\Role;
use Featherwebs\Mari\Requests\StoreRole;
use Featherwebs\Mari\Requests\UpdateRole;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends BaseController
{
    public function api()
    {
        $roles = Role::query();

        return DataTables::of($roles)->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('featherwebs::admin.role.index');
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('featherwebs::admin.role.create', compact('permissions'));
    }

    /**
     * @param StoreRole $request
     * @return mixed
     */
    public function store(StoreRole $request)
    {
        $role = DB::transaction(function () use ($request) {
            $role = Role::create($request->data());

            foreach (Permission::all() as $permission)
            {
                if ($request->has('permission.' . $permission->id))
                {
                    $role->attachPermission($permission);
                }
                else
                {
                    $role->detachPermission($permission);
                }
            }

            return $role;
        });

        return redirect()->route('admin.role.index')->withSuccess(trans('messages.create_success', [ 'entity' => "Role '" . $role->display_name . "'" ]));
    }

    public function edit(Role $role)
    {
        $role->load('perms');
        $permissions = Permission::all();

        return view('featherwebs::admin.role.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRole $request, Role $role)
    {
        $role = DB::transaction(function () use ($request, $role) {
            $role->update($request->data());

            foreach (Permission::all() as $permission)
            {
                if ($request->has('permission.' . $permission->id))
                {
                    if(!$role->hasPermission($permission->name))
                        $role->attachPermission($permission);
                }
                else
                {
                    $role->detachPermission($permission);
                }
            }

            return $role;
        });

        return redirect()->route('admin.role.edit', $role->name)->withSuccess(trans('messages.update_success', [ 'entity' => "Role '" . $role->display_name . "'" ]));
    }

    public function destroy(Role $role)
    {
        $name = $role->name;
        $role->delete();

        return redirect()->route('admin.role.index')->withSuccess(trans('messages.delete_success', [ 'entity' => "Role '" . $name . "'" ]));
    }
}
