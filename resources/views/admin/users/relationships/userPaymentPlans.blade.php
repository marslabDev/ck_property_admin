@can('payment_plan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.payment-plans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.paymentPlan.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.paymentPlan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userPaymentPlans">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.house') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.due_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.payment') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.recusive_payment') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.cycle_every') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.cycle_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.no_of_cycle') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentPlans as $key => $paymentPlan)
                        <tr data-entry-id="{{ $paymentPlan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $paymentPlan->id ?? '' }}
                            </td>
                            <td>
                                {{ $paymentPlan->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $paymentPlan->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $paymentPlan->house->unit_no ?? '' }}
                            </td>
                            <td>
                                {{ $paymentPlan->due_date ?? '' }}
                            </td>
                            <td>
                                @foreach($paymentPlan->payments as $key => $item)
                                    <span class="badge badge-info">{{ $item->particular }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span style="display:none">{{ $paymentPlan->recusive_payment ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $paymentPlan->recusive_payment ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $paymentPlan->cycle_every ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\PaymentPlan::CYCLE_BY_SELECT[$paymentPlan->cycle_by] ?? '' }}
                            </td>
                            <td>
                                {{ $paymentPlan->no_of_cycle ?? '' }}
                            </td>
                            <td>
                                @can('payment_plan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.payment-plans.show', $paymentPlan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('payment_plan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.payment-plans.edit', $paymentPlan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('payment_plan_delete')
                                    <form action="{{ route('admin.payment-plans.destroy', $paymentPlan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('payment_plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.payment-plans.massDestroy') }}",
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
  let table = $('.datatable-userPaymentPlans:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection