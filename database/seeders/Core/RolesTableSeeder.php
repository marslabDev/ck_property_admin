<?php

namespace Database\Seeders\Core;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::truncate();

        $roles = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'redirect_to' => '/system',
            ],
            [
                'id'    => 2,
                'name' => 'Admin',
                'redirect_to' => '/core/select-area',
            ],
            [
                'id'    => 3,
                'name' => 'User',
                'redirect_to' => '/home',
            ],
            [
                'id' => 4,
                'name' => 'Supplier Manager',
                'redirect_to' => '/core/select-area',
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
