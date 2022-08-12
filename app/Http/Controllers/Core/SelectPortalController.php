<?php

namespace App\Http\Controllers\Core;


use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectPortalController extends Controller
{
    public function index(Request $request)
    {
        $roles = auth()->user()->roles;

        return view('core.selectPortal', compact('roles'));
    }

    public function redirect(Role $role)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/');
        }

        return redirect($role->redirect_to);
    }
}
