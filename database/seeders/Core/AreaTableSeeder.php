<?php

namespace Database\Seeders\Core;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();

        Area::insert([
            [
                'name' => 'All Area',
                'city' => 'N/A',
                'postcode' => '0',
                'state' => 'N/A',
                'country' => 'N/A',
                'created_by_id' => '1',
                'created_at' => now(),
            ]
        ]);
    }
}
