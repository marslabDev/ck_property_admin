@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.bill.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bills.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="billplz">{{ trans('cruds.bill.fields.billplz') }}</label>
                            <input class="form-control" type="text" name="billplz" id="billplz" value="{{ old('billplz', '') }}" required>
                            @if($errors->has('billplz'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('billplz') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.billplz_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="billplz_url">{{ trans('cruds.bill.fields.billplz_url') }}</label>
                            <input class="form-control" type="text" name="billplz_url" id="billplz_url" value="{{ old('billplz_url', '') }}" required>
                            @if($errors->has('billplz_url'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('billplz_url') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.billplz_url_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bill_type_id">{{ trans('cruds.bill.fields.bill_type') }}</label>
                            <select class="form-control select2" name="bill_type_id" id="bill_type_id" required>
                                @foreach($bill_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('bill_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bill_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bill_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.bill_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="house_id">{{ trans('cruds.bill.fields.house') }}</label>
                            <select class="form-control select2" name="house_id" id="house_id" required>
                                @foreach($houses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('house_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('house'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('house') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.house_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="homeowner_id">{{ trans('cruds.bill.fields.homeowner') }}</label>
                            <select class="form-control select2" name="homeowner_id" id="homeowner_id" required>
                                @foreach($homeowners as $id => $entry)
                                    <option value="{{ $id }}" {{ old('homeowner_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('homeowner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('homeowner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.homeowner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="billing_date">{{ trans('cruds.bill.fields.billing_date') }}</label>
                            <input class="form-control date" type="text" name="billing_date" id="billing_date" value="{{ old('billing_date') }}" required>
                            @if($errors->has('billing_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('billing_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.billing_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="due_date">{{ trans('cruds.bill.fields.due_date') }}</label>
                            <input class="form-control date" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}" required>
                            @if($errors->has('due_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('due_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.due_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bill_items">{{ trans('cruds.bill.fields.bill_item') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="bill_items[]" id="bill_items" multiple required>
                                @foreach($bill_items as $id => $bill_item)
                                    <option value="{{ $id }}" {{ in_array($id, old('bill_items', [])) ? 'selected' : '' }}>{{ $bill_item }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bill_items'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bill_items') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.bill_item_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bill_charges">{{ trans('cruds.bill.fields.bill_charges') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="bill_charges[]" id="bill_charges" multiple>
                                @foreach($bill_charges as $id => $bill_charge)
                                    <option value="{{ $id }}" {{ in_array($id, old('bill_charges', [])) ? 'selected' : '' }}>{{ $bill_charge }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bill_charges'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bill_charges') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.bill_charges_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.bill.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bill_status_id">{{ trans('cruds.bill.fields.bill_status') }}</label>
                            <select class="form-control select2" name="bill_status_id" id="bill_status_id" required>
                                @foreach($bill_statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('bill_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bill_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bill_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bill.fields.bill_status_helper') }}</span>
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