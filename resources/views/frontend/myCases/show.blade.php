@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.myCase.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.my-cases.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $myCase->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $myCase->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $myCase->category->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $myCase->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.urgent_status') }}
                                    </th>
                                    <td>
                                        {{ $myCase->urgent_status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.progress') }}
                                    </th>
                                    <td>
                                        {{ $myCase->progress }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.image') }}
                                    </th>
                                    <td>
                                        @if($myCase->image)
                                            <a href="{{ $myCase->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $myCase->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $myCase->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.report_by') }}
                                    </th>
                                    <td>
                                        {{ $myCase->report_by->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.myCase.fields.handle_by') }}
                                    </th>
                                    <td>
                                        {{ $myCase->handle_by->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.my-cases.index') }}">
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