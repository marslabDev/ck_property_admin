@can('open_project_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.open-projects.create', $area) }}">
                {{ trans('global.add') }} {{ trans('cruds.openProject.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.openProject.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-areaOpenProjects">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.openProject.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.openProject.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.openProject.fields.documents') }}
                        </th>
                        <th>
                            {{ trans('cruds.openProject.fields.area') }}
                        </th>
                        <th>
                            {{ trans('cruds.openProject.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.openProject.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.openProject.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($openProjects as $key => $openProject)
                        <tr data-entry-id="{{ $openProject->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $openProject->id ?? '' }}
                            </td>
                            <td>
                                {{ $openProject->name ?? '' }}
                            </td>
                            <td>
                                @foreach($openProject->documents as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach($openProject->areas as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $openProject->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $openProject->end_date ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\OpenProject::STATUS_SELECT[$openProject->status] ?? '' }}
                            </td>
                            <td>
                                @can('open_project_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.open-projects.show', $openProject->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('open_project_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.open-projects.edit', $openProject->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('open_project_delete')
                                    <form action="{{ route('admin.open-projects.destroy', $openProject->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('open_project_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.open-projects.massDestroy', $area) }}",
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
  let table = $('.datatable-areaOpenProjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection