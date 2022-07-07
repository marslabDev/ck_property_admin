@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.paymentItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-items.update", [$paymentItem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="particular">{{ trans('cruds.paymentItem.fields.particular') }}</label>
                <textarea class="form-control {{ $errors->has('particular') ? 'is-invalid' : '' }}" name="particular" id="particular" required>{{ old('particular', $paymentItem->particular) }}</textarea>
                @if($errors->has('particular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('particular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentItem.fields.particular_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.paymentItem.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $paymentItem->amount) }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentItem.fields.amount_helper') }}</span>
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