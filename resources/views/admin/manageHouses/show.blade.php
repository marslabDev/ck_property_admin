@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.manageHouse.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.manage-houses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.id') }}
                        </th>
                        <td>
                            {{ $manageHouse->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.house_type') }}
                        </th>
                        <td>
                            {{ $manageHouse->house_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.unit_no') }}
                        </th>
                        <td>
                            {{ $manageHouse->unit_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.floor') }}
                        </th>
                        <td>
                            {{ $manageHouse->floor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.block') }}
                        </th>
                        <td>
                            {{ $manageHouse->block }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.area') }}
                        </th>
                        <td>
                            {{ $manageHouse->area->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.street') }}
                        </th>
                        <td>
                            {{ $manageHouse->street->street_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.square_feet') }}
                        </th>
                        <td>
                            {{ $manageHouse->square_feet }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.parking_lot') }}
                        </th>
                        <td>
                            @foreach($manageHouse->parking_lots as $key => $parking_lot)
                                <span class="label label-info">{{ $parking_lot->lot_no }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.documents') }}
                        </th>
                        <td>
                            @foreach($manageHouse->documents as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.house_status') }}
                        </th>
                        <td>
                            {{ $manageHouse->house_status->status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.owned_by') }}
                        </th>
                        <td>
                            @foreach($manageHouse->owned_bies as $key => $owned_by)
                                <span class="label label-info">{{ $owned_by->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.contact_person') }}
                        </th>
                        <td>
                            {{ $manageHouse->contact_person->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manageHouse.fields.contact_person_2') }}
                        </th>
                        <td>
                            {{ $manageHouse->contact_person_2->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.manage-houses.index') }}">
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
            <a class="nav-link" href="#house_payment_plans" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentPlan.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#house_home_owner_transactions" role="tab" data-toggle="tab">
                {{ trans('cruds.homeOwnerTransaction.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="house_payment_plans">
            @includeIf('admin.manageHouses.relationships.housePaymentPlans', ['paymentPlans' => $manageHouse->housePaymentPlans])
        </div>
        <div class="tab-pane" role="tabpanel" id="house_home_owner_transactions">
            @includeIf('admin.manageHouses.relationships.houseHomeOwnerTransactions', ['homeOwnerTransactions' => $manageHouse->houseHomeOwnerTransactions])
        </div>
    </div>
</div>

@endsection