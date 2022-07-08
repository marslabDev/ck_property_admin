@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.homeOwnerTransaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.home-owner-transactions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.homeOwnerTransaction.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeOwnerTransaction.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="house_id">{{ trans('cruds.homeOwnerTransaction.fields.house') }}</label>
                <select class="form-control select2 {{ $errors->has('house') ? 'is-invalid' : '' }}" name="house_id" id="house_id" required>
                    @foreach($houses as $id => $entry)
                        <option value="{{ $id }}" {{ old('house_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('house'))
                    <div class="invalid-feedback">
                        {{ $errors->first('house') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeOwnerTransaction.fields.house_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_plan_id">{{ trans('cruds.homeOwnerTransaction.fields.payment_plan') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_plan') ? 'is-invalid' : '' }}" name="payment_plan_id" id="payment_plan_id" required>
                    @foreach($payment_plans as $id => $entry)
                        <option value="{{ $id }}" {{ old('payment_plan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_plan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_plan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeOwnerTransaction.fields.payment_plan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_type_id">{{ trans('cruds.homeOwnerTransaction.fields.payment_type') }}</label>
                <select class="form-control select2 {{ $errors->has('payment_type') ? 'is-invalid' : '' }}" name="payment_type_id" id="payment_type_id" required>
                    @foreach($payment_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('payment_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeOwnerTransaction.fields.payment_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount_paid">{{ trans('cruds.homeOwnerTransaction.fields.amount_paid') }}</label>
                <input class="form-control {{ $errors->has('amount_paid') ? 'is-invalid' : '' }}" type="number" name="amount_paid" id="amount_paid" value="{{ old('amount_paid', '') }}" step="0.01" required>
                @if($errors->has('amount_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeOwnerTransaction.fields.amount_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="changes">{{ trans('cruds.homeOwnerTransaction.fields.changes') }}</label>
                <input class="form-control {{ $errors->has('changes') ? 'is-invalid' : '' }}" type="number" name="changes" id="changes" value="{{ old('changes', '') }}" step="0.01" required>
                @if($errors->has('changes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('changes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeOwnerTransaction.fields.changes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="details">{{ trans('cruds.homeOwnerTransaction.fields.details') }}</label>
                <textarea class="form-control {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details" id="details">{{ old('details') }}</textarea>
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeOwnerTransaction.fields.details_helper') }}</span>
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