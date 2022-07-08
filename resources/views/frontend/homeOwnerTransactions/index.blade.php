@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.homeOwnerTransaction.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-HomeOwnerTransaction">
                            <thead>
                                <tr>
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
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($users as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($manage_houses as $key => $item)
                                                <option value="{{ $item->unit_no }}">{{ $item->unit_no }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($payment_plans as $key => $item)
                                                <option value="{{ $item->due_date }}">{{ $item->due_date }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($payment_types as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($homeOwnerTransactions as $key => $homeOwnerTransaction)
                                    <tr data-entry-id="{{ $homeOwnerTransaction->id }}">
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

        </div>
    </div>
</div>
@endsection
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
  let table = $('.datatable-HomeOwnerTransaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection