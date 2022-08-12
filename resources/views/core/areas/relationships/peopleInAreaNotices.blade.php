@can('notice_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.notices.create', $area) }}">
                {{ trans('global.add') }} {{ trans('cruds.notice.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.notice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-peopleInAreaNotices">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.notice.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.notice.fields.title_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.notice.fields.detail') }}
                        </th>
                        <th>
                            {{ trans('cruds.notice.fields.people_in_role') }}
                        </th>
                        <th>
                            {{ trans('cruds.notice.fields.people_in_area') }}
                        </th>
                        <th>
                            {{ trans('cruds.notice.fields.create_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.notice.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notices as $key => $notice)
                        <tr data-entry-id="{{ $notice->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $notice->id ?? '' }}
                            </td>
                            <td>
                                {{ $notice->title_name ?? '' }}
                            </td>
                            <td>
                                {{ $notice->detail ?? '' }}
                            </td>
                            <td>
                                {{ $notice->people_in_role->title ?? '' }}
                            </td>
                            <td>
                                {{ $notice->people_in_area->name ?? '' }}
                            </td>
                            <td>
                                {{ $notice->create_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $notice->created_at ?? '' }}
                            </td>
                            <td>
                                @can('notice_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.notices.show', $notice->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('notice_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.notices.edit', $notice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('notice_delete')
                                    <form action="{{ route('admin.notices.destroy', $notice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('notice_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.notices.massDestroy', [$area]) }}",
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
  let table = $('.datatable-peopleInAreaNotices:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection