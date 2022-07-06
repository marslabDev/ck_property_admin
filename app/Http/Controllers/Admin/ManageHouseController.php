<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyManageHouseRequest;
use App\Http\Requests\StoreManageHouseRequest;
use App\Http\Requests\UpdateManageHouseRequest;
use App\Models\Area;
use App\Models\HouseType;
use App\Models\ManageHouse;
use App\Models\ParkingLot;
use App\Models\Street;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ManageHouseController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('manage_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ManageHouse::with(['house_type', 'area', 'street', 'owned_bies', 'parking_lots', 'created_by'])->select(sprintf('%s.*', (new ManageHouse())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'manage_house_show';
                $editGate = 'manage_house_edit';
                $deleteGate = 'manage_house_delete';
                $crudRoutePart = 'manage-houses';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('house_type_name', function ($row) {
                return $row->house_type ? $row->house_type->name : '';
            });

            $table->editColumn('unit_no', function ($row) {
                return $row->unit_no ? $row->unit_no : '';
            });
            $table->editColumn('floor', function ($row) {
                return $row->floor ? $row->floor : '';
            });
            $table->editColumn('block', function ($row) {
                return $row->block ? $row->block : '';
            });
            $table->addColumn('area_name', function ($row) {
                return $row->area ? $row->area->name : '';
            });

            $table->addColumn('street_street_name', function ($row) {
                return $row->street ? $row->street->street_name : '';
            });

            $table->editColumn('square_feet', function ($row) {
                return $row->square_feet ? $row->square_feet : '';
            });
            $table->editColumn('house_status', function ($row) {
                return $row->house_status ? ManageHouse::HOUSE_STATUS_SELECT[$row->house_status] : '';
            });
            $table->editColumn('documents', function ($row) {
                if (!$row->documents) {
                    return '';
                }
                $links = [];
                foreach ($row->documents as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('owned_by', function ($row) {
                $labels = [];
                foreach ($row->owned_bies as $owned_by) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $owned_by->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('parking_lot', function ($row) {
                $labels = [];
                foreach ($row->parking_lots as $parking_lot) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $parking_lot->lot_no);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'house_type', 'area', 'street', 'documents', 'owned_by', 'parking_lot']);

            return $table->make(true);
        }

        $house_types  = HouseType::get();
        $areas        = Area::get();
        $streets      = Street::get();
        $users        = User::get();
        $parking_lots = ParkingLot::get();

        return view('admin.manageHouses.index', compact('house_types', 'areas', 'streets', 'users', 'parking_lots'));
    }

    public function create()
    {
        abort_if(Gate::denies('manage_house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $streets = Street::pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id');

        $parking_lots = ParkingLot::pluck('lot_no', 'id');

        return view('admin.manageHouses.create', compact('areas', 'house_types', 'owned_bies', 'parking_lots', 'streets'));
    }

    public function store(StoreManageHouseRequest $request)
    {
        $manageHouse = ManageHouse::create($request->all());
        $manageHouse->owned_bies()->sync($request->input('owned_bies', []));
        $manageHouse->parking_lots()->sync($request->input('parking_lots', []));
        foreach ($request->input('documents', []) as $file) {
            $manageHouse->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $manageHouse->id]);
        }

        return redirect()->route('admin.manage-houses.index');
    }

    public function edit(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $streets = Street::pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id');

        $parking_lots = ParkingLot::pluck('lot_no', 'id');

        $manageHouse->load('house_type', 'area', 'street', 'owned_bies', 'parking_lots', 'created_by');

        return view('admin.manageHouses.edit', compact('areas', 'house_types', 'manageHouse', 'owned_bies', 'parking_lots', 'streets'));
    }

    public function update(UpdateManageHouseRequest $request, ManageHouse $manageHouse)
    {
        $manageHouse->update($request->all());
        $manageHouse->owned_bies()->sync($request->input('owned_bies', []));
        $manageHouse->parking_lots()->sync($request->input('parking_lots', []));
        if (count($manageHouse->documents) > 0) {
            foreach ($manageHouse->documents as $media) {
                if (!in_array($media->file_name, $request->input('documents', []))) {
                    $media->delete();
                }
            }
        }
        $media = $manageHouse->documents->pluck('file_name')->toArray();
        foreach ($request->input('documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $manageHouse->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
            }
        }

        return redirect()->route('admin.manage-houses.index');
    }

    public function show(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouse->load('house_type', 'area', 'street', 'owned_bies', 'parking_lots', 'created_by');

        return view('admin.manageHouses.show', compact('manageHouse'));
    }

    public function destroy(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouse->delete();

        return back();
    }

    public function massDestroy(MassDestroyManageHouseRequest $request)
    {
        ManageHouse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('manage_house_create') && Gate::denies('manage_house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ManageHouse();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
