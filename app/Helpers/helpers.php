<?php

use App\Models\Area;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

if (!function_exists('currentArea')) {
    function currentArea()
    {
        $area = request()->route('area');
        $type = gettype($area);

        if ($type == 'string') {
            if (!is_numeric($area)) {
                // TODO: handle exception here
                // return redirect()->route('core.select-area');
                throw new Throwable('{area} must be a number.');
            }
            $area = Area::findOrFail($area);
        }

        if ($type == 'object') {
            if (!isset($area)) {
                // TODO: handle exception here
                // return redirect()->route('core.select-area');
                throw new Throwable('{area} must be not be null.');
            }
        }

        return $area;
    }
}

if (!function_exists('persistRole')) {
    function persistRole($role)
    {
        $filename = md5(auth()->id());
        Storage::disk('persist')->put($filename, $role->toJson());
    }
}

if (!function_exists('currentRole')) {
    function currentRole()
    {
        $filename = md5(auth()->id());
        $data = Storage::disk('persist')->get($filename);
        $array = json_decode($data, true);
        return Role::findById($array['id']);
    }
}

if (!function_exists('actionDenied')) {
    function actionDenied(string|Permission $permission, Role $role = null)
    {
        if (is_null($role) || $role == null) {
            $role = currentRole();
        }
        return !$role->hasPermissionTo($permission);
    }
}

if (!function_exists('actionGranted')) {
    function actionGranted(string|Permission $permission, Role $role = null)
    {
        if (is_null($role) || $role == null) {
            $role = currentRole();
        }

        if (is_string($permission)) {
            $permission = Permission::findByName($permission);
        }

        return $role->hasPermissionTo($permission);
    }
}
