@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.billStatus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-statuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.billStatus.fields.id') }}
                        </th>
                        <td>
                            {{ $billStatus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billStatus.fields.name') }}
                        </th>
                        <td>
                            {{ $billStatus->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billStatus.fields.from_area') }}
                        </th>
                        <td>
                            {{ $billStatus->from_area->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-statuses.index') }}">
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
            <a class="nav-link" href="#bill_status_bills" role="tab" data-toggle="tab">
                {{ trans('cruds.bill.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bill_status_bills">
            @includeIf('admin.billStatuses.relationships.billStatusBills', ['bills' => $billStatus->billStatusBills])
        </div>
    </div>
</div>

@endsection