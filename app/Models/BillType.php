<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillType extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'bill_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'from_area_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function billTypeBills()
    {
        return $this->hasMany(Bill::class, 'bill_type_id', 'id');
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
