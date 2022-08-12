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
                'id'    => 1,
                'title' => 'Admin',
                'redirect_to' => '/admin/select-area',
            ],
            [
                'id'    => 2,
                'title' => 'User',
                'redirect_to' => '/home',

            ],
            [
                'id' => 3,
                'title' => 'Supplier Manager',
                'redirect_to' => '/admin/select-area',
            ]
        ];

        Role::insert($roles);
    }
}
