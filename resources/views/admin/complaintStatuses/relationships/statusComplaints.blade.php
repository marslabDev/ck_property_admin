@can('complaint_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.complaints.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.complaint.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.complaint.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-statusComplaints">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.complaint.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.complaint.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.complaint.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.complaint.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.complaint.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.complaint.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $key => $complaint)
                        <tr data-entry-id="{{ $complaint->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $complaint->id ?? '' }}
                            </td>
                            <td>
                                {{ $complaint->title ?? '' }}
                            </td>
                            <td>
                                {{ $complaint->status->status ?? '' }}
                            </td>
                            <td>
                                @foreach($complaint->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $complaint->created_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $complaint->created_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $complaint->created_at ?? '' }}
                            </td>
                            <td>
                                @can('complaint_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.complaints.show', $complaint->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('complaint_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.complaints.edit', $complaint->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('complaint_delete')
                                    <form action="{{ route('admin.complaints.destroy', $complaint->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('complaint_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.complaints.massDestroy') }}",
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
  let table = $('.datatable-statusComplaints:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection