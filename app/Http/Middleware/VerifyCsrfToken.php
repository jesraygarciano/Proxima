<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'verify/account/*'
    ];

    public function handle($request, Closure $next)  
	{
	    if ($this->isReading($request) || $this->excludedRoutes($request) || $this->tokensMatch($request))
	    {
	        return $this->addCookieToResponse($request, $next($request));
	    }

	    throw new TokenMismatchException;
	}

    protected function excludedRoutes($request)  
	{
	    $routes = [
	            'verify/account*',
	    ];

	    foreach($routes as $route)
	        if ($request->is($route))
	            return true;

	        return false;
	}
}
