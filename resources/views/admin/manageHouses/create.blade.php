@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.manageHouse.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.manage-houses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="unit_no">{{ trans('cruds.manageHouse.fields.unit_no') }}</label>
                <input class="form-control {{ $errors->has('unit_no') ? 'is-invalid' : '' }}" type="text" name="unit_no" id="unit_no" value="{{ old('unit_no', '') }}" required>
                @if($errors->has('unit_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.unit_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_name">{{ trans('cruds.manageHouse.fields.contact_name') }}</label>
                <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', '') }}">
                @if($errors->has('contact_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_no">{{ trans('cruds.manageHouse.fields.contact_no') }}</label>
                <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="number" name="contact_no" id="contact_no" value="{{ old('contact_no', '') }}" step="0.01">
                @if($errors->has('contact_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.contact_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.manageHouse.fields.house_status') }}</label>
                <select class="form-control {{ $errors->has('house_status') ? 'is-invalid' : '' }}" name="house_status" id="house_status" required>
                    <option value disabled {{ old('house_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ManageHouse::HOUSE_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('house_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('house_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('house_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.house_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="spuare_feet">{{ trans('cruds.manageHouse.fields.spuare_feet') }}</label>
                <input class="form-control {{ $errors->has('spuare_feet') ? 'is-invalid' : '' }}" type="number" name="spuare_feet" id="spuare_feet" value="{{ old('spuare_feet', '') }}" step="1" required>
                @if($errors->has('spuare_feet'))
                    <div class="invalid-feedback">
                        {{ $errors->first('spuare_feet') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.spuare_feet_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parking_lot_id">{{ trans('cruds.manageHouse.fields.parking_lot') }}</label>
                <select class="form-control select2 {{ $errors->has('parking_lot') ? 'is-invalid' : '' }}" name="parking_lot_id" id="parking_lot_id">
                    @foreach($parking_lots as $id => $entry)
                        <option value="{{ $id }}" {{ old('parking_lot_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('parking_lot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parking_lot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.parking_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="documents">{{ trans('cruds.manageHouse.fields.documents') }}</label>
                <div class="needsclick dropzone {{ $errors->has('documents') ? 'is-invalid' : '' }}" id="documents-dropzone">
                </div>
                @if($errors->has('documents'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documents') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.documents_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="owned_bies">{{ trans('cruds.manageHouse.fields.owned_by') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('owned_bies') ? 'is-invalid' : '' }}" name="owned_bies[]" id="owned_bies" multiple>
                    @foreach($owned_bies as $id => $owned_by)
                        <option value="{{ $id }}" {{ in_array($id, old('owned_bies', [])) ? 'selected' : '' }}>{{ $owned_by }}</option>
                    @endforeach
                </select>
                @if($errors->has('owned_bies'))
                    <div class="invalid-feedback">
                        {{ $errors->first('owned_bies') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.owned_by_helper') }}</span>
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
    var uploadedDocumentsMap = {}
Dropzone.options.documentsDropzone = {
    url: '{{ route('admin.manage-houses.storeMedia') }}',
    maxFilesize: 100, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100
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
@if(isset($manageHouse) && $manageHouse->documents)
          var files =
            {!! json_encode($manageHouse->documents) !!}
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