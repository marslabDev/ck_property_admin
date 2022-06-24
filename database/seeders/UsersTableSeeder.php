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
                'verified_at'        => '2022-06-24 07:49:33',
                'username'           => '',
                'phone_no'           => '',
                'card_no'            => '',
                'gender'             => '',
                'city'               => '',
                'state'              => '',
                'country'            => '',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
