@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.houseType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.house-types.index', [currentArea()]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.houseType.fields.id') }}
                        </th>
                        <td>
                            {{ $houseType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.houseType.fields.name') }}
                        </th>
                        <td>
                            {{ $houseType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.houseType.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\HouseType::TYPE_SELECT[$houseType->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.houseType.fields.from_area') }}
                        </th>
                        <td>
                            {{ $houseType->from_area->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.house-types.index', [currentArea()]) }}">
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
            <a class="nav-link active" href="#house_type_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#house_type_manage_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.managePrice.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content tw-px-5 tw-pt-5">
        <div class="tab-pane active" role="tabpanel" id="house_type_manage_houses">
            @includeIf('admin.houseTypes.relationships.houseTypeManageHouses', ['manageHouses' => $houseType->houseTypeManageHouses])
        </div>
        <div class="tab-pane" role="tabpanel" id="house_type_manage_prices">
            @includeIf('admin.houseTypes.relationships.houseTypeManagePrices', ['managePrices' => $houseType->houseTypeManagePrices])
        </div>
    </div>
</div>

@endsection