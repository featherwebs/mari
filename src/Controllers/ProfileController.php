<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProfileController extends BaseController
{
    public function edit()
    {
        $user    = auth()->user()->load('images');
        $profile = true;

        return view('featherwebs::admin.user.edit', compact('user', 'profile'));
    }
}
