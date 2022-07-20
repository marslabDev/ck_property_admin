<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalsController extends Controller
{
    public function index(Request $request)
    {
        $roles = auth()->user()->roles;

        return view('portals', compact('roles'));
    }
}
