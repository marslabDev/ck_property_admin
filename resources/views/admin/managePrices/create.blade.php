@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.managePrice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.manage-prices.store', [currentArea()]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="house_type_id">{{ trans('cruds.managePrice.fields.house_type') }}</label>
                <select class="form-control select2 {{ $errors->has('house_type') ? 'is-invalid' : '' }}"
                    name="house_type_id" id="house_type_id" required>
                    @foreach($house_types as $id => $entry)
                    <option value="{{ $id }}" {{ old('house_type_id')==$id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('house_type'))
                <div class="invalid-feedback">
                    {{ $errors->first('house_type') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.managePrice.fields.house_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_per_sq_ft">{{ trans('cruds.managePrice.fields.price_per_sq_ft')
                    }}</label>
                <input class="form-control {{ $errors->has('price_per_sq_ft') ? 'is-invalid' : '' }}" type="number"
                    name="price_per_sq_ft" id="price_per_sq_ft" value="{{ old('price_per_sq_ft', '') }}" step="0.01"
                    required>
                @if($errors->has('price_per_sq_ft'))
                <div class="invalid-feedback">
                    {{ $errors->first('price_per_sq_ft') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.managePrice.fields.price_per_sq_ft_helper') }}</span>
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