<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintanance extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'maintanances';

    protected $dates = [
        'date_maintanance',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type_id',
        'date_maintanance',
        'area_id',
        'handle_by_id',
        'supplier_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(MaintananceType::class, 'type_id');
    }

    public function getDateMaintananceAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateMaintananceAttribute($value)
    {
        $this->attributes['date_maintanance'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function handle_by()
    {
        return $this->belongsTo(User::class, 'handle_by_id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
