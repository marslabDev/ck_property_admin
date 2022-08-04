@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.article.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.articles.update", [$article->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title_name">{{ trans('cruds.article.fields.title_name') }}</label>
                            <input class="form-control" type="text" name="title_name" id="title_name" value="{{ old('title_name', $article->title_name) }}" required>
                            @if($errors->has('title_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.article.fields.title_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.article.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.article.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="detail">{{ trans('cruds.article.fields.detail') }}</label>
                            <textarea class="form-control" name="detail" id="detail" required>{{ old('detail', $article->detail) }}</textarea>
                            @if($errors->has('detail'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('detail') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.article.fields.detail_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="create_by_id">{{ trans('cruds.article.fields.create_by') }}</label>
                            <select class="form-control select2" name="create_by_id" id="create_by_id">
                                @foreach($create_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('create_by_id') ? old('create_by_id') : $article->create_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('create_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('create_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.article.fields.create_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="people_in_role_id">{{ trans('cruds.article.fields.people_in_role') }}</label>
                            <select class="form-control select2" name="people_in_role_id" id="people_in_role_id">
                                @foreach($people_in_roles as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('people_in_role_id') ? old('people_in_role_id') : $article->people_in_role->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('people_in_role'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('people_in_role') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.article.fields.people_in_role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="people_in_area_id">{{ trans('cruds.article.fields.people_in_area') }}</label>
                            <select class="form-control select2" name="people_in_area_id" id="people_in_area_id">
                                @foreach($people_in_areas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('people_in_area_id') ? old('people_in_area_id') : $article->people_in_area->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('people_in_area'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('people_in_area') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.article.fields.people_in_area_helper') }}</span>
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
    url: '{{ route('frontend.articles.storeMedia') }}',
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
@if(isset($article) && $article->image)
      var file = {!! json_encode($article->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
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