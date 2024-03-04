<?php

namespace App\Http\Middleware;

use App\Models\Constants\Auth\AuthConstants;
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
    public function handle(Request $request, Closure $next, string $role): Response
    {
        return $request->user()->role === $role
            ? $next($request)
            : to_route('dashboard', []);
    }
}
