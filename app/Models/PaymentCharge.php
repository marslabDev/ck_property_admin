<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentCharge extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        'FIXED_RATE' => 'Fixed Rate',
        'PERCENTAGE' => 'Percentage',
    ];

    public $table = 'payment_charges';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'particular',
        'type',
        'amount',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function extraChargePaymentPlans()
    {
        return $this->belongsToMany(PaymentPlan::class);
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
