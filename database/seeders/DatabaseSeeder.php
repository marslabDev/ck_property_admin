<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call([
            Core\PermissionsTableSeeder::class,
            Core\RolesTableSeeder::class,
            Core\PermissionRoleTableSeeder::class,
            Core\UsersTableSeeder::class,
            Core\RoleUserTableSeeder::class,

            Core\AssetStatusTableSeeder::class,
            Core\TaskStatusTableSeeder::class,

            SupplierManager\PermissionsSeeder::class,
        ]);

        // $sql = file_get_contents(storage_path() . '/ck_admin.sql');
        // DB::unprepared($sql);

        Schema::enableForeignKeyConstraints();
    }
}
