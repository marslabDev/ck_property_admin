@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.notice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title_name">{{ trans('cruds.notice.fields.title_name') }}</label>
                <input class="form-control {{ $errors->has('title_name') ? 'is-invalid' : '' }}" type="text" name="title_name" id="title_name" value="{{ old('title_name', '') }}" required>
                @if($errors->has('title_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notice.fields.title_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.notice.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notice.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="detail">{{ trans('cruds.notice.fields.detail') }}</label>
                <textarea class="form-control {{ $errors->has('detail') ? 'is-invalid' : '' }}" name="detail" id="detail" required>{{ old('detail') }}</textarea>
                @if($errors->has('detail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('detail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notice.fields.detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="create_by_id">{{ trans('cruds.notice.fields.create_by') }}</label>
                <select class="form-control select2 {{ $errors->has('create_by') ? 'is-invalid' : '' }}" name="create_by_id" id="create_by_id">
                    @foreach($create_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('create_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('create_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('create_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notice.fields.create_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="people_in_role_id">{{ trans('cruds.notice.fields.people_in_role') }}</label>
                <select class="form-control select2 {{ $errors->has('people_in_role') ? 'is-invalid' : '' }}" name="people_in_role_id" id="people_in_role_id">
                    @foreach($people_in_roles as $id => $entry)
                        <option value="{{ $id }}" {{ old('people_in_role_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('people_in_role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('people_in_role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notice.fields.people_in_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="people_in_area_id">{{ trans('cruds.notice.fields.people_in_area') }}</label>
                <select class="form-control select2 {{ $errors->has('people_in_area') ? 'is-invalid' : '' }}" name="people_in_area_id" id="people_in_area_id">
                    @foreach($people_in_areas as $id => $entry)
                        <option value="{{ $id }}" {{ old('people_in_area_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('people_in_area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('people_in_area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notice.fields.people_in_area_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.notices.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($notice) && $notice->image)
      var file = {!! json_encode($notice->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection