<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $allowedRoles = explode('|', $roles);

        if (Auth::check() && in_array(Auth::user()->role, $allowedRoles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
