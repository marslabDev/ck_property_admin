<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingLot extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'parking_lots';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'lot_no',
        'floor',
        'house_id',
        'from_area_id',
        'created_by_id',
        'updated_at',
        'deleted_at',
    ];

    public function parkingLotManageHouses()
    {
        return $this->belongsToMany(ManageHouse::class);
    }

    public function house()
    {
        return $this->belongsTo(ManageHouse::class, 'house_id');
    }

    public function from_area()
    {
        return $this->belongsTo(Area::class, 'from_area_id');
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
