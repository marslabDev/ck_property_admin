@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.transaction.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.transactions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $transaction->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.project') }}
                                    </th>
                                    <td>
                                        {{ $transaction->project->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.transaction_type') }}
                                    </th>
                                    <td>
                                        {{ $transaction->transaction_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.supplier') }}
                                    </th>
                                    <td>
                                        {{ $transaction->supplier->company ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $transaction->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.currency') }}
                                    </th>
                                    <td>
                                        {{ $transaction->currency->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.details') }}
                                    </th>
                                    <td>
                                        {{ $transaction->details }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.transaction.fields.transaction_date') }}
                                    </th>
                                    <td>
                                        {{ $transaction->transaction_date }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.transactions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection