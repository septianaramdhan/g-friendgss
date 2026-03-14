<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = strtolower(trim(Auth::user()->role));

        $roles = array_map(function ($role) {
            return strtolower(trim($role));
        }, $roles);

        if (!in_array($userRole, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}