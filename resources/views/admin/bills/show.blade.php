@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.id') }}
                        </th>
                        <td>
                            {{ $bill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.billplz') }}
                        </th>
                        <td>
                            {{ $bill->billplz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.billplz_url') }}
                        </th>
                        <td>
                            {{ $bill->billplz_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.house') }}
                        </th>
                        <td>
                            {{ $bill->house->unit_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.homeowner') }}
                        </th>
                        <td>
                            {{ $bill->homeowner->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.billing_date') }}
                        </th>
                        <td>
                            {{ $bill->billing_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.due_date') }}
                        </th>
                        <td>
                            {{ $bill->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.bill_item') }}
                        </th>
                        <td>
                            @foreach($bill->bill_items as $key => $bill_item)
                                <span class="label label-info">{{ $bill_item->total_unit }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.bill_charges') }}
                        </th>
                        <td>
                            @foreach($bill->bill_charges as $key => $bill_charges)
                                <span class="label label-info">{{ $bill_charges->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.amount') }}
                        </th>
                        <td>
                            {{ $bill->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.bill_status') }}
                        </th>
                        <td>
                            {{ $bill->bill_status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
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
            <a class="nav-link" href="#bill_bill_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.billHistory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bill_bill_histories">
            @includeIf('admin.bills.relationships.billBillHistories', ['billHistories' => $bill->billBillHistories])
        </div>
    </div>
</div>

@endsection