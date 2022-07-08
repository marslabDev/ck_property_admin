<div class="card">
    <div class="card-header">
        {{ trans('cruds.homeOwnerTransaction.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userHomeOwnerTransactions">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.house') }}
                        </th>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.payment_plan') }}
                        </th>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.payment_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.amount_paid') }}
                        </th>
                        <th>
                            {{ trans('cruds.homeOwnerTransaction.fields.changes') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($homeOwnerTransactions as $key => $homeOwnerTransaction)
                        <tr data-entry-id="{{ $homeOwnerTransaction->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $homeOwnerTransaction->id ?? '' }}
                            </td>
                            <td>
                                {{ $homeOwnerTransaction->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $homeOwnerTransaction->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $homeOwnerTransaction->house->unit_no ?? '' }}
                            </td>
                            <td>
                                {{ $homeOwnerTransaction->payment_plan->due_date ?? '' }}
                            </td>
                            <td>
                                {{ $homeOwnerTransaction->payment_type->name ?? '' }}
                            </td>
                            <td>
                                {{ $homeOwnerTransaction->amount_paid ?? '' }}
                            </td>
                            <td>
                                {{ $homeOwnerTransaction->changes ?? '' }}
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
  let table = $('.datatable-userHomeOwnerTransactions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection