@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.myCase.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.my-cases.index') }}">
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
                            {{ trans('cruds.myCase.fields.case_no') }}
                        </th>
                        <td>
                            {{ $myCase->case_no }}
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
                            {{ trans('cruds.myCase.fields.opened_at') }}
                        </th>
                        <td>
                            {{ $myCase->opened_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myCase.fields.complaint') }}
                        </th>
                        <td>
                            @foreach($myCase->complaints as $key => $complaint)
                                <span class="label label-info">{{ $complaint->title }}</span>
                            @endforeach
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
                            {{ trans('cruds.myCase.fields.description') }}
                        </th>
                        <td>
                            {!! $myCase->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myCase.fields.image') }}
                        </th>
                        <td>
                            @foreach($myCase->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
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
                    <tr>
                        <th>
                            {{ trans('cruds.myCase.fields.report_to') }}
                        </th>
                        <td>
                            {{ $myCase->report_to->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myCase.fields.created_by') }}
                        </th>
                        <td>
                            {{ $myCase->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.my-cases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection