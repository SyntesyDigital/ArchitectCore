<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Routing\Controller;
use Auth;

class ArchitectController extends Controller
{
    public function index()
    {
        if(!Auth::user()->hasRole('admin')) {
            abort(404);
        }

        return view('architect::index');
    }

    public function settings()
    {
        return view('architect::settings');
    }
}
