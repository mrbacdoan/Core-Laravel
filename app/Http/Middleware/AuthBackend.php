<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect()->route('backend.user.login');
        }
        return $next($request);
    }
}
