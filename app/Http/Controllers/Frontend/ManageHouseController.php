<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyManageHouseRequest;
use App\Http\Requests\StoreManageHouseRequest;
use App\Http\Requests\UpdateManageHouseRequest;
use App\Models\HouseType;
use App\Models\ManageHouse;
use App\Models\ParkingLot;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ManageHouseController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('manage_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouses = ManageHouse::with(['house_type', 'parking_lot', 'owned_bies', 'created_by', 'media'])->get();

        $house_types = HouseType::get();

        $parking_lots = ParkingLot::get();

        $users = User::get();

        return view('frontend.manageHouses.index', compact('house_types', 'manageHouses', 'parking_lots', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('manage_house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parking_lots = ParkingLot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id');

        return view('frontend.manageHouses.create', compact('house_types', 'owned_bies', 'parking_lots'));
    }

    public function store(StoreManageHouseRequest $request)
    {
        $manageHouse = ManageHouse::create($request->all());
        $manageHouse->owned_bies()->sync($request->input('owned_bies', []));
        foreach ($request->input('documents', []) as $file) {
            $manageHouse->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $manageHouse->id]);
        }

        return redirect()->route('frontend.manage-houses.index');
    }

    public function edit(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parking_lots = ParkingLot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id');

        $manageHouse->load('house_type', 'parking_lot', 'owned_bies', 'created_by');

        return view('frontend.manageHouses.edit', compact('house_types', 'manageHouse', 'owned_bies', 'parking_lots'));
    }

    public function update(UpdateManageHouseRequest $request, ManageHouse $manageHouse)
    {
        $manageHouse->update($request->all());
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

        return redirect()->route('frontend.manage-houses.index');
    }

    public function show(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouse->load('house_type', 'parking_lot', 'owned_bies', 'created_by');

        return view('frontend.manageHouses.show', compact('manageHouse'));
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
