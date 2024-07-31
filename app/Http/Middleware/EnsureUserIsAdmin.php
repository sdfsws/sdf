<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next, array $allowedRoles = ['admin', 'superadmin']): JsonResponse
    {
        if (!$this->isUserAuthorized($allowedRoles)) {
            throw new AuthorizationException('You do not have permission to access this resource.');
        }

        return $next($request);
    }

    protected function isUserAuthorized(array $allowedRoles): bool
    {
        return Auth::check() && in_array(Auth::user()->getRoleName(), $allowedRoles);
    }
}
