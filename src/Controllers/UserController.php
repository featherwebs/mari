<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Requests\StoreUser;
use Featherwebs\Mari\Requests\UpdateUser;
use Featherwebs\Mari\Models\Role;
use App\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::paginate(10);

        return view('featherwebs::admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('featherwebs::admin.user.create', compact('roles'));
    }

    public function store(StoreUser $request)
    {
        $user = DB::transaction(function () use ($request) {
            $user = User::create($request->data());
            $role = Role::findOrFail($request->input('role.id'));
            $user->attachRole($role);
            if ($request->hasFile('image')) {
                fw_upload_image($request->file('image'), $user);
            }

            return $user;
        });

        return redirect()
            ->route('admin.user.index')
            ->withSuccess(trans('messages.create_success', [ 'entity' => "User '" . str_limit($user->name, 20) . "'" ]));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('image', 'roles');

        return view('featherwebs::admin.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateUser $request, User $user)
    {
        $user = DB::transaction(function () use ($request, $user) {
            $user->update($request->data());
            $role = Role::findOrFail($request->input('role.id'));
            $user->detachRoles($user->roles);
            $user->attachRole($role);
            if ($request->hasFile('image')) {
                fw_upload_image($request->file('image'), $user);
            }

            return $user;
        });

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
