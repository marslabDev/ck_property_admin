@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentPlan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-plans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentPlan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.user') }}
                        </th>
                        <td>
                            {{ $paymentPlan->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.house') }}
                        </th>
                        <td>
                            {{ $paymentPlan->house->unit_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.due_date') }}
                        </th>
                        <td>
                            {{ $paymentPlan->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.payment') }}
                        </th>
                        <td>
                            @foreach($paymentPlan->payments as $key => $payment)
                                <span class="label label-info">{{ $payment->particular }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.recusive_payment') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $paymentPlan->recusive_payment ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.cycle_every') }}
                        </th>
                        <td>
                            {{ $paymentPlan->cycle_every }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.cycle_by') }}
                        </th>
                        <td>
                            {{ App\Models\PaymentPlan::CYCLE_BY_SELECT[$paymentPlan->cycle_by] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.no_of_cycle') }}
                        </th>
                        <td>
                            {{ $paymentPlan->no_of_cycle }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-plans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection