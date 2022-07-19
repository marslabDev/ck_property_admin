<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyManageHouseRequest;
use App\Http\Requests\StoreManageHouseRequest;
use App\Http\Requests\UpdateManageHouseRequest;
use App\Models\Area;
use App\Models\HouseStatus;
use App\Models\HouseType;
use App\Models\ManageHouse;
use App\Models\ParkingLot;
use App\Models\Street;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
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
            $query = ManageHouse::with(['house_type', 'street', 'parking_lots', 'house_status', 'owned_bies', 'contact_person', 'contact_person_2', 'from_area', 'created_by'])->select(sprintf('%s.*', (new ManageHouse())->table));
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
            $table->addColumn('street_street_name', function ($row) {
                return $row->street ? $row->street->street_name : '';
            });

            $table->editColumn('square_feet', function ($row) {
                return $row->square_feet ? $row->square_feet : '';
            });
            $table->editColumn('parking_lot', function ($row) {
                $labels = [];
                foreach ($row->parking_lots as $parking_lot) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $parking_lot->lot_no);
                }

                return implode(' ', $labels);
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
            $table->addColumn('house_status_status', function ($row) {
                return $row->house_status ? $row->house_status->status : '';
            });

            $table->editColumn('owned_by', function ($row) {
                $labels = [];
                foreach ($row->owned_bies as $owned_by) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $owned_by->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('contact_person_phone_no', function ($row) {
                return $row->contact_person ? $row->contact_person->phone_no : '';
            });

            $table->addColumn('contact_person_2_phone_no', function ($row) {
                return $row->contact_person_2 ? $row->contact_person_2->phone_no : '';
            });

            $table->editColumn('contact_person_2.phone_no', function ($row) {
                return $row->contact_person_2 ? (is_string($row->contact_person_2) ? $row->contact_person_2 : $row->contact_person_2->phone_no) : '';
            });
            $table->addColumn('from_area_name', function ($row) {
                return $row->from_area ? $row->from_area->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'house_type', 'street', 'parking_lot', 'documents', 'house_status', 'owned_by', 'contact_person', 'contact_person_2', 'from_area']);

            return $table->make(true);
        }

        $house_types    = HouseType::get();
        $streets        = Street::get();
        $parking_lots   = ParkingLot::get();
        $house_statuses = HouseStatus::get();
        $users          = User::get();
        $areas          = Area::get();

        return view('admin.manageHouses.index', compact('house_types', 'streets', 'parking_lots', 'house_statuses', 'users', 'areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('manage_house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $streets = Street::pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parking_lots = ParkingLot::pluck('lot_no', 'id');

        $house_statuses = HouseStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id');

        $contact_people = Role::where('title', 'Home Owner')->first()->rolesUsers ?? [];

        $contact_person_2s = Role::where('title', 'Home Owner')->first()->rolesUsers ?? [];

        return view('admin.manageHouses.create', compact('contact_people', 'contact_person_2s', 'house_statuses', 'house_types', 'owned_bies', 'parking_lots', 'streets'));
    }

    public function store(StoreManageHouseRequest $request)
    {
        $manageHouse = ManageHouse::create($request->all());
        $manageHouse->parking_lots()->sync($request->input('parking_lots', []));
        $manageHouse->owned_bies()->sync($request->input('owned_bies', []));
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

        $streets = Street::pluck('street_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parking_lots = ParkingLot::pluck('lot_no', 'id');

        $house_statuses = HouseStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id');

        $contact_people = Role::where('title', 'Home Owner')->first()->rolesUsers ?? [];

        $contact_person_2s = Role::where('title', 'Home Owner')->first()->rolesUsers ?? [];

        $manageHouse->load('house_type', 'street', 'parking_lots', 'house_status', 'owned_bies', 'contact_person', 'contact_person_2', 'from_area', 'created_by');

        return view('admin.manageHouses.edit', compact('contact_people', 'contact_person_2s', 'house_statuses', 'house_types', 'manageHouse', 'owned_bies', 'parking_lots', 'streets'));
    }

    public function update(UpdateManageHouseRequest $request, ManageHouse $manageHouse)
    {
        $manageHouse->update($request->all());
        $manageHouse->parking_lots()->sync($request->input('parking_lots', []));
        $manageHouse->owned_bies()->sync($request->input('owned_bies', []));
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

        $manageHouse->load('house_type', 'street', 'parking_lots', 'house_status', 'owned_bies', 'contact_person', 'contact_person_2', 'from_area', 'created_by', 'housePaymentPlans', 'houseHomeOwnerTransactions');

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
