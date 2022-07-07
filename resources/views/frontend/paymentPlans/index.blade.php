@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('payment_plan_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.payment-plans.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.paymentPlan.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'PaymentPlan', 'route' => 'admin.payment-plans.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.paymentPlan.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PaymentPlan">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.house') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.due_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.payment_item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.recusive_payment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.cycle_every') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.cycle_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentPlan.fields.no_of_cycle') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($users as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($manage_houses as $key => $item)
                                                <option value="{{ $item->unit_no }}">{{ $item->unit_no }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($payment_items as $key => $item)
                                                <option value="{{ $item->particular }}">{{ $item->particular }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\PaymentPlan::CYCLE_BY_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentPlans as $key => $paymentPlan)
                                    <tr data-entry-id="{{ $paymentPlan->id }}">
                                        <td>
                                            {{ $paymentPlan->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentPlan->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentPlan->user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentPlan->house->unit_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentPlan->due_date ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($paymentPlan->payment_items as $key => $item)
                                                <span>{{ $item->particular }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $paymentPlan->recusive_payment ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $paymentPlan->recusive_payment ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $paymentPlan->cycle_every ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PaymentPlan::CYCLE_BY_SELECT[$paymentPlan->cycle_by] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentPlan->no_of_cycle ?? '' }}
                                        </td>
                                        <td>
                                            @can('payment_plan_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.payment-plans.show', $paymentPlan->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('payment_plan_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.payment-plans.edit', $paymentPlan->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('payment_plan_delete')
                                                <form action="{{ route('frontend.payment-plans.destroy', $paymentPlan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('payment_plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.payment-plans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-PaymentPlan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection