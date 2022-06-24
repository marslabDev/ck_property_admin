@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.myCase.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.my-cases.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.myCase.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.myCase.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location">{{ trans('cruds.myCase.fields.location') }}</label>
                            <input class="form-control" type="text" name="location" id="location" value="{{ old('location', '') }}" required>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="urgent_status">{{ trans('cruds.myCase.fields.urgent_status') }}</label>
                            <input class="form-control" type="text" name="urgent_status" id="urgent_status" value="{{ old('urgent_status', '') }}" required>
                            @if($errors->has('urgent_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('urgent_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.urgent_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="progress">{{ trans('cruds.myCase.fields.progress') }}</label>
                            <input class="form-control" type="text" name="progress" id="progress" value="{{ old('progress', '') }}">
                            @if($errors->has('progress'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('progress') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.progress_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date_reported">{{ trans('cruds.myCase.fields.date_reported') }}</label>
                            <input class="form-control date" type="text" name="date_reported" id="date_reported" value="{{ old('date_reported') }}" required>
                            @if($errors->has('date_reported'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_reported') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.date_reported_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.myCase.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.myCase.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="report_by_id">{{ trans('cruds.myCase.fields.report_by') }}</label>
                            <select class="form-control select2" name="report_by_id" id="report_by_id" required>
                                @foreach($report_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('report_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('report_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('report_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.report_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="handle_by_id">{{ trans('cruds.myCase.fields.handle_by') }}</label>
                            <select class="form-control select2" name="handle_by_id" id="handle_by_id" required>
                                @foreach($handle_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('handle_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('handle_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('handle_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myCase.fields.handle_by_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('frontend.my-cases.storeMedia') }}',
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
@if(isset($myCase) && $myCase->image)
      var file = {!! json_encode($myCase->image) !!}
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