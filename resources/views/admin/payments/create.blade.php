@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.payment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="particular">{{ trans('cruds.payment.fields.particular') }}</label>
                <textarea class="form-control {{ $errors->has('particular') ? 'is-invalid' : '' }}" name="particular" id="particular" required>{{ old('particular') }}</textarea>
                @if($errors->has('particular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('particular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.particular_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit_price">{{ trans('cruds.payment.fields.unit_price') }}</label>
                <input class="form-control {{ $errors->has('unit_price') ? 'is-invalid' : '' }}" type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', '') }}" step="0.01" required>
                @if($errors->has('unit_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.unit_price_helper') }}</span>
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