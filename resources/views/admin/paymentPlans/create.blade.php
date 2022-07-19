@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.paymentPlan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.payment-plans.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.paymentPlan.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id"
                    id="user_id" required>
                    @foreach($users as $id => $entry)
                    <option value="{{ $id }}" {{ old('user_id')==$id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                <div class="invalid-feedback">
                    {{ $errors->first('user') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="house_id">{{ trans('cruds.paymentPlan.fields.house') }}</label>
                <select class="form-control select2 {{ $errors->has('house') ? 'is-invalid' : '' }}" name="house_id"
                    id="house_id" required>
                    @foreach($houses as $id => $entry)
                    <option value="{{ $id }}" {{ old('house_id')==$id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('house'))
                <div class="invalid-feedback">
                    {{ $errors->first('house') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.house_helper') }}</span>
            </div>

            <div class="form-group" id="due_date_field">
                <label class="required" for="due_date">{{ trans('cruds.paymentPlan.fields.due_date') }}</label>
                <input class="form-control datetime {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text"
                    name="due_date" id="due_date" value="{{ old('due_date') }}" required>
                @if($errors->has('due_date'))
                <div class="invalid-feedback">
                    {{ $errors->first('due_date') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.due_date_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="payment_items">{{ trans('cruds.paymentPlan.fields.payment_item') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('payment_items') ? 'is-invalid' : '' }}"
                    name="payment_items[]" id="payment_items" multiple required>
                    @foreach($payment_items as $id => $payment_item)
                    <option value="{{ $id }}" {{ in_array($id, old('payment_items', [])) ? 'selected' : '' }}>{{
                        $payment_item }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_items'))
                <div class="invalid-feedback">
                    {{ $errors->first('payment_items') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.payment_item_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extra_charges">{{ trans('cruds.paymentPlan.fields.extra_charge') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('extra_charges') ? 'is-invalid' : '' }}"
                    name="extra_charges[]" id="extra_charges" multiple>
                    @foreach($extra_charges as $id => $extra_charge)
                    <option value="{{ $id }}" {{ in_array($id, old('extra_charges', [])) ? 'selected' : '' }}>{{
                        $extra_charge }}</option>
                    @endforeach
                </select>
                @if($errors->has('extra_charges'))
                <div class="invalid-feedback">
                    {{ $errors->first('extra_charges') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.extra_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('recusive_payment') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="recusive_payment" value="0">
                    <input class="form-check-input" type="checkbox" name="recusive_payment" id="recusive_payment"
                        value="1">
                    <label class="form-check-label" for="recusive_payment">{{
                        trans('cruds.paymentPlan.fields.recusive_payment') }}</label>
                </div>
                @if($errors->has('recusive_payment'))
                <div class="invalid-feedback">
                    {{ $errors->first('recusive_payment') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentPlan.fields.recusive_payment_helper') }}</span>
            </div>

            <div class="card d-none" id="recusive_payment_section">
                <div class="card-body">
                    <div class="form-group">
                        <label for="cycle_every">{{ trans('cruds.paymentPlan.fields.cycle_every') }}</label>
                        <input class="form-control {{ $errors->has('cycle_every') ? 'is-invalid' : '' }}" type="number"
                            name="cycle_every" id="cycle_every" value="{{ old('cycle_every', '') }}" step="1" disabled>
                        @if($errors->has('cycle_every'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cycle_every') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.paymentPlan.fields.cycle_every_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('cruds.paymentPlan.fields.cycle_by') }}</label>
                        <select class="form-control {{ $errors->has('cycle_by') ? 'is-invalid' : '' }}" name="cycle_by"
                            id="cycle_by" disabled>
                            <option value disabled {{ old('cycle_by', null)===null ? 'selected' : '' }}>{{
                                trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\PaymentPlan::CYCLE_BY_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('cycle_by', '' )===(string) $key ? 'selected' : '' }}>{{
                                $label }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('cycle_by'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cycle_by') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.paymentPlan.fields.cycle_by_helper') }}</span>
                    </div>

                    <div class="form-group" id="due_date_2_field">
                        <label class="required" for="due_date">{{ trans('cruds.paymentPlan.fields.due_date') }}</label>
                        <input class="form-control datetime {{ $errors->has('due_date') ? 'is-invalid' : '' }}"
                            type="text" name="due_date" id="due_date_2" value="{{ old('due_date') }}" required disabled>
                        @if($errors->has('due_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('due_date') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.paymentPlan.fields.due_date_helper') }}</span>
                    </div>

                    <div class="form-group" id="due_day_field">
                        <label class="required">{{ trans('cruds.paymentPlan.fields.due_day') }}</label>
                        <select class="form-control {{ $errors->has('due_day') ? 'is-invalid' : '' }}" name="due_day"
                            id="due_day" required>
                            <option value disabled {{ old('due_day', null)===null ? 'selected' : '' }}>{{
                                trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\PaymentPlan::DUE_DAY_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('due_day', '' )===(string) $key ? 'selected' : '' }}>{{
                                $label }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('due_day'))
                        <div class="invalid-feedback">
                            {{ $errors->first('due_day') }}
                        </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.paymentPlan.fields.due_day_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="no_of_cycle">{{ trans('cruds.paymentPlan.fields.no_of_cycle') }}</label>
                        <input class="form-control {{ $errors->has('no_of_cycle') ? 'is-invalid' : '' }}" type="number"
                            name="no_of_cycle" id="no_of_cycle" value="{{ old('no_of_cycle', '') }}" step="1" disabled>
                        @if($errors->has('no_of_cycle'))
                        <div class="invalid-feedback">
                            {{ $errors->first('no_of_cycle') }}
                        </div>
                        @endif
                        <span class="help-block tw-text-amber-500 tw-font-semibold">{{
                            trans('cruds.paymentPlan.fields.no_of_cycle_helper') }}</span>
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
    $(function () {
        $('#due_day_field').hide();
        $('#due_day').prop('disabled', true);

        console.log($('#recusive_payment').checked);

        $('#recusive_payment').change(function (e) { 
            if (this.checked) {
                $('#recusive_payment_section').removeClass('d-none');

                $('#due_date_field').hide();
                $('#due_date').prop('disabled', true);

                $('#due_date_2').prop('disabled', false);

                $('#cycle_every').prop('disabled', false);
                $('#cycle_by').prop('disabled', false);
                $('#no_of_cycle').prop('disabled', false);
            } else {
                $('#recusive_payment_section').addClass('d-none');

                $('#due_date').hide();
                $('#due_date').prop('disabled', true);

                $('#due_date_field').show();
                $('#due_date').prop('disabled', false);

                $('#due_date_2').prop('disabled', true);

                $('#cycle_every').prop('disabled', true);
                $('#cycle_by').prop('disabled', true);
                $('#no_of_cycle').prop('disabled', true);
            }
        });

        $('#cycle_by').on('change', function (e) {
            console.log(this.value);
            if (this.value === 'WEEK') {
                $('#due_day_field').show();
                $('#due_day').prop('disabled', false);

                $('#due_date_2_field').hide();
                $('#due_date_2').prop('disabled', true);
            } else {
                $('#due_day_field').hide();
                $('#due_day').prop('disabled', true);

                $('#due_date_2_field').show();
                $('#due_date_2').prop('disabled', false);
            }
        });
    });
</script>
@endsection