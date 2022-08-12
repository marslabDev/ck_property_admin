@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.street.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.streets.index', [currentArea()]) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.street.fields.id') }}
                        </th>
                        <td>
                            {{ $street->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.street.fields.street_name') }}
                        </th>
                        <td>
                            {{ $street->street_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.street.fields.from_area') }}
                        </th>
                        <td>
                            {{ $street->from_area->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.streets.index', [currentArea()]) }}">
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
        <li class="nav-item active">
            <a class="nav-link" href="#street_manage_houses" role="tab" data-toggle="tab">
                {{ trans('cruds.manageHouse.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content tw-px-5 tw-pt-5">
        <div class="tab-pane" role="tabpanel" id="street_manage_houses">
            @includeIf('admin.streets.relationships.streetManageHouses', ['manageHouses' => $street->streetManageHouses])
        </div>
    </div>
</div>

@endsection