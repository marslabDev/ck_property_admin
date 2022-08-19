@extends('layouts.core')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('core.roles.update', [$role->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.role.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $role->name) }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="redirect_to">{{ trans('cruds.role.fields.redirect_to') }}</label>
                <input class="form-control {{ $errors->has('redirect_to') ? 'is-invalid' : '' }}" type="text"
                    name="redirect_to" id="redirect_to" value="{{ old('redirect_to', $role->redirect_to) }}" required>
                @if($errors->has('redirect_to'))
                <div class="invalid-feedback">
                    {{ $errors->first('redirect_to') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.redirect_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}"
                    name="permissions[]" id="permissions" multiple required>
                    @foreach($permissions as $id => $permission)
                    <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->
                        permissions->contains($id)) ? 'selected' : '' }}>{{ $permission }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                <div class="invalid-feedback">
                    {{ $errors->first('permissions') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
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
