@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.maintanance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.maintanances.store', [currentArea()]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="type_id">{{ trans('cruds.maintanance.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id" required>
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maintanance.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_maintanance">{{ trans('cruds.maintanance.fields.date_maintanance') }}</label>
                <input class="form-control date {{ $errors->has('date_maintanance') ? 'is-invalid' : '' }}" type="text" name="date_maintanance" id="date_maintanance" value="{{ old('date_maintanance') }}">
                @if($errors->has('date_maintanance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_maintanance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maintanance.fields.date_maintanance_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="area_id">{{ trans('cruds.maintanance.fields.area') }}</label>
                <select class="form-control select2 {{ $errors->has('area') ? 'is-invalid' : '' }}" name="area_id" id="area_id" required>
                    @foreach($areas as $id => $entry)
                        <option value="{{ $id }}" {{ old('area_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maintanance.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="handle_by_id">{{ trans('cruds.maintanance.fields.handle_by') }}</label>
                <select class="form-control select2 {{ $errors->has('handle_by') ? 'is-invalid' : '' }}" name="handle_by_id" id="handle_by_id" required>
                    @foreach($handle_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('handle_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('handle_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('handle_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maintanance.fields.handle_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="supplier_id">{{ trans('cruds.maintanance.fields.supplier') }}</label>
                <select class="form-control select2 {{ $errors->has('supplier') ? 'is-invalid' : '' }}" name="supplier_id" id="supplier_id" required>
                    @foreach($suppliers as $id => $entry)
                        <option value="{{ $id }}" {{ old('supplier_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('supplier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supplier') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maintanance.fields.supplier_helper') }}</span>
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