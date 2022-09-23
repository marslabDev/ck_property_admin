<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'bills';

    protected $dates = [
        'billing_date',
        'due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'billplz',
        'billplz_url',
        'house_id',
        'homeowner_id',
        'billing_date',
        'due_date',
        'amount',
        'bill_status_id',
        'from_area_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function billBillHistories()
    {
        return $this->hasMany(BillHistory::class, 'bill_id', 'id');
    }

    public function billBillItems()
    {
        return $this->hasMany(BillItem::class, 'bill_id', 'id');
    }

    public function house()
    {
        return $this->belongsTo(ManageHouse::class, 'house_id');
    }

    public function homeowner()
    {
        return $this->belongsTo(User::class, 'homeowner_id');
    }

    public function getBillingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBillingDateAttribute($value)
    {
        $this->attributes['billing_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function bill_items()
    {
        return $this->belongsToMany(BillItem::class);
    }

    public function bill_charges()
    {
        return $this->belongsToMany(BillCharge::class);
    }

    public function bill_status()
    {
        return $this->belongsTo(BillStatus::class, 'bill_status_id');
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
