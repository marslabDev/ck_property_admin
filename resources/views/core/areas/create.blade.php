@extends('layouts.core')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.area.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('core.areas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('core.areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.area.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.area.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city"
                    id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                <div class="invalid-feedback">
                    {{ $errors->first('city') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="postcode">{{ trans('cruds.area.fields.postcode') }}</label>
                <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="number"
                    name="postcode" id="postcode" value="{{ old('postcode', '') }}" step="1" required>
                @if($errors->has('postcode'))
                <div class="invalid-feedback">
                    {{ $errors->first('postcode') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.postcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state">{{ trans('cruds.area.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state"
                    id="state" value="{{ old('state', '') }}" required>
                @if($errors->has('state'))
                <div class="invalid-feedback">
                    {{ $errors->first('state') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="country">{{ trans('cruds.area.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country"
                    id="country" value="{{ old('country', '') }}" required>
                @if($errors->has('country'))
                <div class="invalid-feedback">
                    {{ $errors->first('country') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="users">{{ trans('cruds.area.fields.user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('areas') ? 'is-invalid' : '' }}" name="users[]"
                    id="users" multiple required>
                    @foreach($users as $id => $user)
                    <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $user }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                <div class="invalid-feedback">
                    {{ $errors->first('users') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.user_helper') }}</span>
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