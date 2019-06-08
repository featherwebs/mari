<?php

namespace Featherwebs\Mari\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Venturecraft\Revisionable\Revision;

class AdminController extends BaseController
{
    public function redirectToIndex()
    {
        return redirect()->route('admin.home');
    }

    public function index()
    {
        $user       = auth()->user();
        $role       = $user->roles()->first();
        $activities = Revision::latest()->paginate(10);

        if ($role) {
            return view()->first([
                'admin.' . $role->name . '.dashboard',
                'featherwebs::admin.dashboard'
            ], compact('activities'));
        }

        return view()->first([
            'featherwebs::admin.dashboard'
        ], compact('activities'));
    }
}
