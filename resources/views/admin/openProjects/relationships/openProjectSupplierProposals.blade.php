@can('supplier_proposal_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.supplier-proposals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.supplierProposal.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.supplierProposal.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-openProjectSupplierProposals">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.representative_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.contact_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.documents') }}
                        </th>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.open_project') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supplierProposals as $key => $supplierProposal)
                        <tr data-entry-id="{{ $supplierProposal->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $supplierProposal->id ?? '' }}
                            </td>
                            <td>
                                {{ $supplierProposal->representative_name ?? '' }}
                            </td>
                            <td>
                                {{ $supplierProposal->contact_no ?? '' }}
                            </td>
                            <td>
                                @foreach($supplierProposal->documents as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $supplierProposal->open_project->name ?? '' }}
                            </td>
                            <td>
                                @can('supplier_proposal_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.supplier-proposals.show', $supplierProposal->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('supplier_proposal_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.supplier-proposals.edit', $supplierProposal->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('supplier_proposal_delete')
                                    <form action="{{ route('admin.supplier-proposals.destroy', $supplierProposal->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('supplier_proposal_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.supplier-proposals.massDestroy') }}",
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
  let table = $('.datatable-openProjectSupplierProposals:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection