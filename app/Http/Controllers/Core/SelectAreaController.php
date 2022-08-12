<?php

namespace App\Http\Controllers\Core;


use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelectAreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = auth()->user()->areas;

        return view('core.selectArea', compact('areas'));
    }

    public function redirect(Area $area)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/');
        }

        return redirect()->route('admin.home', [$area]);
    }
}
