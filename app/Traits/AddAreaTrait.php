<?php

namespace App\Traits;


trait AddAreaTrait
{
    public static function bootAddAreaTrait()
    {
        if (!app()->runningInConsole() && auth()->check()) {
            static::creating(function ($model) {
                $model->from_area_id = currentArea()->id;
            });
        }
    }
}
