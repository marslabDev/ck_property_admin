@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bill_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.bills.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bill.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Bill', 'route' => 'admin.bills.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bill.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Bill">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bill.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.billplz') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.billplz_url') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.house') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.homeowner') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.billing_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.due_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.bill_item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.bill_charges') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bill.fields.bill_status') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($bill_items as $key => $item)
                                                <option value="{{ $item->total_unit }}">{{ $item->total_unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($bill_charges as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($bill_statuses as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bills as $key => $bill)
                                    <tr data-entry-id="{{ $bill->id }}">
                                        <td>
                                            {{ $bill->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->billplz ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->billplz_url ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->house->unit_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->homeowner->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->homeowner->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->billing_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->due_date ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($bill->bill_items as $key => $item)
                                                <span>{{ $item->total_unit }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($bill->bill_charges as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $bill->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bill->bill_status->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('bill_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.bills.show', $bill->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bill_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.bills.edit', $bill->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bill_delete')
                                                <form action="{{ route('frontend.bills.destroy', $bill->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bill_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.bills.massDestroy') }}",
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
  let table = $('.datatable-Bill:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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