@extends('layouts.admin')
@section('content')
@can('my_case_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.my-cases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.myCase.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'MyCase', 'route' => 'admin.my-cases.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.myCase.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MyCase">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.urgent_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.progress') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.date_reported') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.report_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.handle_by') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('my_case_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.my-cases.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.my-cases.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'category_title', name: 'category.title' },
{ data: 'urgent_status', name: 'urgent_status' },
{ data: 'progress', name: 'progress' },
{ data: 'date_reported', name: 'date_reported' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'report_by_name', name: 'report_by.name' },
{ data: 'handle_by_name', name: 'handle_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-MyCase').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection