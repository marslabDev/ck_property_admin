@can('my_case_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.my-cases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.myCase.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.myCase.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-reportToMyCases">
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
                            {{ trans('cruds.myCase.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myCases as $key => $myCase)
                        <tr data-entry-id="{{ $myCase->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $myCase->id ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->case_no ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->title ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->opened_at ?? '' }}
                            </td>
                            <td>
                                @foreach($myCase->complaints as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $myCase->category->title ?? '' }}
                            </td>
                            <td>
                                @foreach($myCase->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $myCase->handle_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->handle_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->report_to->name ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->report_to->email ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->created_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $myCase->created_by->email ?? '' }}
                            </td>
                            <td>
                                @can('my_case_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.my-cases.show', $myCase->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('my_case_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.my-cases.edit', $myCase->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('my_case_delete')
                                    <form action="{{ route('admin.my-cases.destroy', $myCase->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('my_case_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.my-cases.massDestroy') }}",
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
  let table = $('.datatable-reportToMyCases:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection