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
                'title' => 'Super Admin',
                'redirect_to' => '/system',
            ],
            [
                'id'    => 2,
                'title' => 'Admin',
                'redirect_to' => '/core/select-area',
            ],
            [
                'id'    => 3,
                'title' => 'User',
                'redirect_to' => '/home',

            ],
            [
                'id' => 4,
                'title' => 'Supplier Manager',
                'redirect_to' => '/core/select-area',
            ]
        ];

        Role::insert($roles);
    }
}
