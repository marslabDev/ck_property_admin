@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.notice.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.notices.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $notice->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.title_name') }}
                                    </th>
                                    <td>
                                        {{ $notice->title_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.image') }}
                                    </th>
                                    <td>
                                        @if($notice->image)
                                            <a href="{{ $notice->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $notice->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.detail') }}
                                    </th>
                                    <td>
                                        {{ $notice->detail }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.create_by') }}
                                    </th>
                                    <td>
                                        {{ $notice->create_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.people_in_role') }}
                                    </th>
                                    <td>
                                        {{ $notice->people_in_role->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.people_in_area') }}
                                    </th>
                                    <td>
                                        {{ $notice->people_in_area->address_line ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.notice.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $notice->created_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.notices.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection