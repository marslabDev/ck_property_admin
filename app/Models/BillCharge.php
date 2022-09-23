<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillCharge extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        'FIXED'   => 'Fixed Rate',
        'PERCENT' => 'Percentage',
    ];

    public $table = 'bill_charges';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'rate',
        'from_area_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function billChargesBills()
    {
        return $this->belongsToMany(Bill::class);
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
