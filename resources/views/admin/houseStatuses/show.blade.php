@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.houseStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.house-statuses.index', [currentArea()]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.houseStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $houseStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.houseStatus.fields.status') }}
                        </th>
                        <td>
                            {{ $houseStatus->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.house-statuses.index', [currentArea()]) }}">
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
            <a class="nav-link active" href="#house_status_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content tw-px-5 tw-pt-5">
        <div class="tab-pane active" role="tabpanel" id="house_status_manage_houses">
            @includeIf('admin.houseStatuses.relationships.houseStatusManageHouses', ['manageHouses' => $houseStatus->houseStatusManageHouses])
        </div>
    </div>
</div>

@endsection