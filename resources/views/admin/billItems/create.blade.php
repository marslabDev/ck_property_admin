@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.billItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bill-items.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bill_particular_id">{{ trans('cruds.billItem.fields.bill_particular') }}</label>
                <select class="form-control select2 {{ $errors->has('bill_particular') ? 'is-invalid' : '' }}" name="bill_particular_id" id="bill_particular_id" required>
                    @foreach($bill_particulars as $id => $entry)
                        <option value="{{ $id }}" {{ old('bill_particular_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bill_particular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bill_particular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billItem.fields.bill_particular_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_unit">{{ trans('cruds.billItem.fields.total_unit') }}</label>
                <input class="form-control {{ $errors->has('total_unit') ? 'is-invalid' : '' }}" type="number" name="total_unit" id="total_unit" value="{{ old('total_unit', '') }}" step="0.01" required>
                @if($errors->has('total_unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billItem.fields.total_unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.billItem.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billItem.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bill_id">{{ trans('cruds.billItem.fields.bill') }}</label>
                <select class="form-control select2 {{ $errors->has('bill') ? 'is-invalid' : '' }}" name="bill_id" id="bill_id" required>
                    @foreach($bills as $id => $entry)
                        <option value="{{ $id }}" {{ old('bill_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bill'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bill') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.billItem.fields.bill_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection