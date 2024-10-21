<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ensure the user is authenticated before accessing role property
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        $userRole = Auth::user()->role;

        // Check if the user role matches any of the allowed roles
        if (!in_array($userRole, $roles)) {
            return redirect('/nobruh'); // Unauthorized access route
        }

        // Share the user role with all views
        view()->share('userRole', $userRole);

        return $next($request);
    }
}
