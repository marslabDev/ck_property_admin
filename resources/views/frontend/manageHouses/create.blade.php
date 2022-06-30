@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.manageHouse.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.manage-houses.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="house_type_id">{{ trans('cruds.manageHouse.fields.house_type') }}</label>
                            <select class="form-control select2" name="house_type_id" id="house_type_id">
                                @foreach($house_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('house_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('house_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('house_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.house_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="unit_no">{{ trans('cruds.manageHouse.fields.unit_no') }}</label>
                            <input class="form-control" type="text" name="unit_no" id="unit_no" value="{{ old('unit_no', '') }}" required>
                            @if($errors->has('unit_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.unit_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="floor">{{ trans('cruds.manageHouse.fields.floor') }}</label>
                            <input class="form-control" type="text" name="floor" id="floor" value="{{ old('floor', '') }}">
                            @if($errors->has('floor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('floor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.floor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="block">{{ trans('cruds.manageHouse.fields.block') }}</label>
                            <input class="form-control" type="text" name="block" id="block" value="{{ old('block', '') }}">
                            @if($errors->has('block'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('block') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.block_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="street">{{ trans('cruds.manageHouse.fields.street') }}</label>
                            <input class="form-control" type="text" name="street" id="street" value="{{ old('street', '') }}" required>
                            @if($errors->has('street'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('street') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.street_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="taman">{{ trans('cruds.manageHouse.fields.taman') }}</label>
                            <input class="form-control" type="text" name="taman" id="taman" value="{{ old('taman', '') }}" required>
                            @if($errors->has('taman'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('taman') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.taman_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="square_feet">{{ trans('cruds.manageHouse.fields.square_feet') }}</label>
                            <input class="form-control" type="number" name="square_feet" id="square_feet" value="{{ old('square_feet', '') }}" step="0.01" required>
                            @if($errors->has('square_feet'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('square_feet') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.square_feet_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.manageHouse.fields.house_status') }}</label>
                            <select class="form-control" name="house_status" id="house_status" required>
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
                            <label for="documents">{{ trans('cruds.manageHouse.fields.documents') }}</label>
                            <div class="needsclick dropzone" id="documents-dropzone">
                            </div>
                            @if($errors->has('documents'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('documents') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageHouse.fields.documents_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="parking_lot_id">{{ trans('cruds.manageHouse.fields.parking_lot') }}</label>
                            <select class="form-control select2" name="parking_lot_id" id="parking_lot_id">
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
                            <label for="owned_bies">{{ trans('cruds.manageHouse.fields.owned_by') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="owned_bies[]" id="owned_bies" multiple>
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

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedDocumentsMap = {}
Dropzone.options.documentsDropzone = {
    url: '{{ route('frontend.manage-houses.storeMedia') }}',
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