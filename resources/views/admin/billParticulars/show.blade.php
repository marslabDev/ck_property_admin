@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.billParticular.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-particulars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.billParticular.fields.id') }}
                        </th>
                        <td>
                            {{ $billParticular->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billParticular.fields.name') }}
                        </th>
                        <td>
                            {{ $billParticular->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billParticular.fields.unit_price') }}
                        </th>
                        <td>
                            {{ $billParticular->unit_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billParticular.fields.uom') }}
                        </th>
                        <td>
                            {{ $billParticular->uom }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billParticular.fields.note') }}
                        </th>
                        <td>
                            {!! $billParticular->note !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-particulars.index') }}">
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
            <a class="nav-link" href="#bill_particular_bill_items" role="tab" data-toggle="tab">
                {{ trans('cruds.billItem.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bill_particular_bill_items">
            @includeIf('admin.billParticulars.relationships.billParticularBillItems', ['billItems' => $billParticular->billParticularBillItems])
        </div>
    </div>
</div>

@endsection