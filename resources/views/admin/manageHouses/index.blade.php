@extends('layouts.admin')
@section('content')
@can('manage_house_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.manage-houses.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.manageHouse.title_singular') }}
        </a>
        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
            {{ trans('global.app_csvImport') }}
        </button>
        @include('csvImport.modal', ['model' => 'ManageHouse', 'route' => 'admin.manage-houses.parseCsvImport'])
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.manageHouse.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ManageHouse">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.house_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.unit_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.floor') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.block') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.street') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.square_feet') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.parking_lot') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.documents') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.house_status') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.owned_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.contact_person') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.contact_person_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.phone_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.manageHouse.fields.from_area') }}
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
                            @foreach($house_types as $key => $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
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
                            @foreach($areas as $key => $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($streets as $key => $item)
                            <option value="{{ $item->street_name }}">{{ $item->street_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($parking_lots as $key => $item)
                            <option value="{{ $item->lot_no }}">{{ $item->lot_no }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($house_statuses as $key => $item)
                            <option value="{{ $item->status }}">{{ $item->status }}</option>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                            <option value="{{ $item->phone_no }}">{{ $item->phone_no }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                            <option value="{{ $item->phone_no }}">{{ $item->phone_no }}</option>
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
@can('manage_house_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.manage-houses.massDestroy') }}",
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
    ajax: "{{ route('admin.manage-houses.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'house_type_name', name: 'house_type.name' },
{ data: 'unit_no', name: 'unit_no' },
{ data: 'floor', name: 'floor' },
{ data: 'block', name: 'block' },
{ data: 'street_street_name', name: 'street.street_name' },
{ data: 'square_feet', name: 'square_feet' },
{ data: 'parking_lot', name: 'parking_lots.lot_no' },
{ data: 'documents', name: 'documents', sortable: false, searchable: false },
{ data: 'house_status_status', name: 'house_status.status' },
{ data: 'owned_by', name: 'owned_bies.name' },
{ data: 'contact_person_phone_no', name: 'contact_person.phone_no' },
{ data: 'contact_person_2_phone_no', name: 'contact_person_2.phone_no' },
{ data: 'contact_person_2.phone_no', name: 'contact_person_2.phone_no' },
{ data: 'from_area_name', name: 'from_area.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ManageHouse').DataTable(dtOverrideGlobals);
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