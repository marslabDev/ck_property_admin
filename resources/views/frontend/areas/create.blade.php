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
                            <label class="required" for="office_no">{{ trans('cruds.area.fields.office_no') }}</label>
                            <input class="form-control" type="number" name="office_no" id="office_no" value="{{ old('office_no', '') }}" step="0.01" required>
                            @if($errors->has('office_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('office_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.office_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="address_line">{{ trans('cruds.area.fields.address_line') }}</label>
                            <textarea class="form-control" name="address_line" id="address_line" required>{{ old('address_line') }}</textarea>
                            @if($errors->has('address_line'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address_line') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.address_line_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address_line_2">{{ trans('cruds.area.fields.address_line_2') }}</label>
                            <textarea class="form-control" name="address_line_2" id="address_line_2">{{ old('address_line_2') }}</textarea>
                            @if($errors->has('address_line_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address_line_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.address_line_2_helper') }}</span>
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
                            <label class="required" for="price_per_ft">{{ trans('cruds.area.fields.price_per_ft') }}</label>
                            <input class="form-control" type="number" name="price_per_ft" id="price_per_ft" value="{{ old('price_per_ft', '') }}" step="0.01" required>
                            @if($errors->has('price_per_ft'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price_per_ft') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.area.fields.price_per_ft_helper') }}</span>
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