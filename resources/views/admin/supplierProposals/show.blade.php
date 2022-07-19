@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supplierProposal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supplier-proposals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.id') }}
                        </th>
                        <td>
                            {{ $supplierProposal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.representative_name') }}
                        </th>
                        <td>
                            {{ $supplierProposal->representative_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.contact_no') }}
                        </th>
                        <td>
                            {{ $supplierProposal->contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.documents') }}
                        </th>
                        <td>
                            @foreach($supplierProposal->documents as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplierProposal.fields.open_project') }}
                        </th>
                        <td>
                            {{ $supplierProposal->open_project->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supplier-proposals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection