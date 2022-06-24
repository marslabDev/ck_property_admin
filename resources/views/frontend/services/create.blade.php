@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.service.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.services.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.service.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="budget">{{ trans('cruds.service.fields.budget') }}</label>
                            <input class="form-control" type="number" name="budget" id="budget" value="{{ old('budget', '') }}" step="0.01">
                            @if($errors->has('budget'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('budget') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.budget_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.service.fields.urgent_status') }}</label>
                            <select class="form-control" name="urgent_status" id="urgent_status" required>
                                <option value disabled {{ old('urgent_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Service::URGENT_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('urgent_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('urgent_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('urgent_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.urgent_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.service.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.service.fields.target_location') }}</label>
                            <select class="form-control" name="target_location" id="target_location">
                                <option value disabled {{ old('target_location', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Service::TARGET_LOCATION_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('target_location', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('target_location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('target_location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.target_location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.service.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hanlder_by_id">{{ trans('cruds.service.fields.hanlder_by') }}</label>
                            <select class="form-control select2" name="hanlder_by_id" id="hanlder_by_id">
                                @foreach($hanlder_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('hanlder_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('hanlder_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hanlder_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.hanlder_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">{{ trans('cruds.service.fields.supplier') }}</label>
                            <select class="form-control select2" name="supplier_id" id="supplier_id">
                                @foreach($suppliers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('supplier_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('supplier'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('supplier') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.service.fields.supplier_helper') }}</span>
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
    url: '{{ route('frontend.services.storeMedia') }}',
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
@if(isset($service) && $service->image)
      var file = {!! json_encode($service->image) !!}
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