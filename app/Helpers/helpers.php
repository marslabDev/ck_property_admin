<?php

use App\Models\Area;

if (!function_exists('currentArea')) {
    function currentArea()
    {
        $area = request()->route('area');
        $type = gettype($area);

        if ($type == 'string') {
            if (!is_numeric($area)) {
                // return redirect()->route('core.select-area');
                throw new \Throwable('{area} must be a number.');
            }
            $area = Area::findOrFail($area);
        }

        if ($type == 'object') {
            if (!isset($area)) {
                // return redirect()->route('core.select-area');
                throw new \Throwable('{area} must be not be null.');
            }
        }

        return $area;
    }
}
