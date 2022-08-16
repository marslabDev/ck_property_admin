<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait AddAreaTrait
{
    public static function bootAddAreaTrait()
    {
        if (!app()->runningInConsole() && auth()->check()) {
            $isSuperAdmin = auth()->user()->roles->contains(1);

            static::creating(function ($model) {
                $model->from_area_id = currentArea()->id ?? 1;
            });

            if (!$isSuperAdmin) {
                static::addGlobalScope('from_area_id', function (Builder $builder) {
                    $field = sprintf('%s.%s', $builder->getQuery()->from, 'from_area_id');

                    $area_ids = auth()->user()->areas->pluck('id');

                    $builder->whereIn($field, $area_ids);
                });
            }
        }
    }
}
