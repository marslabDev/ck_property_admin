@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.caseStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.case-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.caseStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $caseStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseStatus.fields.name') }}
                        </th>
                        <td>
                            {{ $caseStatus->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseStatus.fields.status_linking') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $caseStatus->status_linking ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.caseStatus.fields.complaint_status') }}
                        </th>
                        <td>
                            {{ $caseStatus->complaint_status->status ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.case-statuses.index') }}">
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
            <a class="nav-link" href="#status_my_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.myCase.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="status_my_cases">
            @includeIf('admin.caseStatuses.relationships.statusMyCases', ['myCases' => $caseStatus->statusMyCases])
        </div>
    </div>
</div>

@endsection