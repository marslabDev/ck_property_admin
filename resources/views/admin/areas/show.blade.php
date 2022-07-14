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
            <a class="nav-link" href="#area_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#area_house_types" role="tab" data-toggle="tab">
                {{ trans('cruds.houseType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#people_in_area_notices" role="tab" data-toggle="tab">
                {{ trans('cruds.notice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#area_manage_prices" role="tab" data-toggle="tab">
                {{ trans('cruds.managePrice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#area_streets" role="tab" data-toggle="tab">
                {{ trans('cruds.street.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#area_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="area_manage_houses">
            @includeIf('admin.areas.relationships.areaManageHouses', ['manageHouses' => $area->areaManageHouses])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_house_types">
            @includeIf('admin.areas.relationships.areaHouseTypes', ['houseTypes' => $area->areaHouseTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="people_in_area_notices">
            @includeIf('admin.areas.relationships.peopleInAreaNotices', ['notices' => $area->peopleInAreaNotices])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_manage_prices">
            @includeIf('admin.areas.relationships.areaManagePrices', ['managePrices' => $area->areaManagePrices])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_streets">
            @includeIf('admin.areas.relationships.areaStreets', ['streets' => $area->areaStreets])
        </div>
        <div class="tab-pane" role="tabpanel" id="area_projects">
            @includeIf('admin.areas.relationships.areaProjects', ['projects' => $area->areaProjects])
        </div>
    </div>
</div>

@endsection