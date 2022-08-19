<?php

namespace App\Http\Controllers\Core;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SelectPortalController extends Controller
{
    public function index(Request $request)
    {
        $roles = auth()->user()->roles;
        return view('core.selectPortal', compact('roles'));
    }

    public function redirect(Role $role)
    {
        try {
            persistRole($role);
            $user = auth()->user();
            if (!$user) {
                return redirect('/');
            }
            return redirect($role->redirect_to);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
