@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.supplierProposal.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.supplier-proposals.update", [$supplierProposal->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="representative_name">{{ trans('cruds.supplierProposal.fields.representative_name') }}</label>
                            <input class="form-control" type="text" name="representative_name" id="representative_name" value="{{ old('representative_name', $supplierProposal->representative_name) }}" required>
                            @if($errors->has('representative_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('representative_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierProposal.fields.representative_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="contact_no">{{ trans('cruds.supplierProposal.fields.contact_no') }}</label>
                            <input class="form-control" type="text" name="contact_no" id="contact_no" value="{{ old('contact_no', $supplierProposal->contact_no) }}" required>
                            @if($errors->has('contact_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierProposal.fields.contact_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="documents">{{ trans('cruds.supplierProposal.fields.documents') }}</label>
                            <div class="needsclick dropzone" id="documents-dropzone">
                            </div>
                            @if($errors->has('documents'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('documents') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierProposal.fields.documents_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="open_project_id">{{ trans('cruds.supplierProposal.fields.open_project') }}</label>
                            <select class="form-control select2" name="open_project_id" id="open_project_id" required>
                                @foreach($open_projects as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('open_project_id') ? old('open_project_id') : $supplierProposal->open_project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('open_project'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('open_project') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.supplierProposal.fields.open_project_helper') }}</span>
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
    var uploadedDocumentsMap = {}
Dropzone.options.documentsDropzone = {
    url: '{{ route('frontend.supplier-proposals.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="documents[]" value="' + response.name + '">')
      uploadedDocumentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentsMap[file.name]
      }
      $('form').find('input[name="documents[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($supplierProposal) && $supplierProposal->documents)
          var files =
            {!! json_encode($supplierProposal->documents) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="documents[]" value="' + file.file_name + '">')
            }
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