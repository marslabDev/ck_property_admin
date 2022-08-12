@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.manageHouse.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.manage-houses.update', [currentArea(), $manageHouse->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group" id="street_id_field">
                <label class="required" for="street_id">{{ trans('cruds.manageHouse.fields.street') }}</label>
                <select class="form-control select2 {{ $errors->has('street') ? 'is-invalid' : '' }}" name="street_id"
                    id="street_id" required>
                </select>
                @if($errors->has('street'))
                <div class="invalid-feedback">
                    {{ $errors->first('street') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.street_helper') }}</span>
            </div>


            <div class="form-group" id="house_type_id_field">
                <label for="house_type_id">{{ trans('cruds.manageHouse.fields.house_type') }}</label>
                <select class="form-control select2 {{ $errors->has('house_type') ? 'is-invalid' : '' }}"
                    name="house_type_id" id="house_type_id">
                </select>
                @if($errors->has('house_type'))
                <div class="invalid-feedback">
                    {{ $errors->first('house_type') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.house_type_helper') }}</span>
            </div>

            <hr class="tw-mb-3">

            <div class="form-group">
                <label class="required" for="unit_no">{{ trans('cruds.manageHouse.fields.unit_no') }}</label>
                <input class="form-control {{ $errors->has('unit_no') ? 'is-invalid' : '' }}" type="text" name="unit_no"
                    id="unit_no" value="{{ old('unit_no', $manageHouse->unit_no) }}" required>
                @if($errors->has('unit_no'))
                <div class="invalid-feedback">
                    {{ $errors->first('unit_no') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.unit_no_helper') }}</span>
            </div>


            <div class="card" id="high_rise_fields">
                <div class="card-body">
                    <div class="form-group">
                        <label for="floor">{{ trans('cruds.manageHouse.fields.floor') }}</label>
                        <input class="form-control {{ $errors->has('floor') ? 'is-invalid' : '' }}" type="text"
                            name="floor" id="floor" value="{{ old('floor', $manageHouse->floor) }}" required>
                        @if($errors->has('floor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('floor') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.manageHouse.fields.floor_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="block">{{ trans('cruds.manageHouse.fields.block') }}</label>
                        <input class="form-control {{ $errors->has('block') ? 'is-invalid' : '' }}" type="text"
                            name="block" id="block" value="{{ old('block', $manageHouse->block) }}">
                        @if($errors->has('block'))
                        <div class="invalid-feedback">
                            {{ $errors->first('block') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.manageHouse.fields.block_helper') }}</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="required" for="square_feet">{{ trans('cruds.manageHouse.fields.square_feet') }}</label>
                <input class="form-control {{ $errors->has('square_feet') ? 'is-invalid' : '' }}" type="number"
                    name="square_feet" id="square_feet" value="{{ old('square_feet', $manageHouse->square_feet) }}"
                    step="0.01" required>
                @if($errors->has('square_feet'))
                <div class="invalid-feedback">
                    {{ $errors->first('square_feet') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.square_feet_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parking_lots">{{ trans('cruds.manageHouse.fields.parking_lot') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('parking_lots') ? 'is-invalid' : '' }}"
                    name="parking_lots[]" id="parking_lots" multiple>
                    @foreach($parking_lots as $id => $parking_lot)
                    <option value="{{ $id }}" {{ (in_array($id, old('parking_lots', [])) || $manageHouse->
                        parking_lots->contains($id)) ? 'selected' : '' }}>{{ $parking_lot }}</option>
                    @endforeach
                </select>
                @if($errors->has('parking_lots'))
                <div class="invalid-feedback">
                    {{ $errors->first('parking_lots') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.parking_lot_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="documents">{{ trans('cruds.manageHouse.fields.documents') }}</label>
                <div class="needsclick dropzone {{ $errors->has('documents') ? 'is-invalid' : '' }}"
                    id="documents-dropzone">
                </div>
                @if($errors->has('documents'))
                <div class="invalid-feedback">
                    {{ $errors->first('documents') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.documents_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="house_status_id">{{ trans('cruds.manageHouse.fields.house_status')
                    }}</label>
                <select class="form-control select2 {{ $errors->has('house_status') ? 'is-invalid' : '' }}"
                    name="house_status_id" id="house_status_id" required>
                    @foreach($house_statuses as $id => $entry)
                    <option value="{{ $id }}" {{ (old('house_status_id') ? old('house_status_id') : $manageHouse->
                        house_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="owned_bies">{{ trans('cruds.manageHouse.fields.owned_by') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('owned_bies') ? 'is-invalid' : '' }}"
                    name="owned_bies[]" id="owned_bies" multiple>
                    @foreach($owned_bies as $id => $owned_by)
                    <option value="{{ $id }}" {{ (in_array($id, old('owned_bies', [])) || $manageHouse->
                        owned_bies->contains($id)) ? 'selected' : '' }}>{{ $owned_by }}</option>
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
                <label class="required" for="contact_person_id">{{ trans('cruds.manageHouse.fields.contact_person')
                    }}</label>
                <select class="form-control select2 {{ $errors->has('contact_person') ? 'is-invalid' : '' }}"
                    name="contact_person_id" id="contact_person_id" required>
                    @foreach($contact_people as $contact_person)
                    <option value="{{ $contact_person->id }}" {{ (old('contact_person_id') ? old('contact_person_id') :
                        $manageHouse->
                        contact_person->id ?? '') == $contact_person->id ? 'selected' : '' }}>
                        {{ $contact_person->phone_no }} ({{ $contact_person->name }})
                    </option>
                    @endforeach
                </select>
                @if($errors->has('contact_person'))
                <div class="invalid-feedback">
                    {{ $errors->first('contact_person') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.contact_person_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_person_2_id">{{ trans('cruds.manageHouse.fields.contact_person_2') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_person_2') ? 'is-invalid' : '' }}"
                    name="contact_person_2_id" id="contact_person_2_id">
                    @foreach($contact_person_2s as $contact_person_2)
                    <option value="{{ $contact_person_2->id }}" {{ (old('contact_person_2_id') ?
                        old('contact_person_2_id') : $manageHouse->contact_person_2->id ?? '') == $contact_person_2->id
                        ? 'selected' : ''
                        }}>
                        {{ $contact_person_2->phone_no }} ({{ $contact_person_2->name }})
                    </option>
                    @endforeach
                </select>
                @if($errors->has('contact_person_2'))
                <div class="invalid-feedback">
                    {{ $errors->first('contact_person_2') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.manageHouse.fields.contact_person_2_helper') }}</span>
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
@include('admin.manageHouses.scripts.scripts', ['area' => currentArea()])
<script>
    var uploadedDocumentsMap = {}
    Dropzone.options.documentsDropzone = {
    url: '{{ route('admin.manage-houses.storeMedia', currentArea()) }}',
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
                var files = {!! json_encode($manageHouse->documents) !!};
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

        return _results;
    }
    }
</script>
@endsection