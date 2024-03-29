@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.street.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.streets.update", [$street->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="street_name">{{ trans('cruds.street.fields.street_name') }}</label>
                <textarea class="form-control {{ $errors->has('street_name') ? 'is-invalid' : '' }}" name="street_name" id="street_name" required>{{ old('street_name', $street->street_name) }}</textarea>
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



@endsection