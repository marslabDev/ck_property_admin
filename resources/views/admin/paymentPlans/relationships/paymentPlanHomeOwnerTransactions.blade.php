@can('home_owner_transaction_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.home-owner-transactions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.homeOwnerTransaction.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.homeOwnerTransaction.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-paymentPlanHomeOwnerTransactions">
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
                                @can('home_owner_transaction_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.home-owner-transactions.show', $homeOwnerTransaction->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('home_owner_transaction_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.home-owner-transactions.edit', $homeOwnerTransaction->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('home_owner_transaction_delete')
                                    <form action="{{ route('admin.home-owner-transactions.destroy', $homeOwnerTransaction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('home_owner_transaction_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.home-owner-transactions.massDestroy') }}",
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
  let table = $('.datatable-paymentPlanHomeOwnerTransactions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection