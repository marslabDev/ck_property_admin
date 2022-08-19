@extends('layouts.core')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.role.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('core.roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.name') }}
                        </th>
                        <td>
                            {{ $role->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.redirect_to') }}
                        </th>
                        <td>
                            {{ $role->redirect_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('core.roles.index') }}">
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
    <ul class="nav nav-pills" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#people_in_role_notices" role="tab" data-toggle="tab">
                {{ trans('cruds.notice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#roles_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content tw-px-5 tw-pt-5">
        <div class="tab-pane" role="tabpanel" id="people_in_role_notices">
            {{-- @includeIf('core.roles.relationships.peopleInRoleNotices', ['notices' => $role->peopleInRoleNotices]) --}}
        </div>
        <div class="tab-pane active" role="tabpanel" id="roles_users">
            @includeIf('core.roles.relationships.rolesUsers', ['users' => $role->users])
        </div>
    </div>
</div>

@endsection
