@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.billItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.billItem.fields.id') }}
                        </th>
                        <td>
                            {{ $billItem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billItem.fields.bill_particular') }}
                        </th>
                        <td>
                            {{ $billItem->bill_particular->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billItem.fields.total_unit') }}
                        </th>
                        <td>
                            {{ $billItem->total_unit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billItem.fields.amount') }}
                        </th>
                        <td>
                            {{ $billItem->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billItem.fields.bill') }}
                        </th>
                        <td>
                            {{ $billItem->bill->billing_date ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-items.index') }}">
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
            <a class="nav-link" href="#bill_item_bills" role="tab" data-toggle="tab">
                {{ trans('cruds.bill.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bill_item_bills">
            @includeIf('admin.billItems.relationships.billItemBills', ['bills' => $billItem->billItemBills])
        </div>
    </div>
</div>

@endsection