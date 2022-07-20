<?php

namespace Database\Seeders\Core;

use App\Models\AssetStatus;
use Illuminate\Database\Seeder;

class AssetStatusTableSeeder extends Seeder
{
    public function run()
    {
        AssetStatus::truncate();

        $assetStatuses = [
            [
                'id'         => 1,
                'name'       => 'Available',
                'created_at' => '2022-06-20 06:47:37',
                'updated_at' => '2022-06-20 06:47:37',
            ],
            [
                'id'         => 2,
                'name'       => 'Not Available',
                'created_at' => '2022-06-20 06:47:37',
                'updated_at' => '2022-06-20 06:47:37',
            ],
            [
                'id'         => 3,
                'name'       => 'Broken',
                'created_at' => '2022-06-20 06:47:37',
                'updated_at' => '2022-06-20 06:47:37',
            ],
            [
                'id'         => 4,
                'name'       => 'Out for Repair',
                'created_at' => '2022-06-20 06:47:37',
                'updated_at' => '2022-06-20 06:47:37',
            ],
        ];

        AssetStatus::insert($assetStatuses);
    }
}
