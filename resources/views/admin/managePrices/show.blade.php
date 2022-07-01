@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.managePrice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.manage-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.managePrice.fields.id') }}
                        </th>
                        <td>
                            {{ $managePrice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.managePrice.fields.area') }}
                        </th>
                        <td>
                            {{ $managePrice->area->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.managePrice.fields.house_type') }}
                        </th>
                        <td>
                            {{ $managePrice->house_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.managePrice.fields.price_per_sq_ft') }}
                        </th>
                        <td>
                            {{ $managePrice->price_per_sq_ft }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.manage-prices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection