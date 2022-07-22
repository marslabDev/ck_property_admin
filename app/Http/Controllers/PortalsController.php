<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PortalsController extends Controller
{
    public function index(Request $request)
    {
        Gate::define(null, function () {
            return true;
        });

        $roles = auth()->user()->roles;

        return view('portals', compact('roles'));
    }

    public function redirect(Role $role)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/');
        }

        $permissionsArray = [];

        foreach ($role->permissions as $permissions) {
            $permissionsArray[$permissions->title][] = $role->id;
        }

        // dd($permissionsArray);

        foreach ($permissionsArray as $title => $roles) {
            Gate::define($title, function ($user) use ($roles) {
                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
            });
        }

        // dd(Gate::abilities());

        return redirect()->route('admin.home');
    }
}
