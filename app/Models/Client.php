<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'person_in_change',
        'company',
        'desc',
        'email',
        'phone',
        'website',
        'whatapps',
        'country',
        'status_id',
        'from_area_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function supplierTransactions()
    {
        return $this->hasMany(Transaction::class, 'supplier_id', 'id');
    }

    public function supplierProjects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'status_id');
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
