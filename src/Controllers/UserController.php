<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Image;
use Featherwebs\Mari\Requests\StoreUser;
use Featherwebs\Mari\Requests\UpdateUser;
use Featherwebs\Mari\Models\Role;
use App\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends BaseController
{
    public function api()
    {
        if (auth()->user()->isSuperAdmin()) {
            $users = User::with('roles');
        } else {
            $users = User::superAdmin(false)->with('roles');
        }

        return DataTables::of($users)->make(true);
    }

    public function index()
    {
        return view('featherwebs::admin.user.index');
    }

    public function create()
    {
        if (auth()->user()->isSuperAdmin()) {
            $roles = Role::all();
        } else {
            $roles = Role::superAdmin(false)->get();
        }

        return view('featherwebs::admin.user.create', compact('roles'));
    }

    public function store(StoreUser $request)
    {
        $user = DB::transaction(function () use ($request) {
            $user = User::create($request->data());
            if ($request->has('user.role.id')) {
                $role = Role::findOrFail($request->input('user.role.id'));
                $user->attachRole($role);
            }
            if ($request->hasFile('user.image')) {
                fw_upload_image($request->file('user.image'), $user, false);
            }

            return $user;
        });

        return redirect()
            ->route('admin.user.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "User '" . str_limit($user->name, 20) . "'" ]));
    }

    public function edit(User $user)
    {
        if (auth()->user()->isSuperAdmin()) {
            $roles = Role::all();
        } else {
            $roles = Role::superAdmin(false)->get();
        }

        $user->load('images', 'roles');

        return view('featherwebs::admin.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateUser $request, User $user)
    {
        $user = DB::transaction(function () use ($request, $user) {
            $user->update($request->data());
            if ($request->has('user.role.id')) {
                $role = Role::findOrFail($request->input('user.role.id'));
                $user->detachRoles($user->roles);
                $user->attachRole($role);
            }
            if ($request->hasFile('user.image')) {
                fw_upload_image($request->file('user.image'), $user, true, 'photo');
            } elseif ($request->has('user.image')) {
                $image = Image::find($request->input('user.image'));
                if ($image) {
                    $user->images()->detach();
                    $user->images()->save($image, [ 'slug' => 'photo' ]);
                }
            }

            return $user;
        });

        if ($request->has('user.profile')) {
            return redirect()->route('admin.profile.edit')->withSuccess(trans('messages.update_success', [ 'entity' => "Profile" ]));
        }

        return redirect()
            ->route('admin.user.edit', $user->username)
            ->withSuccess(trans('messages.update_success', [ 'entity' => "User '" . str_limit($user->name, 20) . "'" ]));
    }

    public function destroy(User $user)
    {
        $title = str_limit($user->name, 20);
        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->withSuccess(trans('messages.delete_success', [ 'entity' => "User '" . $title . "'" ]));
    }
}
