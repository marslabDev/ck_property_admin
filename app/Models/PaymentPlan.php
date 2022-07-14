<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentPlan extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const CYCLE_BY_SELECT = [
        'DAY'   => 'Day(s)',
        'WEEK'  => 'Week(s)',
        'MONTH' => 'Month(s)',
        'YEAR'  => 'Year(s)',
    ];

    public const DUE_DAY_SELECT = [
        'MONDAY'    => 'Monday',
        'TUESDAY'   => 'Tuesday',
        'WEDNESDAY' => 'Wednesday',
        'THURSDAY'  => 'Thursday',
        'FRIDAY'    => 'Friday',
        'SATURDAY'  => 'Saturday',
        'SUNDAY'    => 'Sunday',
    ];

    public $table = 'payment_plans';

    protected $dates = [
        'due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'house_id',
        'due_date',
        'due_day',
        'recusive_payment',
        'cycle_every',
        'cycle_by',
        'no_of_cycle',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function paymentPlanHomeOwnerTransactions()
    {
        return $this->hasMany(HomeOwnerTransaction::class, 'payment_plan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function house()
    {
        return $this->belongsTo(ManageHouse::class, 'house_id');
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function payment_items()
    {
        return $this->belongsToMany(PaymentItem::class);
    }

    public function extra_charges()
    {
        return $this->belongsToMany(PaymentCharge::class);
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
