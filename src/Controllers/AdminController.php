<?php

namespace Featherwebs\Mari\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Venturecraft\Revisionable\Revision;

class AdminController extends BaseController
{
    public function index()
    {
        $activities = Revision::latest()->paginate(10);

        return view('featherwebs::admin.dashboard', compact('activities'));
    }
}
