@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.homeOwnerTransaction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.home-owner-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.id') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.user') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.house') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->house->unit_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.payment_plan') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->payment_plan->due_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.payment_type') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->payment_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.amount_paid') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->amount_paid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.changes') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->changes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.created_by') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->created_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.from_area') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->from_area->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.details') }}
                        </th>
                        <td>
                            {{ $homeOwnerTransaction->details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.home-owner-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection