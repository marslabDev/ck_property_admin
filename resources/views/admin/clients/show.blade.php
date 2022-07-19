@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.client.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.person_in_change') }}
                        </th>
                        <td>
                            {{ $client->person_in_change }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.company') }}
                        </th>
                        <td>
                            {{ $client->company }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.desc') }}
                        </th>
                        <td>
                            {{ $client->desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.email') }}
                        </th>
                        <td>
                            {{ $client->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.phone') }}
                        </th>
                        <td>
                            {{ $client->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.website') }}
                        </th>
                        <td>
                            {{ $client->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.whatapps') }}
                        </th>
                        <td>
                            {{ $client->whatapps }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.country') }}
                        </th>
                        <td>
                            {{ $client->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.status') }}
                        </th>
                        <td>
                            {{ $client->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#supplier_checklists" role="tab" data-toggle="tab">
                {{ trans('cruds.checklist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_open_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.openProject.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="supplier_checklists">
            @includeIf('admin.clients.relationships.supplierChecklists', ['checklists' => $client->supplierChecklists])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_projects">
            @includeIf('admin.clients.relationships.supplierProjects', ['projects' => $client->supplierProjects])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_open_projects">
            @includeIf('admin.clients.relationships.supplierOpenProjects', ['openProjects' => $client->supplierOpenProjects])
        </div>
    </div>
</div>

@endsection