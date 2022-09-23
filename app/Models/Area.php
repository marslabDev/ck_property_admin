<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'areas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'city',
        'postcode',
        'state',
        'country',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function peopleInAreaNotices()
    {
        return $this->hasMany(Notice::class, 'people_in_area_id', 'id');
    }

    public function fromAreaMyCases()
    {
        return $this->hasMany(MyCase::class, 'from_area_id', 'id');
    }

    public function fromAreaComplaints()
    {
        return $this->hasMany(Complaint::class, 'from_area_id', 'id');
    }

    public function fromAreaParkingLots()
    {
        return $this->hasMany(ParkingLot::class, 'from_area_id', 'id');
    }

    public function fromAreaManageHouses()
    {
        return $this->hasMany(ManageHouse::class, 'from_area_id', 'id');
    }

    public function fromAreaHouseTypes()
    {
        return $this->hasMany(HouseType::class, 'from_area_id', 'id');
    }

    public function fromAreaStreets()
    {
        return $this->hasMany(Street::class, 'from_area_id', 'id');
    }

    public function fromAreaManagePrices()
    {
        return $this->hasMany(ManagePrice::class, 'from_area_id', 'id');
    }

    public function fromAreaHouseStatuses()
    {
        return $this->hasMany(HouseStatus::class, 'from_area_id', 'id');
    }

    public function fromAreaCaseStatuses()
    {
        return $this->hasMany(CaseStatus::class, 'from_area_id', 'id');
    }

    public function fromAreaCasesCategories()
    {
        return $this->hasMany(CasesCategory::class, 'from_area_id', 'id');
    }

    public function fromAreaComplaintStatuses()
    {
        return $this->hasMany(ComplaintStatus::class, 'from_area_id', 'id');
    }

    public function fromAreaClients()
    {
        return $this->hasMany(Client::class, 'from_area_id', 'id');
    }

    public function fromAreaProjects()
    {
        return $this->hasMany(Project::class, 'from_area_id', 'id');
    }

    public function fromAreaOpenProjects()
    {
        return $this->hasMany(OpenProject::class, 'from_area_id', 'id');
    }

    public function fromAreaNotes()
    {
        return $this->hasMany(Note::class, 'from_area_id', 'id');
    }

    public function fromAreaTransactions()
    {
        return $this->hasMany(Transaction::class, 'from_area_id', 'id');
    }

    public function fromAreaDocuments()
    {
        return $this->hasMany(Document::class, 'from_area_id', 'id');
    }

    public function fromAreaTaskStatuses()
    {
        return $this->hasMany(TaskStatus::class, 'from_area_id', 'id');
    }

    public function fromAreaTaskTags()
    {
        return $this->hasMany(TaskTag::class, 'from_area_id', 'id');
    }

    public function fromAreaTasks()
    {
        return $this->hasMany(Task::class, 'from_area_id', 'id');
    }

    public function fromAreaTransactionTypes()
    {
        return $this->hasMany(TransactionType::class, 'from_area_id', 'id');
    }

    public function fromAreaClientStatuses()
    {
        return $this->hasMany(ClientStatus::class, 'from_area_id', 'id');
    }

    public function fromAreaPaymentItems()
    {
        return $this->hasMany(PaymentItem::class, 'from_area_id', 'id');
    }

    public function fromAreaPaymentCharges()
    {
        return $this->hasMany(PaymentCharge::class, 'from_area_id', 'id');
    }

    public function fromAreaPaymentTypes()
    {
        return $this->hasMany(PaymentType::class, 'from_area_id', 'id');
    }

    public function fromAreaHomeOwnerTransactions()
    {
        return $this->hasMany(HomeOwnerTransaction::class, 'from_area_id', 'id');
    }

    public function fromAreaBillTypes()
    {
        return $this->hasMany(BillType::class, 'from_area_id', 'id');
    }

    public function fromAreaBillCharges()
    {
        return $this->hasMany(BillCharge::class, 'from_area_id', 'id');
    }

    public function fromAreaBills()
    {
        return $this->hasMany(Bill::class, 'from_area_id', 'id');
    }

    public function fromAreaBillItems()
    {
        return $this->hasMany(BillItem::class, 'from_area_id', 'id');
    }

    public function fromAreaBillStatuses()
    {
        return $this->hasMany(BillStatus::class, 'from_area_id', 'id');
    }

    public function fromAreaBillParticulars()
    {
        return $this->hasMany(BillParticular::class, 'from_area_id', 'id');
    }

    public function fromAreaBillHistories()
    {
        return $this->hasMany(BillHistory::class, 'from_area_id', 'id');
    }

    public function areaProjects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function areaOpenProjects()
    {
        return $this->belongsToMany(OpenProject::class);
    }

    public function areaUsers()
    {
        return $this->belongsToMany(User::class);
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
