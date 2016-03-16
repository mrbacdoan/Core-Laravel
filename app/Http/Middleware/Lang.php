<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Redirector;
use App;

class Lang
{

    protected $app, $redirector;

    public function __construct(Application $app, Redirector $redirector)
    {
        $this->app = $app;
        $this->redirector = $redirector;
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
        if ($request->has('lang') && !$request->is(API_PREFIX . '/*')) {
            $locale = $request->get('lang') == App::getLocale() ? '' : $request->get('lang');
            return $this->redirector->to($locale);
        }
        return $next($request);
    }

}