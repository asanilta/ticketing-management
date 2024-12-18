<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user's role matches any of the allowed roles
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Deny access if role is not authorized
        abort(403, 'Unauthorized action.');
    }
}
