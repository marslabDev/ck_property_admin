<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'areas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'city',
        'postcode',
        'state',
        'country',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function areaManageHouses()
    {
        return $this->hasMany(ManageHouse::class, 'area_id', 'id');
    }

    public function areaHouseTypes()
    {
        return $this->hasMany(HouseType::class, 'area_id', 'id');
    }

    public function peopleInAreaNotices()
    {
        return $this->hasMany(Notice::class, 'people_in_area_id', 'id');
    }

    public function areaManagePrices()
    {
        return $this->hasMany(ManagePrice::class, 'area_id', 'id');
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
