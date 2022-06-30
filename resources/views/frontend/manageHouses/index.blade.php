@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('manage_house_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.manage-houses.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ManageHouse">
                            <thead>
                                <tr>
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
                                        {{ trans('cruds.manageHouse.fields.taman') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.square_feet') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.house_status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.documents') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.owned_by') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.manageHouse.fields.parking_lot') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\ManageHouse::HOUSE_STATUS_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($parking_lots as $key => $item)
                                                <option value="{{ $item->lot_no }}">{{ $item->lot_no }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manageHouses as $key => $manageHouse)
                                    <tr data-entry-id="{{ $manageHouse->id }}">
                                        <td>
                                            {{ $manageHouse->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $manageHouse->house_type->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $manageHouse->unit_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $manageHouse->floor ?? '' }}
                                        </td>
                                        <td>
                                            {{ $manageHouse->block ?? '' }}
                                        </td>
                                        <td>
                                            {{ $manageHouse->street ?? '' }}
                                        </td>
                                        <td>
                                            {{ $manageHouse->taman ?? '' }}
                                        </td>
                                        <td>
                                            {{ $manageHouse->square_feet ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\ManageHouse::HOUSE_STATUS_SELECT[$manageHouse->house_status] ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($manageHouse->documents as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($manageHouse->owned_bies as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($manageHouse->parking_lots as $key => $item)
                                                <span>{{ $item->lot_no }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('manage_house_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.manage-houses.show', $manageHouse->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('manage_house_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.manage-houses.edit', $manageHouse->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('manage_house_delete')
                                                <form action="{{ route('frontend.manage-houses.destroy', $manageHouse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('manage_house_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.manage-houses.massDestroy') }}",
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
  let table = $('.datatable-ManageHouse:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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