@extends('layouts.core')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.area.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('core.areas.index') }}">
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
                <a class="btn btn-default" href="{{ route('core.areas.index') }}">
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
    <ul class="nav nav-pills" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#people_in_area_notices" role="tab" data-toggle="tab">
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
    <div class="tab-content tw-px-5 tw-pt-5">
        <div class="tab-pane active" role="tabpanel" id="people_in_area_notices">
            @includeIf('core.areas.relationships.peopleInAreaNotices', ['notices' => $area->peopleInAreaNotices, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_my_cases">
            @includeIf('core.areas.relationships.fromAreaMyCases', ['myCases' => $area->fromAreaMyCases, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_complaints">
            @includeIf('core.areas.relationships.fromAreaComplaints', ['complaints' => $area->fromAreaComplaints, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_parking_lots">
            @includeIf('core.areas.relationships.fromAreaParkingLots', ['parkingLots' => $area->fromAreaParkingLots, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_manage_houses">
            @includeIf('core.areas.relationships.fromAreaManageHouses', ['manageHouses' => $area->fromAreaManageHouses, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_house_types">
            @includeIf('core.areas.relationships.fromAreaHouseTypes', ['houseTypes' => $area->fromAreaHouseTypes, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_streets">
            @includeIf('core.areas.relationships.fromAreaStreets', ['streets' => $area->fromAreaStreets, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_manage_prices">
            @includeIf('core.areas.relationships.fromAreaManagePrices', ['managePrices' => $area->fromAreaManagePrices, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_house_statuses">
            @includeIf('core.areas.relationships.fromAreaHouseStatuses', ['houseStatuses' => $area->fromAreaHouseStatuses, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_case_statuses">
            @includeIf('core.areas.relationships.fromAreaCaseStatuses', ['caseStatuses' => $area->fromAreaCaseStatuses, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_cases_categories">
            @includeIf('core.areas.relationships.fromAreaCasesCategories', ['casesCategories' => $area->fromAreaCasesCategories, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_complaint_statuses">
            @includeIf('core.areas.relationships.fromAreaComplaintStatuses', ['complaintStatuses' => $area->fromAreaComplaintStatuses, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_clients">
            @includeIf('core.areas.relationships.fromAreaClients', ['clients' => $area->fromAreaClients, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_projects">
            @includeIf('core.areas.relationships.fromAreaProjects', ['projects' => $area->fromAreaProjects, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_open_projects">
            @includeIf('core.areas.relationships.fromAreaOpenProjects', ['openProjects' => $area->fromAreaOpenProjects, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_notes">
            @includeIf('core.areas.relationships.fromAreaNotes', ['notes' => $area->fromAreaNotes, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_transactions">
            @includeIf('core.areas.relationships.fromAreaTransactions', ['transactions' => $area->fromAreaTransactions, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_documents">
            @includeIf('core.areas.relationships.fromAreaDocuments', ['documents' => $area->fromAreaDocuments, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_task_statuses">
            @includeIf('core.areas.relationships.fromAreaTaskStatuses', ['taskStatuses' => $area->fromAreaTaskStatuses, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_task_tags">
            @includeIf('core.areas.relationships.fromAreaTaskTags', ['taskTags' => $area->fromAreaTaskTags, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_tasks">
            @includeIf('core.areas.relationships.fromAreaTasks', ['tasks' => $area->fromAreaTasks, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_transaction_types">
            @includeIf('core.areas.relationships.fromAreaTransactionTypes', ['transactionTypes' => $area->fromAreaTransactionTypes, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_client_statuses">
            @includeIf('core.areas.relationships.fromAreaClientStatuses', ['clientStatuses' => $area->fromAreaClientStatuses, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_payment_items">
            @includeIf('core.areas.relationships.fromAreaPaymentItems', ['paymentItems' => $area->fromAreaPaymentItems, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_payment_charges">
            @includeIf('core.areas.relationships.fromAreaPaymentCharges', ['paymentCharges' => $area->fromAreaPaymentCharges, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_payment_types">
            @includeIf('core.areas.relationships.fromAreaPaymentTypes', ['paymentTypes' => $area->fromAreaPaymentTypes, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_area_home_owner_transactions">
            @includeIf('core.areas.relationships.fromAreaHomeOwnerTransactions', ['homeOwnerTransactions' => $area->fromAreaHomeOwnerTransactions, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_projects">
            @includeIf('core.areas.relationships.areaProjects', ['projects' => $area->areaProjects, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_open_projects">
            @includeIf('core.areas.relationships.areaOpenProjects', ['openProjects' => $area->areaOpenProjects, 'area' => $area])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_users">
            @includeIf('core.areas.relationships.areaUsers', ['users' => $area->areaUsers, 'area' => $area])
        </div>
    </div>
</div>

@endsection