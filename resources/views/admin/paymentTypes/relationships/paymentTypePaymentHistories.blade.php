<div class="card">
    <div class="card-header">
        {{ trans('cruds.paymentHistory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-paymentTypePaymentHistories">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.paymentHistory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentHistory.fields.paid_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentHistory.fields.payment_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentHistory.fields.date_received') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentHistory.fields.amount') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentHistories as $key => $paymentHistory)
                        <tr data-entry-id="{{ $paymentHistory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $paymentHistory->id ?? '' }}
                            </td>
                            <td>
                                {{ $paymentHistory->paid_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $paymentHistory->payment_type->name ?? '' }}
                            </td>
                            <td>
                                {{ $paymentHistory->date_received ?? '' }}
                            </td>
                            <td>
                                {{ $paymentHistory->amount ?? '' }}
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
  let table = $('.datatable-paymentTypePaymentHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection