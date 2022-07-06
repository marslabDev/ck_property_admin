@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.street.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.streets.index') }}">
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
                            {{ trans('cruds.street.fields.area') }}
                        </th>
                        <td>
                            {{ $street->area->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.streets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection