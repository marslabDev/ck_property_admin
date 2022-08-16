<div>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @can('user_management_access')
            <a class="btn {{ request()->is('core/users') ? 'btn-primary' : 'btn-outline-primary' }}"
                href="{{ route('core.users.index') }}">
                {{ trans('global.manage') }} {{ trans('cruds.user.title_singular') }}
            </a>
            @endcan

            @can('user_detail_access')
            <a class="btn {{ request()->is('core/user-details') ? 'btn-primary' : 'btn-outline-primary' }}"
                href="{{ route('core.user-details.index') }}">
                {{ trans('global.manage') }} {{ trans('cruds.userDetail.title_singular') }}
            </a>
            @endcan

            @can('user_card_mgmt_access')
            <a class="btn {{ request()->is('core/user-card-mgmts') ? 'btn-primary' : 'btn-outline-primary' }}"
                href="{{ route('core.user-card-mgmts.index') }}">
                {{ trans('global.manage') }} {{ trans('cruds.userCardMgmt.title_singular') }}
            </a>
            @endcan

            @can('role_access')
            <a class="btn {{ request()->is('core/roles') ? 'btn-primary' : 'btn-outline-primary' }}"
                href="{{ route('core.roles.index') }}">
                {{ trans('global.manage') }} {{ trans('cruds.role.title_singular') }}
            </a>
            @endcan

            @can('permission_access')
            <a class="btn {{ request()->is('core/permissions') ? 'btn-primary' : 'btn-outline-primary' }}"
                href="{{ route('core.permissions.index') }}">
                {{ trans('global.manage') }} {{ trans('cruds.permission.title_singular') }}
            </a>
            @endcan
        </div>
    </div>
</div>
