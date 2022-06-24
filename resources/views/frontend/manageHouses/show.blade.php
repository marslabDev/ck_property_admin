@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.manageHouse.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.manage-houses.index') }}">
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
                                        {{ trans('cruds.manageHouse.fields.unit_no') }}
                                    </th>
                                    <td>
                                        {{ $manageHouse->unit_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.contact_name') }}
                                    </th>
                                    <td>
                                        {{ $manageHouse->contact_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.contact_no') }}
                                    </th>
                                    <td>
                                        {{ $manageHouse->contact_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.house_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ManageHouse::HOUSE_STATUS_SELECT[$manageHouse->house_status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.spuare_feet') }}
                                    </th>
                                    <td>
                                        {{ $manageHouse->spuare_feet }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.parking_lot') }}
                                    </th>
                                    <td>
                                        {{ $manageHouse->parking_lot->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.manage-houses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection