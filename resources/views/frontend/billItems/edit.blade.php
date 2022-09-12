@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.billItem.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bill-items.update", [$billItem->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="bill_particular_id">{{ trans('cruds.billItem.fields.bill_particular') }}</label>
                            <select class="form-control select2" name="bill_particular_id" id="bill_particular_id" required>
                                @foreach($bill_particulars as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('bill_particular_id') ? old('bill_particular_id') : $billItem->bill_particular->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="number" name="total_unit" id="total_unit" value="{{ old('total_unit', $billItem->total_unit) }}" step="0.01" required>
                            @if($errors->has('total_unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.billItem.fields.total_unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.billItem.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $billItem->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.billItem.fields.amount_helper') }}</span>
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