<?php

namespace App\Http\Middleware;

use App\Models\Area;
use Closure;
use Illuminate\Http\Request;

class ValidateArea
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $area = $request->route('area');
            $type = gettype($area);

            if ($type == 'string') {
                if (!is_numeric($area)) {
                    // return redirect()->route('core.select-area');
                    throw new \Throwable('{area} must be a number.');
                }
                Area::findOrFail($area);
            }

            if ($type == 'object') {
                if (!isset($area)) {
                    // return redirect()->route('core.select-area');
                    throw new \Throwable('{area} must be not be null.');
                }
            }

            return $next($request);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // return redirect()->route('core.select-area');
            throw $e;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
