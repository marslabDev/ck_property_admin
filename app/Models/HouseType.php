<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseType extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        'LANDED'    => 'Landed',
        'HIGH_RISE' => 'High Rise',
    ];

    public $table = 'house_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'area_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function houseTypeManageHouses()
    {
        return $this->hasMany(ManageHouse::class, 'house_type_id', 'id');
    }

    public function houseTypeManagePrices()
    {
        return $this->hasMany(ManagePrice::class, 'house_type_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
