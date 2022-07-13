@can('manage_house_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.manage-houses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.manageHouse.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.manageHouse.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-houseTypeManageHouses">
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
                            {{ trans('cruds.manageHouse.fields.area') }}
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
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manageHouses as $key => $manageHouse)
                        <tr data-entry-id="{{ $manageHouse->id }}">
                            <td>

                            </td>
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
                                {{ $manageHouse->area->name ?? '' }}
                            </td>
                            <td>
                                {{ $manageHouse->street->street_name ?? '' }}
                            </td>
                            <td>
                                {{ $manageHouse->square_feet ?? '' }}
                            </td>
                            <td>
                                @foreach($manageHouse->parking_lots as $key => $item)
                                    <span class="badge badge-info">{{ $item->lot_no }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($manageHouse->documents as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $manageHouse->house_status->status ?? '' }}
                            </td>
                            <td>
                                @foreach($manageHouse->owned_bies as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $manageHouse->contact_person->phone_no ?? '' }}
                            </td>
                            <td>
                                {{ $manageHouse->contact_person_2->phone_no ?? '' }}
                            </td>
                            <td>
                                {{ $manageHouse->contact_person_2->phone_no ?? '' }}
                            </td>
                            <td>
                                @can('manage_house_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.manage-houses.show', $manageHouse->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('manage_house_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.manage-houses.edit', $manageHouse->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('manage_house_delete')
                                    <form action="{{ route('admin.manage-houses.destroy', $manageHouse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('manage_house_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.manage-houses.massDestroy') }}",
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
  let table = $('.datatable-houseTypeManageHouses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection