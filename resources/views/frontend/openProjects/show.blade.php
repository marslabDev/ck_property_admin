@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.openProject.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.open-projects.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $openProject->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $openProject->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $openProject->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.area') }}
                                    </th>
                                    <td>
                                        @foreach($openProject->areas as $key => $area)
                                            <span class="label label-info">{{ $area->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $openProject->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.budget') }}
                                    </th>
                                    <td>
                                        {{ $openProject->budget }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.supplier') }}
                                    </th>
                                    <td>
                                        @foreach($openProject->suppliers as $key => $supplier)
                                            <span class="label label-info">{{ $supplier->company }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.openProject.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $openProject->status->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.open-projects.index') }}">
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