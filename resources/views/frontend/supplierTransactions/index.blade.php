@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('supplier_transaction_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.supplier-transactions.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.supplierTransaction.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'SupplierTransaction', 'route' => 'admin.supplier-transactions.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.supplierTransaction.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SupplierTransaction">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.project') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.transaction_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.income_source') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.currency') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.transaction_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.supplierTransaction.fields.description') }}
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
                                            @foreach($projects as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($transaction_types as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($income_sources as $key => $item)
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
                                            @foreach($currencies as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplierTransactions as $key => $supplierTransaction)
                                    <tr data-entry-id="{{ $supplierTransaction->id }}">
                                        <td>
                                            {{ $supplierTransaction->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->project->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->transaction_type->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->income_source->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->currency->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->transaction_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $supplierTransaction->description ?? '' }}
                                        </td>
                                        <td>
                                            @can('supplier_transaction_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.supplier-transactions.show', $supplierTransaction->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('supplier_transaction_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.supplier-transactions.edit', $supplierTransaction->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('supplier_transaction_delete')
                                                <form action="{{ route('frontend.supplier-transactions.destroy', $supplierTransaction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('supplier_transaction_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.supplier-transactions.massDestroy') }}",
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
  let table = $('.datatable-SupplierTransaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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