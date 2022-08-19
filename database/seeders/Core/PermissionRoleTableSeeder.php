<?php

namespace Database\Seeders\Core;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::pluck('name');

        Role::findById(1)->syncPermissions($admin_permissions);
        Role::findById(2)->syncPermissions($admin_permissions);

        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission, 0, 5) != 'user_' && substr($permission, 0, 5) != 'role_' && substr($permission, 0, 11) != 'permission_';
        });

        Role::findById(3)->syncPermissions($user_permissions);
    }
}
