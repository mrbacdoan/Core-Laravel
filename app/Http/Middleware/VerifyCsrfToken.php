<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        if ($this->isReading($request) || $this->shouldPassThrough($request) || $this->tokensMatch($request)
            || $request->is(API_PREFIX. '/*') || $request->is('webhooks*')) {
            return $this->addCookieToResponse($request, $next($request));
        }
        throw new TokenMismatchException;
    }
}
