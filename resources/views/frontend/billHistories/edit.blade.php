@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.billHistory.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bill-histories.update", [$billHistory->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="paid_by_id">{{ trans('cruds.billHistory.fields.paid_by') }}</label>
                            <select class="form-control select2" name="paid_by_id" id="paid_by_id" required>
                                @foreach($paid_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('paid_by_id') ? old('paid_by_id') : $billHistory->paid_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('paid_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.billHistory.fields.paid_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bill_id">{{ trans('cruds.billHistory.fields.bill') }}</label>
                            <select class="form-control select2" name="bill_id" id="bill_id" required>
                                @foreach($bills as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('bill_id') ? old('bill_id') : $billHistory->bill->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bill'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bill') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.billHistory.fields.bill_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.billHistory.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $billHistory->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.billHistory.fields.amount_helper') }}</span>
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