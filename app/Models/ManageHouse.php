<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageHouse extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const HOUSE_STATUS_SELECT = [
        'available' => 'Available',
        'sold_out'  => 'Sold Out',
    ];

    public $table = 'manage_houses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'unit_no',
        'contact_name',
        'contact_no',
        'house_status',
        'spuare_feet',
        'parking_lot_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parking_lot()
    {
        return $this->belongsTo(ParkingLot::class, 'parking_lot_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
