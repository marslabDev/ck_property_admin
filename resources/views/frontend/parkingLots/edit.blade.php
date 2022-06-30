@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.parkingLot.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.parking-lots.update", [$parkingLot->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="lot_no">{{ trans('cruds.parkingLot.fields.lot_no') }}</label>
                            <input class="form-control" type="text" name="lot_no" id="lot_no" value="{{ old('lot_no', $parkingLot->lot_no) }}" required>
                            @if($errors->has('lot_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lot_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.parkingLot.fields.lot_no_helper') }}</span>
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