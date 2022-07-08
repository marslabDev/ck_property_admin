<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ManageHouse extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'manage_houses';

    protected $appends = [
        'documents',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'house_type_id',
        'unit_no',
        'floor',
        'block',
        'area_id',
        'street_id',
        'square_feet',
        'house_status_id',
        'contact_person_id',
        'contact_person_2_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function housePaymentPlans()
    {
        return $this->hasMany(PaymentPlan::class, 'house_id', 'id');
    }

    public function houseHomeOwnerTransactions()
    {
        return $this->hasMany(HomeOwnerTransaction::class, 'house_id', 'id');
    }

    public function house_type()
    {
        return $this->belongsTo(HouseType::class, 'house_type_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'street_id');
    }

    public function parking_lots()
    {
        return $this->belongsToMany(ParkingLot::class);
    }

    public function getDocumentsAttribute()
    {
        return $this->getMedia('documents');
    }

    public function house_status()
    {
        return $this->belongsTo(HouseStatus::class, 'house_status_id');
    }

    public function owned_bies()
    {
        return $this->belongsToMany(User::class);
    }

    public function contact_person()
    {
        return $this->belongsTo(User::class, 'contact_person_id');
    }

    public function contact_person_2()
    {
        return $this->belongsTo(User::class, 'contact_person_2_id');
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
