<?php

namespace Featherwebs\Mari\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProfileController extends BaseController
{
    public function edit()
    {
        $user = auth()->user();

        return view('featherwebs::admin.profile.edit', compact('user'));
    }
}
