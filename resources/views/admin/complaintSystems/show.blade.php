@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.complaintSystem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaint-systems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintSystem.fields.id') }}
                        </th>
                        <td>
                            {{ $complaintSystem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintSystem.fields.title') }}
                        </th>
                        <td>
                            {{ $complaintSystem->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintSystem.fields.description') }}
                        </th>
                        <td>
                            {{ $complaintSystem->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintSystem.fields.image') }}
                        </th>
                        <td>
                            @if($complaintSystem->image)
                                <a href="{{ $complaintSystem->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $complaintSystem->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintSystem.fields.create_by') }}
                        </th>
                        <td>
                            {{ $complaintSystem->create_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintSystem.fields.status') }}
                        </th>
                        <td>
                            {{ $complaintSystem->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaintSystem.fields.created_at') }}
                        </th>
                        <td>
                            {{ $complaintSystem->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaint-systems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection