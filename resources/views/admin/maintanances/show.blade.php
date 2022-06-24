@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.maintanance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.maintanances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.maintanance.fields.id') }}
                        </th>
                        <td>
                            {{ $maintanance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintanance.fields.type') }}
                        </th>
                        <td>
                            {{ $maintanance->type->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintanance.fields.date_maintanance') }}
                        </th>
                        <td>
                            {{ $maintanance->date_maintanance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintanance.fields.area') }}
                        </th>
                        <td>
                            {{ $maintanance->area->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintanance.fields.handle_by') }}
                        </th>
                        <td>
                            {{ $maintanance->handle_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintanance.fields.supplier') }}
                        </th>
                        <td>
                            {{ $maintanance->supplier->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.maintanances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection