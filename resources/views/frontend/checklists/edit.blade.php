@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.checklist.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.checklists.update", [$checklist->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="supplier_id">{{ trans('cruds.checklist.fields.supplier') }}</label>
                            <select class="form-control select2" name="supplier_id" id="supplier_id" required>
                                @foreach($suppliers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('supplier_id') ? old('supplier_id') : $checklist->supplier->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('supplier') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.checklist.fields.supplier_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="project_id">{{ trans('cruds.checklist.fields.project') }}</label>
                            <select class="form-control select2" name="project_id" id="project_id" required>
                                @foreach($projects as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $checklist->project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.checklist.fields.project_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="due_date">{{ trans('cruds.checklist.fields.due_date') }}</label>
                            <input class="form-control date" type="text" name="due_date" id="due_date" value="{{ old('due_date', $checklist->due_date) }}" required>
                            @if($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.checklist.fields.due_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.checklist.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Checklist::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $checklist->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.checklist.fields.status_helper') }}</span>
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