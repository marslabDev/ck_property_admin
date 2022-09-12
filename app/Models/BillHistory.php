<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillHistory extends Model
{
    use Auditable;
    use HasFactory;

    public $table = 'bill_histories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'paid_by_id',
        'bill_id',
        'amount',
        'from_area_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function paid_by()
    {
        return $this->belongsTo(User::class, 'paid_by_id');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    public function from_area()
    {
        return $this->belongsTo(Area::class, 'from_area_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
