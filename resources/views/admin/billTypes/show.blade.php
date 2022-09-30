@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.billType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.billType.fields.id') }}
                        </th>
                        <td>
                            {{ $billType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billType.fields.name') }}
                        </th>
                        <td>
                            {{ $billType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billType.fields.from_area') }}
                        </th>
                        <td>
                            {{ $billType->from_area->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-types.index') }}">
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
            <a class="nav-link" href="#bill_type_bills" role="tab" data-toggle="tab">
                {{ trans('cruds.bill.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bill_type_bills">
            @includeIf('admin.billTypes.relationships.billTypeBills', ['bills' => $billType->billTypeBills])
        </div>
    </div>
</div>

@endsection