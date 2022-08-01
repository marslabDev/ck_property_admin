@can('case_status_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.case-statuses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.caseStatus.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.caseStatus.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-complaintStatusCaseStatuses">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.caseStatus.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.caseStatus.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.caseStatus.fields.status_linking') }}
                        </th>
                        <th>
                            {{ trans('cruds.caseStatus.fields.complaint_status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($caseStatuses as $key => $caseStatus)
                        <tr data-entry-id="{{ $caseStatus->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $caseStatus->id ?? '' }}
                            </td>
                            <td>
                                {{ $caseStatus->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $caseStatus->status_linking ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $caseStatus->status_linking ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $caseStatus->complaint_status->status ?? '' }}
                            </td>
                            <td>
                                @can('case_status_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.case-statuses.show', $caseStatus->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('case_status_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.case-statuses.edit', $caseStatus->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('case_status_delete')
                                    <form action="{{ route('admin.case-statuses.destroy', $caseStatus->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('case_status_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.case-statuses.massDestroy') }}",
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
  let table = $('.datatable-complaintStatusCaseStatuses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection