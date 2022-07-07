@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.paymentCharge.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-charges.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="particular">{{ trans('cruds.paymentCharge.fields.particular') }}</label>
                <input class="form-control {{ $errors->has('particular') ? 'is-invalid' : '' }}" type="text" name="particular" id="particular" value="{{ old('particular', '') }}" required>
                @if($errors->has('particular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('particular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentCharge.fields.particular_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.paymentCharge.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentCharge::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentCharge.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.paymentCharge.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentCharge.fields.amount_helper') }}</span>
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