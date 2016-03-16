<?php
/**
 * Created by Hoangnham
 * Date: 9/29/2015 10:45 AM
 */

namespace App\Http\Middleware;

use Closure;
use IZeeRole;

class AccessControlList
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!IZeeRole::checkRouteAccess($request->route()->getName())) {

            if($request->ajax() ||  $request->is(API_PREFIX. '/')){
                return response()->json(['msg' => 'Forbidden.'], 403);
            } else {
                abort(403);
            }
        }
        return $next($request);
    }
}
