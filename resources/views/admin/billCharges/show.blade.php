@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.billCharge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-charges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.billCharge.fields.id') }}
                        </th>
                        <td>
                            {{ $billCharge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billCharge.fields.name') }}
                        </th>
                        <td>
                            {{ $billCharge->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billCharge.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\BillCharge::TYPE_SELECT[$billCharge->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billCharge.fields.rate') }}
                        </th>
                        <td>
                            {{ $billCharge->rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billCharge.fields.from_area') }}
                        </th>
                        <td>
                            {{ $billCharge->from_area->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bill-charges.index') }}">
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
            <a class="nav-link" href="#bill_charges_bills" role="tab" data-toggle="tab">
                {{ trans('cruds.bill.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bill_charges_bills">
            @includeIf('admin.billCharges.relationships.billChargesBills', ['bills' => $billCharge->billChargesBills])
        </div>
    </div>
</div>

@endsection