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
            ],
            [
                'id'    => 2,
                'title' => 'User',
            ],
            [
                'id' => 3,
                'title' => 'Supplier Manager',
            ]
        ];

        Role::upsert($roles, ['id'], ['title']);
    }
}
