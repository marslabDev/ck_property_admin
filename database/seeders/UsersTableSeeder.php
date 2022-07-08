<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2022-07-08 03:24:29',
                'username'           => '',
                'phone_no'           => '',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
