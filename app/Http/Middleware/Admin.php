<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            if ($request->ajax() || $request->is(API_PREFIX . '/*')) {
                return response()->json(['msg' => 'Unauthorized.'], 401);
            } else {
                return redirect()->route('backend.user.login');
            }
        }
        return $next($request);
    }
}
