@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.parkingLot.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.parking-lots.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="lot_no">{{ trans('cruds.parkingLot.fields.lot_no') }}</label>
                <input class="form-control {{ $errors->has('lot_no') ? 'is-invalid' : '' }}" type="text" name="lot_no"
                    id="lot_no" value="{{ old('lot_no', '') }}" required>
                @if($errors->has('lot_no'))
                <div class="invalid-feedback">
                    {{ $errors->first('lot_no') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.parkingLot.fields.lot_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="floor">{{ trans('cruds.parkingLot.fields.floor') }}</label>
                <input class="form-control {{ $errors->has('floor') ? 'is-invalid' : '' }}" type="number" name="floor"
                    id="floor" value="{{ old('floor', '') }}" step="1">
                @if($errors->has('floor'))
                <div class="invalid-feedback">
                    {{ $errors->first('floor') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.parkingLot.fields.floor_helper') }}</span>
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