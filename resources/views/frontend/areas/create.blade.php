@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.area.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.areas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.area.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="city">{{ trans('cruds.area.fields.city') }}</label>
                            <input class="form-control" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="postcode">{{ trans('cruds.area.fields.postcode') }}</label>
                            <input class="form-control" type="number" name="postcode" id="postcode" value="{{ old('postcode', '') }}" step="1" required>
                            @if($errors->has('postcode'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('postcode') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.postcode_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="state">{{ trans('cruds.area.fields.state') }}</label>
                            <input class="form-control" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="country">{{ trans('cruds.area.fields.country') }}</label>
                            <input class="form-control" type="text" name="country" id="country" value="{{ old('country', '') }}" required>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.country_helper') }}</span>
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