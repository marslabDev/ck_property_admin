@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supplierTransaction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supplier-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.id') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.project') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->project->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.transaction_type') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->transaction_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.income_source') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->income_source->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.amount') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.currency') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->currency->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.transaction_date') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->transaction_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.name') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierTransaction.fields.description') }}
                        </th>
                        <td>
                            {{ $supplierTransaction->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supplier-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection