@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userDetail.fields.user') }}</label>
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
                <span class="help-block">{{ trans('cruds.userDetail.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ic_no">{{ trans('cruds.userDetail.fields.ic_no') }}</label>
                <input class="form-control {{ $errors->has('ic_no') ? 'is-invalid' : '' }}" type="text" name="ic_no" id="ic_no" value="{{ old('ic_no', '') }}" required>
                @if($errors->has('ic_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ic_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.ic_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.userDetail.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UserDetail::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.userDetail.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address_line_1">{{ trans('cruds.userDetail.fields.address_line_1') }}</label>
                <textarea class="form-control {{ $errors->has('address_line_1') ? 'is-invalid' : '' }}" name="address_line_1" id="address_line_1" required>{{ old('address_line_1') }}</textarea>
                @if($errors->has('address_line_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_line_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.address_line_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_line_2">{{ trans('cruds.userDetail.fields.address_line_2') }}</label>
                <textarea class="form-control {{ $errors->has('address_line_2') ? 'is-invalid' : '' }}" name="address_line_2" id="address_line_2">{{ old('address_line_2') }}</textarea>
                @if($errors->has('address_line_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_line_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.address_line_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.userDetail.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="postcode">{{ trans('cruds.userDetail.fields.postcode') }}</label>
                <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text" name="postcode" id="postcode" value="{{ old('postcode', '') }}" required>
                @if($errors->has('postcode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('postcode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.postcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state">{{ trans('cruds.userDetail.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="country">{{ trans('cruds.userDetail.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}" required>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userDetail.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger tw-bg-red-500" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection