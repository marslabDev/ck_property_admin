<div class="card">
    <div class="card-header">
        {{ trans('cruds.billHistory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-billBillHistories">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.billHistory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.billHistory.fields.paid_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.billHistory.fields.bill') }}
                        </th>
                        <th>
                            {{ trans('cruds.billHistory.fields.amount') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billHistories as $key => $billHistory)
                        <tr data-entry-id="{{ $billHistory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $billHistory->id ?? '' }}
                            </td>
                            <td>
                                {{ $billHistory->paid_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $billHistory->paid_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $billHistory->bill->amount ?? '' }}
                            </td>
                            <td>
                                {{ $billHistory->amount ?? '' }}
                            </td>
                            <td>



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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-billBillHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection