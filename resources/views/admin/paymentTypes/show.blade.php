@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentType.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentType.fields.name') }}
                        </th>
                        <td>
                            {{ $paymentType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentType.fields.created_at') }}
                        </th>
                        <td>
                            {{ $paymentType->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-types.index') }}">
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
            <a class="nav-link" href="#payment_type_payment_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.paymentHistory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="payment_type_payment_histories">
            @includeIf('admin.paymentTypes.relationships.paymentTypePaymentHistories', ['paymentHistories' => $paymentType->paymentTypePaymentHistories])
        </div>
    </div>
</div>

@endsection