<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentHistory extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'payment_histories';

    protected $dates = [
        'date_received',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'paid_by_id',
        'payment_type_id',
        'date_received',
        'amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function paid_by()
    {
        return $this->belongsTo(User::class, 'paid_by_id');
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function getDateReceivedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateReceivedAttribute($value)
    {
        $this->attributes['date_received'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
