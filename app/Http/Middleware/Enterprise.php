<?php
/**
 * Created by Hoangnham
 * Date: 10/10/2015 9:57 AM
 */

namespace App\Http\Middleware;

use Closure;
use App\IZee\Core\API\Interfaces\Admin as Auth;

class Enterprise
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
        if ($this->auth->guest() || $this->auth->user()->type != USER_TYPE_ENTERPRISE) {
            if ($request->ajax() || $request->is(API_PREFIX . '/*')) {
                return response()->json(['msg' => 'Unauthorized.'], 401);
            } else {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}