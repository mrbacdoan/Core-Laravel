<?php

namespace App\Http\Middleware;

use Closure;
use App\IZee\Core\API\Interfaces\Auth;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if($request->ajax() ||  $request->is(API_PREFIX. '/*')){
                return response()->json(['msg' => 'Unauthorized.'], 401);
            }else{
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
