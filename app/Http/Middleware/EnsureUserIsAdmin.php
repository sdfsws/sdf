<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$allowedRoles
     * @return mixed
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user() || !Auth::user()->hasRole('admin')) {
            throw new AuthorizationException('You do not have permission to access this resource.');
        }

        return $next($request);
    }

    /**
     * Check if the authenticated user is authorized.
     *
     * @param  array  $allowedRoles
     * @return bool
     */
    protected function isUserAuthorized(array $allowedRoles): bool
    {
        return Auth::check() && Auth::user()->hasAnyRole($allowedRoles);
    }
    
}
