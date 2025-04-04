<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
       $user_role = $request->user()->getRole(); // Get the user's role
        if (in_array($user_role, $roles)) { // Check if the user has the required role
            // User has the required role, allow access
            return $next($request); // Proceed to the next middleware or controller
        }
        abort(403, 'Forbidden. You do not have permission to access this resource.');

    }
}
