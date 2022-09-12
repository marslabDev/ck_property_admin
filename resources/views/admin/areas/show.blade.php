@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.area.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.id') }}
                        </th>
                        <td>
                            {{ $area->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.name') }}
                        </th>
                        <td>
                            {{ $area->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.city') }}
                        </th>
                        <td>
                            {{ $area->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.postcode') }}
                        </th>
                        <td>
                            {{ $area->postcode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.state') }}
                        </th>
                        <td>
                            {{ $area->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.country') }}
                        </th>
                        <td>
                            {{ $area->country }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#people_in_area_notices" role="tab" data-toggle="tab">
                {{ trans('cruds.notice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_my_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.myCase.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_complaints" role="tab" data-toggle="tab">
                {{ trans('cruds.complaint.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_parking_lots" role="tab" data-toggle="tab">
                {{ trans('cruds.parkingLot.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_house_types" role="tab" data-toggle="tab">
                {{ trans('cruds.houseType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_streets" role="tab" data-toggle="tab">
                {{ trans('cruds.street.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_manage_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.managePrice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_house_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.houseStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_case_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.caseStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_cases_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.casesCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_complaint_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.complaintStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_clients" role="tab" data-toggle="tab">
                {{ trans('cruds.client.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_open_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.openProject.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_notes" role="tab" data-toggle="tab">
                {{ trans('cruds.note.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_transactions" role="tab" data-toggle="tab">
                {{ trans('cruds.transaction.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_task_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.taskStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_task_tags" role="tab" data-toggle="tab">
                {{ trans('cruds.taskTag.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_transaction_types" role="tab" data-toggle="tab">
                {{ trans('cruds.transactionType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_client_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.clientStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_payment_items" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentItem.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_payment_charges" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentCharge.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_payment_types" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_home_owner_transactions" role="tab" data-toggle="tab">
                {{ trans('cruds.homeOwnerTransaction.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_bill_types" role="tab" data-toggle="tab">
                {{ trans('cruds.billType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_bill_charges" role="tab" data-toggle="tab">
                {{ trans('cruds.billCharge.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_bills" role="tab" data-toggle="tab">
                {{ trans('cruds.bill.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_bill_items" role="tab" data-toggle="tab">
                {{ trans('cruds.billItem.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_bill_statuses" role="tab" data-toggle="tab">
                {{ trans('cruds.billStatus.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_bill_particulars" role="tab" data-toggle="tab">
                {{ trans('cruds.billParticular.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_area_bill_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.billHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#area_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#area_open_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.openProject.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#area_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="people_in_area_notices">
            @includeIf('admin.areas.relationships.peopleInAreaNotices', ['notices' => $area->peopleInAreaNotices])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_my_cases">
            @includeIf('admin.areas.relationships.fromAreaMyCases', ['myCases' => $area->fromAreaMyCases])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_complaints">
            @includeIf('admin.areas.relationships.fromAreaComplaints', ['complaints' => $area->fromAreaComplaints])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_parking_lots">
            @includeIf('admin.areas.relationships.fromAreaParkingLots', ['parkingLots' => $area->fromAreaParkingLots])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_manage_houses">
            @includeIf('admin.areas.relationships.fromAreaManageHouses', ['manageHouses' => $area->fromAreaManageHouses])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_house_types">
            @includeIf('admin.areas.relationships.fromAreaHouseTypes', ['houseTypes' => $area->fromAreaHouseTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_streets">
            @includeIf('admin.areas.relationships.fromAreaStreets', ['streets' => $area->fromAreaStreets])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_manage_prices">
            @includeIf('admin.areas.relationships.fromAreaManagePrices', ['managePrices' => $area->fromAreaManagePrices])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_house_statuses">
            @includeIf('admin.areas.relationships.fromAreaHouseStatuses', ['houseStatuses' => $area->fromAreaHouseStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_case_statuses">
            @includeIf('admin.areas.relationships.fromAreaCaseStatuses', ['caseStatuses' => $area->fromAreaCaseStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_cases_categories">
            @includeIf('admin.areas.relationships.fromAreaCasesCategories', ['casesCategories' => $area->fromAreaCasesCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_complaint_statuses">
            @includeIf('admin.areas.relationships.fromAreaComplaintStatuses', ['complaintStatuses' => $area->fromAreaComplaintStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_clients">
            @includeIf('admin.areas.relationships.fromAreaClients', ['clients' => $area->fromAreaClients])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_projects">
            @includeIf('admin.areas.relationships.fromAreaProjects', ['projects' => $area->fromAreaProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_open_projects">
            @includeIf('admin.areas.relationships.fromAreaOpenProjects', ['openProjects' => $area->fromAreaOpenProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_notes">
            @includeIf('admin.areas.relationships.fromAreaNotes', ['notes' => $area->fromAreaNotes])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_transactions">
            @includeIf('admin.areas.relationships.fromAreaTransactions', ['transactions' => $area->fromAreaTransactions])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_documents">
            @includeIf('admin.areas.relationships.fromAreaDocuments', ['documents' => $area->fromAreaDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_task_statuses">
            @includeIf('admin.areas.relationships.fromAreaTaskStatuses', ['taskStatuses' => $area->fromAreaTaskStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_task_tags">
            @includeIf('admin.areas.relationships.fromAreaTaskTags', ['taskTags' => $area->fromAreaTaskTags])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_tasks">
            @includeIf('admin.areas.relationships.fromAreaTasks', ['tasks' => $area->fromAreaTasks])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_transaction_types">
            @includeIf('admin.areas.relationships.fromAreaTransactionTypes', ['transactionTypes' => $area->fromAreaTransactionTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_client_statuses">
            @includeIf('admin.areas.relationships.fromAreaClientStatuses', ['clientStatuses' => $area->fromAreaClientStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_payment_items">
            @includeIf('admin.areas.relationships.fromAreaPaymentItems', ['paymentItems' => $area->fromAreaPaymentItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_payment_charges">
            @includeIf('admin.areas.relationships.fromAreaPaymentCharges', ['paymentCharges' => $area->fromAreaPaymentCharges])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_payment_types">
            @includeIf('admin.areas.relationships.fromAreaPaymentTypes', ['paymentTypes' => $area->fromAreaPaymentTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_home_owner_transactions">
            @includeIf('admin.areas.relationships.fromAreaHomeOwnerTransactions', ['homeOwnerTransactions' => $area->fromAreaHomeOwnerTransactions])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_bill_types">
            @includeIf('admin.areas.relationships.fromAreaBillTypes', ['billTypes' => $area->fromAreaBillTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_bill_charges">
            @includeIf('admin.areas.relationships.fromAreaBillCharges', ['billCharges' => $area->fromAreaBillCharges])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_bills">
            @includeIf('admin.areas.relationships.fromAreaBills', ['bills' => $area->fromAreaBills])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_bill_items">
            @includeIf('admin.areas.relationships.fromAreaBillItems', ['billItems' => $area->fromAreaBillItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_bill_statuses">
            @includeIf('admin.areas.relationships.fromAreaBillStatuses', ['billStatuses' => $area->fromAreaBillStatuses])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_bill_particulars">
            @includeIf('admin.areas.relationships.fromAreaBillParticulars', ['billParticulars' => $area->fromAreaBillParticulars])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_bill_histories">
            @includeIf('admin.areas.relationships.fromAreaBillHistories', ['billHistories' => $area->fromAreaBillHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_projects">
            @includeIf('admin.areas.relationships.areaProjects', ['projects' => $area->areaProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_open_projects">
            @includeIf('admin.areas.relationships.areaOpenProjects', ['openProjects' => $area->areaOpenProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_users">
            @includeIf('admin.areas.relationships.areaUsers', ['users' => $area->areaUsers])
        </div>
    </div>
</div>

@endsection