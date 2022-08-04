@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.username') }}
                        </th>
                        <td>
                            {{ $user->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $user->phone_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.area') }}
                        </th>
                        <td>
                            @foreach($user->areas as $key => $area)
                                <span class="label label-info">{{ $area->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.two_factor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#created_by_my_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.myCase.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_details" role="tab" data-toggle="tab">
                {{ trans('cruds.userDetail.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_card_mgmts" role="tab" data-toggle="tab">
                {{ trans('cruds.userCardMgmt.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_payment_plans" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentPlan.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_home_owner_transactions" role="tab" data-toggle="tab">
                {{ trans('cruds.homeOwnerTransaction.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#created_by_home_owner_transactions" role="tab" data-toggle="tab">
                {{ trans('cruds.homeOwnerTransaction.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contact_person_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contact_person2_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#handle_by_my_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.myCase.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#report_to_my_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.myCase.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#owned_by_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="created_by_my_cases">
            @includeIf('admin.users.relationships.createdByMyCases', ['myCases' => $user->createdByMyCases])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_details">
            @includeIf('admin.users.relationships.userUserDetails', ['userDetails' => $user->userUserDetails])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_card_mgmts">
            @includeIf('admin.users.relationships.userUserCardMgmts', ['userCardMgmts' => $user->userUserCardMgmts])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_payment_plans">
            @includeIf('admin.users.relationships.userPaymentPlans', ['paymentPlans' => $user->userPaymentPlans])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_home_owner_transactions">
            @includeIf('admin.users.relationships.userHomeOwnerTransactions', ['homeOwnerTransactions' => $user->userHomeOwnerTransactions])
        </div>
        <div class="tab-pane" role="tabpanel" id="created_by_home_owner_transactions">
            @includeIf('admin.users.relationships.createdByHomeOwnerTransactions', ['homeOwnerTransactions' => $user->createdByHomeOwnerTransactions])
        </div>
        <div class="tab-pane" role="tabpanel" id="contact_person_manage_houses">
            @includeIf('admin.users.relationships.contactPersonManageHouses', ['manageHouses' => $user->contactPersonManageHouses])
        </div>
        <div class="tab-pane" role="tabpanel" id="contact_person2_manage_houses">
            @includeIf('admin.users.relationships.contactPerson2ManageHouses', ['manageHouses' => $user->contactPerson2ManageHouses])
        </div>
        <div class="tab-pane" role="tabpanel" id="handle_by_my_cases">
            @includeIf('admin.users.relationships.handleByMyCases', ['myCases' => $user->handleByMyCases])
        </div>
        <div class="tab-pane" role="tabpanel" id="report_to_my_cases">
            @includeIf('admin.users.relationships.reportToMyCases', ['myCases' => $user->reportToMyCases])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="owned_by_manage_houses">
            @includeIf('admin.users.relationships.ownedByManageHouses', ['manageHouses' => $user->ownedByManageHouses])
        </div>
    </div>
</div>

@endsection