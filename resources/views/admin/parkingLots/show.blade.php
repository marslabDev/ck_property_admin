@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.parkingLot.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parking-lots.index', [currentArea()]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.parkingLot.fields.id') }}
                        </th>
                        <td>
                            {{ $parkingLot->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parkingLot.fields.lot_no') }}
                        </th>
                        <td>
                            {{ $parkingLot->lot_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.parkingLot.fields.floor') }}
                        </th>
                        <td>
                            {{ $parkingLot->floor }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.parking-lots.index', [currentArea()]) }}">
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
            <a class="nav-link active" href="#parking_lot_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content tw-px-5 tw-pt-5">
        <div class="tab-pane active" role="tabpanel" id="parking_lot_manage_houses">
            @includeIf('admin.parkingLots.relationships.parkingLotManageHouses', ['manageHouses' => $parkingLot->parkingLotManageHouses])
        </div>
    </div>
</div>

@endsection