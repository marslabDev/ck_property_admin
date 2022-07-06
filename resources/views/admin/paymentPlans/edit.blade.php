@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.paymentPlan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-plans.update", [$paymentPlan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.paymentPlan.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $paymentPlan->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="house_id">{{ trans('cruds.paymentPlan.fields.house') }}</label>
                <select class="form-control select2 {{ $errors->has('house') ? 'is-invalid' : '' }}" name="house_id" id="house_id" required>
                    @foreach($houses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('house_id') ? old('house_id') : $paymentPlan->house->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('house'))
                    <div class="invalid-feedback">
                        {{ $errors->first('house') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.house_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="due_date">{{ trans('cruds.paymentPlan.fields.due_date') }}</label>
                <input class="form-control datetime {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date', $paymentPlan->due_date) }}" required>
                @if($errors->has('due_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('due_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payments">{{ trans('cruds.paymentPlan.fields.payment') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('payments') ? 'is-invalid' : '' }}" name="payments[]" id="payments" multiple required>
                    @foreach($payments as $id => $payment)
                        <option value="{{ $id }}" {{ (in_array($id, old('payments', [])) || $paymentPlan->payments->contains($id)) ? 'selected' : '' }}>{{ $payment }}</option>
                    @endforeach
                </select>
                @if($errors->has('payments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.payment_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('recusive_payment') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="recusive_payment" value="0">
                    <input class="form-check-input" type="checkbox" name="recusive_payment" id="recusive_payment" value="1" {{ $paymentPlan->recusive_payment || old('recusive_payment', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="recusive_payment">{{ trans('cruds.paymentPlan.fields.recusive_payment') }}</label>
                </div>
                @if($errors->has('recusive_payment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recusive_payment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.recusive_payment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cycle_every">{{ trans('cruds.paymentPlan.fields.cycle_every') }}</label>
                <input class="form-control {{ $errors->has('cycle_every') ? 'is-invalid' : '' }}" type="number" name="cycle_every" id="cycle_every" value="{{ old('cycle_every', $paymentPlan->cycle_every) }}" step="1">
                @if($errors->has('cycle_every'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cycle_every') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.cycle_every_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.paymentPlan.fields.cycle_by') }}</label>
                <select class="form-control {{ $errors->has('cycle_by') ? 'is-invalid' : '' }}" name="cycle_by" id="cycle_by">
                    <option value disabled {{ old('cycle_by', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentPlan::CYCLE_BY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('cycle_by', $paymentPlan->cycle_by) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('cycle_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cycle_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.cycle_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_of_cycle">{{ trans('cruds.paymentPlan.fields.no_of_cycle') }}</label>
                <input class="form-control {{ $errors->has('no_of_cycle') ? 'is-invalid' : '' }}" type="number" name="no_of_cycle" id="no_of_cycle" value="{{ old('no_of_cycle', $paymentPlan->no_of_cycle) }}" step="1">
                @if($errors->has('no_of_cycle'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_of_cycle') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.no_of_cycle_helper') }}</span>
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