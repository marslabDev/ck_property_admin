<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use function PHPUnit\Framework\isNull;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('permit', function (string|Permission $permission, Role $role = null) {
            if (isNull($role) || $role == null) {
                $role = currentRole();
            }
            return actionGranted(Permission::findByName($permission), $role);
        });
    }
}
