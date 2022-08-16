@extends('layouts.core')
@section('content')


<div class="card">
    <div class="card-header">
        {{ trans('panel.welcome') }}
    </div>

    <div class="card-body">

        <div>
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    @can('user_management_access')
                    <a class="btn btn-primary tw-mx-1" href="{{ route('core.users.index') }}">
                        {{ trans('global.manage') }} {{ trans('cruds.user.title_singular') }}
                    </a>
                    @endcan

                    @can('area_access')
                    <a class="btn btn-primary tw-mx-1" href="{{ route('core.areas.index') }}">
                        {{ trans('global.manage') }} {{ trans('cruds.area.title_singular') }}
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        {{ trans('panel.select_area') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($areas as $area)
                <tr>
                    <td>
                        <form id="area_{{ $area->id }}" action="{{ route('core.select-area.redirect', [$area]) }}"
                            method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <button class="btn btn-link w-100 text-left" type="button"
                            onclick="event.preventDefault(); document.getElementById('area_{{ $area->id }}').submit();">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $area->name }}
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection