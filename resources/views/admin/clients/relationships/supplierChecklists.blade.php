@can('checklist_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.checklists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.checklist.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.checklist.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-supplierChecklists">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.checklist.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.checklist.fields.supplier') }}
                        </th>
                        <th>
                            {{ trans('cruds.checklist.fields.project') }}
                        </th>
                        <th>
                            {{ trans('cruds.checklist.fields.due_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.checklist.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checklists as $key => $checklist)
                        <tr data-entry-id="{{ $checklist->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $checklist->id ?? '' }}
                            </td>
                            <td>
                                {{ $checklist->supplier->company ?? '' }}
                            </td>
                            <td>
                                {{ $checklist->project->name ?? '' }}
                            </td>
                            <td>
                                {{ $checklist->due_date ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Checklist::STATUS_SELECT[$checklist->status] ?? '' }}
                            </td>
                            <td>
                                @can('checklist_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.checklists.show', $checklist->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('checklist_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.checklists.edit', $checklist->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('checklist_delete')
                                    <form action="{{ route('admin.checklists.destroy', $checklist->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('checklist_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.checklists.massDestroy') }}",
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
  let table = $('.datatable-supplierChecklists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection