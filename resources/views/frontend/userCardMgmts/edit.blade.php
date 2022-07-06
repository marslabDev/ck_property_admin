@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.userCardMgmt.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.user-card-mgmts.update", [$userCardMgmt->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="cardholder_name">{{ trans('cruds.userCardMgmt.fields.cardholder_name') }}</label>
                            <input class="form-control" type="text" name="cardholder_name" id="cardholder_name" value="{{ old('cardholder_name', $userCardMgmt->cardholder_name) }}" required>
                            @if($errors->has('cardholder_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cardholder_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userCardMgmt.fields.cardholder_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="card_no">{{ trans('cruds.userCardMgmt.fields.card_no') }}</label>
                            <input class="form-control" type="text" name="card_no" id="card_no" value="{{ old('card_no', $userCardMgmt->card_no) }}" required>
                            @if($errors->has('card_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('card_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userCardMgmt.fields.card_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.userCardMgmt.fields.card_issuer') }}</label>
                            <select class="form-control" name="card_issuer" id="card_issuer" required>
                                <option value disabled {{ old('card_issuer', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\UserCardMgmt::CARD_ISSUER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('card_issuer', $userCardMgmt->card_issuer) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('card_issuer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('card_issuer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userCardMgmt.fields.card_issuer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="expire_date">{{ trans('cruds.userCardMgmt.fields.expire_date') }}</label>
                            <input class="form-control" type="text" name="expire_date" id="expire_date" value="{{ old('expire_date', $userCardMgmt->expire_date) }}" required>
                            @if($errors->has('expire_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expire_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userCardMgmt.fields.expire_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.userCardMgmt.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userCardMgmt->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userCardMgmt.fields.user_helper') }}</span>
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