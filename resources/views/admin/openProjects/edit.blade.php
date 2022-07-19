@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.openProject.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.open-projects.update", [$openProject->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.openProject.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $openProject->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.openProject.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.openProject.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $openProject->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.openProject.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="areas">{{ trans('cruds.openProject.fields.area') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('areas') ? 'is-invalid' : '' }}" name="areas[]" id="areas" multiple required>
                    @foreach($areas as $id => $area)
                        <option value="{{ $id }}" {{ (in_array($id, old('areas', [])) || $openProject->areas->contains($id)) ? 'selected' : '' }}>{{ $area }}</option>
                    @endforeach
                </select>
                @if($errors->has('areas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('areas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.openProject.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.openProject.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $openProject->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.openProject.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="budget">{{ trans('cruds.openProject.fields.budget') }}</label>
                <input class="form-control {{ $errors->has('budget') ? 'is-invalid' : '' }}" type="number" name="budget" id="budget" value="{{ old('budget', $openProject->budget) }}" step="0.01">
                @if($errors->has('budget'))
                    <div class="invalid-feedback">
                        {{ $errors->first('budget') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.openProject.fields.budget_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="suppliers">{{ trans('cruds.openProject.fields.supplier') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('suppliers') ? 'is-invalid' : '' }}" name="suppliers[]" id="suppliers" multiple required>
                    @foreach($suppliers as $id => $supplier)
                        <option value="{{ $id }}" {{ (in_array($id, old('suppliers', [])) || $openProject->suppliers->contains($id)) ? 'selected' : '' }}>{{ $supplier }}</option>
                    @endforeach
                </select>
                @if($errors->has('suppliers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('suppliers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.openProject.fields.supplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.openProject.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $openProject->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.openProject.fields.status_helper') }}</span>
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