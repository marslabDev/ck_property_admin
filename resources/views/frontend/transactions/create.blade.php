@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.transactions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="project_id">{{ trans('cruds.transaction.fields.project') }}</label>
                            <select class="form-control select2" name="project_id" id="project_id" required>
                                @foreach($projects as $id => $entry)
                                    <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.project_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transaction_type_id">{{ trans('cruds.transaction.fields.transaction_type') }}</label>
                            <select class="form-control select2" name="transaction_type_id" id="transaction_type_id" required>
                                @foreach($transaction_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('transaction_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transaction_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.transaction_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="supplier_id">{{ trans('cruds.transaction.fields.supplier') }}</label>
                            <select class="form-control select2" name="supplier_id" id="supplier_id" required>
                                @foreach($suppliers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('supplier_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('supplier') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.supplier_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="currency_id">{{ trans('cruds.transaction.fields.currency') }}</label>
                            <select class="form-control select2" name="currency_id" id="currency_id" required>
                                @foreach($currencies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('currency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="details">{{ trans('cruds.transaction.fields.details') }}</label>
                            <textarea class="form-control" name="details" id="details" required>{{ old('details') }}</textarea>
                            @if($errors->has('details'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('details') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.details_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="transaction_date">{{ trans('cruds.transaction.fields.transaction_date') }}</label>
                            <input class="form-control date" type="text" name="transaction_date" id="transaction_date" value="{{ old('transaction_date') }}" required>
                            @if($errors->has('transaction_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.transaction_date_helper') }}</span>
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