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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // redirect ตาม role
        switch($request->user()->role) {
            case 'admin':
                return to_route('admin.dashboard');
            case 'staff':
                return to_route('staff.dashboard');
            default:
                return to_route('home');
        }
    }
}
