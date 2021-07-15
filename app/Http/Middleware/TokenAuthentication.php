<?php

namespace App\Http\Middleware;

use Closure;

class TokenAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();
        if(!$token) {
            return response()->json('No token provided', 401);
        }

        $this->validateToken($token);

        return $next($request);
    }

    public function validateToken($token)
    {
        try {
            //TODO add token validation functionality
            return true;
        } catch(\Exception $e) {
            return $e;
        };
    }
}
