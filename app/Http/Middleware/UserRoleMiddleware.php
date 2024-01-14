<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $authUser = Auth::user();

        if ($authUser->userRole->role->name != $role) {
            return response()->json([
                'error' => 'You are not allowed to access this route.'
            ], 403);
        }

        return $next($request);
    }
}
