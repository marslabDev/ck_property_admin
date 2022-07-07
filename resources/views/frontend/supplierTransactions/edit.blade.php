@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.supplierTransaction.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.supplier-transactions.update", [$supplierTransaction->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="project_id">{{ trans('cruds.supplierTransaction.fields.project') }}</label>
                            <select class="form-control select2" name="project_id" id="project_id" required>
                                @foreach($projects as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $supplierTransaction->project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.project_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transaction_type_id">{{ trans('cruds.supplierTransaction.fields.transaction_type') }}</label>
                            <select class="form-control select2" name="transaction_type_id" id="transaction_type_id" required>
                                @foreach($transaction_types as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('transaction_type_id') ? old('transaction_type_id') : $supplierTransaction->transaction_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transaction_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.transaction_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="income_source_id">{{ trans('cruds.supplierTransaction.fields.income_source') }}</label>
                            <select class="form-control select2" name="income_source_id" id="income_source_id" required>
                                @foreach($income_sources as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('income_source_id') ? old('income_source_id') : $supplierTransaction->income_source->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('income_source'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('income_source') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.income_source_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.supplierTransaction.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $supplierTransaction->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="currency_id">{{ trans('cruds.supplierTransaction.fields.currency') }}</label>
                            <select class="form-control select2" name="currency_id" id="currency_id" required>
                                @foreach($currencies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('currency_id') ? old('currency_id') : $supplierTransaction->currency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transaction_date">{{ trans('cruds.supplierTransaction.fields.transaction_date') }}</label>
                            <input class="form-control date" type="text" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', $supplierTransaction->transaction_date) }}" required>
                            @if($errors->has('transaction_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.transaction_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.supplierTransaction.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $supplierTransaction->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.supplierTransaction.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $supplierTransaction->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierTransaction.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection