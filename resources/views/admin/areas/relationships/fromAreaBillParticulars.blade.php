@can('bill_particular_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bill-particulars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.billParticular.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.billParticular.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-fromAreaBillParticulars">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.billParticular.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.billParticular.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.billParticular.fields.unit_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.billParticular.fields.uom') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billParticulars as $key => $billParticular)
                        <tr data-entry-id="{{ $billParticular->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $billParticular->id ?? '' }}
                            </td>
                            <td>
                                {{ $billParticular->name ?? '' }}
                            </td>
                            <td>
                                {{ $billParticular->unit_price ?? '' }}
                            </td>
                            <td>
                                {{ $billParticular->uom ?? '' }}
                            </td>
                            <td>
                                @can('bill_particular_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bill-particulars.show', $billParticular->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bill_particular_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bill-particulars.edit', $billParticular->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bill_particular_delete')
                                    <form action="{{ route('admin.bill-particulars.destroy', $billParticular->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bill_particular_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bill-particulars.massDestroy') }}",
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
  let table = $('.datatable-fromAreaBillParticulars:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection