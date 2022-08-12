<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageHouseController extends Controller
{
    /**
     * Get street from manage house form ajax call.
     * Must return JSON data.
     */
    public function getStreet(Request $request, Area $area)
    {
        try {
            if ($request->ajax()) {
                return response()->json($area->fromAreaStreets);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get street from manage house form ajax call.
     * Must return JSON data.
     */
    public function getHouseType(Request $request, Area $area)
    {
        try {
            if ($request->ajax()) {
                return response()->json($area->fromAreaHouseTypes);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
