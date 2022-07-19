<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'projects';

    protected $dates = [
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'budget',
        'status_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function suppliers()
    {
        return $this->belongsToMany(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class, 'status_id');
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
