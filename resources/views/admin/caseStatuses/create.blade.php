@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.caseStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.case-statuses.store', [currentArea()]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.caseStatus.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseStatus.fields.name_helper') }}</span>
            </div>

            <div class="form-group">
                <div class="form-check {{ $errors->has('status_linking') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status_linking" value="0">
                    <input class="form-check-input" type="checkbox" name="status_linking" id="status_linking" value="1"
                        {{ old('status_linking', 0)==1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_linking">{{
                        trans('cruds.caseStatus.fields.status_linking') }}</label>
                </div>
                @if($errors->has('status_linking'))
                <div class="invalid-feedback">
                    {{ $errors->first('status_linking') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.caseStatus.fields.status_linking_helper') }}</span>
            </div>

            <div class="card d-none" id="status_linking_field">
                <div class="card-body">
                    <div class="form-group">
                        <label for="complaint_status_id required">{{
                            trans('cruds.caseStatus.fields.complaint_status') }}</label>
                        <select class="form-control select2 {{ $errors->has('complaint_status') ? 'is-invalid' : '' }}"
                            name="complaint_status_id" id="complaint_status_id">
                            @foreach($complaint_statuses as $id => $entry)
                            <option value="{{ $id }}" {{ old('complaint_status_id')==$id ? 'selected' : '' }}>{{ $entry
                                }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('complaint_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('complaint_status') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.caseStatus.fields.complaint_status_helper') }}</span>
                    </div>
                </div>
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
@parent
<script>
    $(document).ready(function() {
        const complaint_status = $('#complaint_status_id');
        const status_linking = $('#status_linking');
        const status_linking_field = $('#status_linking_field');

        complaint_status.prop('disabled', true);

        status_linking.on('change', function (e) {
            if (e.target.checked) {
                status_linking_field.removeClass('d-none');
                complaint_status.prop('disabled', false);
            } else {
                status_linking_field.addClass('d-none');
                complaint_status.prop('disabled', true);
            }
        });
    });
</script>

@endsection