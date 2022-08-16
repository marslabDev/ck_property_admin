@extends('layouts.admin')
@section('content')
@can('my_case_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.my-cases.create', [currentArea()]) }}">
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
                        {{ trans('cruds.myCase.fields.case_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.opened_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.complaint') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.handle_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.report_to') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.from_area') }}
                    </th>
                    <th>
                        {{ trans('cruds.myCase.fields.created_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($complaints as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($cases_categories as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($case_statuses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                            @foreach($areas as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
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
    url: "{{ route('admin.my-cases.massDestroy', [currentArea()]) }}",
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
    ajax: "{{ route('admin.my-cases.index', [currentArea()]) }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'case_no', name: 'case_no' },
{ data: 'title', name: 'title' },
{ data: 'opened_at', name: 'opened_at' },
{ data: 'complaint', name: 'complaints.title' },
{ data: 'category_title', name: 'category.title' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'status_name', name: 'status.name' },
{ data: 'handle_by_name', name: 'handle_by.name' },
{ data: 'handle_by.email', name: 'handle_by.email' },
{ data: 'report_to_name', name: 'report_to.name' },
{ data: 'report_to.email', name: 'report_to.email' },
{ data: 'from_area_name', name: 'from_area.name' },
{ data: 'created_by_name', name: 'created_by.name' },
{ data: 'created_by.email', name: 'created_by.email' },
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
});

</script>
@endsection