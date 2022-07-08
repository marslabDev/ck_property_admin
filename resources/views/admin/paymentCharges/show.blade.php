@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentCharge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-charges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentCharge.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentCharge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentCharge.fields.particular') }}
                        </th>
                        <td>
                            {{ $paymentCharge->particular }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentCharge.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\PaymentCharge::TYPE_SELECT[$paymentCharge->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentCharge.fields.amount') }}
                        </th>
                        <td>
                            {{ $paymentCharge->amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-charges.index') }}">
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
            <a class="nav-link" href="#extra_charge_payment_plans" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentPlan.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="extra_charge_payment_plans">
            @includeIf('admin.paymentCharges.relationships.extraChargePaymentPlans', ['paymentPlans' => $paymentCharge->extraChargePaymentPlans])
        </div>
    </div>
</div>

@endsection