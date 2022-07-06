@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userCardMgmt.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-card-mgmts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.id') }}
                        </th>
                        <td>
                            {{ $userCardMgmt->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.user') }}
                        </th>
                        <td>
                            {{ $userCardMgmt->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.cardholder_name') }}
                        </th>
                        <td>
                            {{ $userCardMgmt->cardholder_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.card_no') }}
                        </th>
                        <td>
                            {{ $userCardMgmt->card_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.card_issuer') }}
                        </th>
                        <td>
                            {{ App\Models\UserCardMgmt::CARD_ISSUER_SELECT[$userCardMgmt->card_issuer] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userCardMgmt.fields.expiration_date') }}
                        </th>
                        <td>
                            {{ $userCardMgmt->expiration_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-card-mgmts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection