@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="person_in_change">{{ trans('cruds.client.fields.person_in_change') }}</label>
                <input class="form-control {{ $errors->has('person_in_change') ? 'is-invalid' : '' }}" type="text" name="person_in_change" id="person_in_change" value="{{ old('person_in_change', '') }}" required>
                @if($errors->has('person_in_change'))
                    <div class="invalid-feedback">
                        {{ $errors->first('person_in_change') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.person_in_change_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company">{{ trans('cruds.client.fields.company') }}</label>
                <input class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" type="text" name="company" id="company" value="{{ old('company', '') }}">
                @if($errors->has('company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desc">{{ trans('cruds.client.fields.desc') }}</label>
                <input class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" type="text" name="desc" id="desc" value="{{ old('desc', '') }}">
                @if($errors->has('desc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.client.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.client.fields.phone') }}</label>
                <input class="form-control phone_no_mask {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.client.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('website') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="whatapps">{{ trans('cruds.client.fields.whatapps') }}</label>
                <input class="form-control phone_no_mask {{ $errors->has('whatapps') ? 'is-invalid' : '' }}" type="text" name="whatapps" id="whatapps" value="{{ old('whatapps', '') }}" required>
                @if($errors->has('whatapps'))
                    <div class="invalid-feedback">
                        {{ $errors->first('whatapps') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.whatapps_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.client.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}">
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.client.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.status_helper') }}</span>
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