<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // Handle an incoming request, check if the user has the necessary permissions
public function handle(Request $request, Closure $next, ...$permission): Response
{
    // If the user is not logged in (no user found), abort with a 401 (Unauthorized) status
    if ($request->user() === null) {
        abort(401); // Abort the request, as the user is not authorized
    }

    // If the logged-in user's role has any of the required permissions
    // This checks using the `hasAnyPermissions` method from the Role model
    if ($request->user()->role->hasAnyPermission($permission)) {
        // If the user has the required permission(s), allow the request to proceed to the next middleware or controller
        return $next($request);
    }

    // If the user does not have the required permissions, abort with a 401 (Unauthorized) status
    abort(401); // User lacks permissions, so the request is denied
}
}