@can('user_card_mgmt_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-card-mgmts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userCardMgmt.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userCardMgmt.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userUserCardMgmts">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.cardholder_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.card_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.card_issuer') }}
                        </th>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.expire_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.user') }}
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
                    @foreach($userCardMgmts as $key => $userCardMgmt)
                        <tr data-entry-id="{{ $userCardMgmt->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userCardMgmt->id ?? '' }}
                            </td>
                            <td>
                                {{ $userCardMgmt->cardholder_name ?? '' }}
                            </td>
                            <td>
                                {{ $userCardMgmt->card_no ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\UserCardMgmt::CARD_ISSUER_SELECT[$userCardMgmt->card_issuer] ?? '' }}
                            </td>
                            <td>
                                {{ $userCardMgmt->expire_date ?? '' }}
                            </td>
                            <td>
                                {{ $userCardMgmt->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $userCardMgmt->user->email ?? '' }}
                            </td>
                            <td>
                                @can('user_card_mgmt_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-card-mgmts.show', $userCardMgmt->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_card_mgmt_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-card-mgmts.edit', $userCardMgmt->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_card_mgmt_delete')
                                    <form action="{{ route('admin.user-card-mgmts.destroy', $userCardMgmt->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_card_mgmt_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-card-mgmts.massDestroy') }}",
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
  let table = $('.datatable-userUserCardMgmts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection