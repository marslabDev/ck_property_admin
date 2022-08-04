@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.street.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.streets.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="street_name">{{ trans('cruds.street.fields.street_name') }}</label>
                            <textarea class="form-control" name="street_name" id="street_name" required>{{ old('street_name') }}</textarea>
                            @if($errors->has('street_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('street_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.street.fields.street_name_helper') }}</span>
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