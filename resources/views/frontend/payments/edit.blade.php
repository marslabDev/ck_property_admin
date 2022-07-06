@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="particular">{{ trans('cruds.payment.fields.particular') }}</label>
                            <textarea class="form-control" name="particular" id="particular" required>{{ old('particular', $payment->particular) }}</textarea>
                            @if($errors->has('particular'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('particular') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.particular_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="unit_price">{{ trans('cruds.payment.fields.unit_price') }}</label>
                            <input class="form-control" type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', $payment->unit_price) }}" step="0.01" required>
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

        </div>
    </div>
</div>
@endsection