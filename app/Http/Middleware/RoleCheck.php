<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
        if (!$request->user()->hasRole($roles)) {
            return response()->json([
                'message' => 'Access denied. You do not have the required role.',
                'required_role' => $roles,
                'user_role' => $request->user()->role,
            ], 403);
        }

        return $next($request);
    }
}
