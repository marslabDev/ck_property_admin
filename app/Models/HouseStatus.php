<?php

namespace App\Models;

use App\Traits\AddAreaTrait;
use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseStatus extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use AddAreaTrait;
    use Auditable;
    use HasFactory;

    public $table = 'house_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status',
        'created_at',
        'from_area_id',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function houseStatusManageHouses()
    {
        return $this->hasMany(ManageHouse::class, 'house_status_id', 'id');
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
