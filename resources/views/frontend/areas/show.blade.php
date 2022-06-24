@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.area.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.areas.index') }}">
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
                                        {{ trans('cruds.area.fields.office_no') }}
                                    </th>
                                    <td>
                                        {{ $area->office_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.area.fields.address_line') }}
                                    </th>
                                    <td>
                                        {{ $area->address_line }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.area.fields.address_line_2') }}
                                    </th>
                                    <td>
                                        {{ $area->address_line_2 }}
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
                                        {{ trans('cruds.area.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $area->state }}
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
                                        {{ trans('cruds.area.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $area->country }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.area.fields.price_per_ft') }}
                                    </th>
                                    <td>
                                        {{ $area->price_per_ft }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.areas.index') }}">
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