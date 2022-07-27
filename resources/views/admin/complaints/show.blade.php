@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.complaint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.id') }}
                        </th>
                        <td>
                            {{ $complaint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.ticker_no') }}
                        </th>
                        <td>
                            {{ $complaint->ticker_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.title') }}
                        </th>
                        <td>
                            {{ $complaint->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.description') }}
                        </th>
                        <td>
                            {!! $complaint->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.status') }}
                        </th>
                        <td>
                            {{ $complaint->status->status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.image') }}
                        </th>
                        <td>
                            @foreach($complaint->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.created_by') }}
                        </th>
                        <td>
                            {{ $complaint->created_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.complaint.fields.created_at') }}
                        </th>
                        <td>
                            {{ $complaint->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaints.index') }}">
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
            <a class="nav-link" href="#complaint_my_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.myCase.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="complaint_my_cases">
            @includeIf('admin.complaints.relationships.complaintMyCases', ['myCases' => $complaint->complaintMyCases])
        </div>
    </div>
</div>

@endsection