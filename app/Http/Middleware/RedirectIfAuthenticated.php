<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        if (Auth::check()) {

            $role = Auth::user()->role;

            if ($role == 'superadmin') {
                return redirect('/super/dashboard');
            }

            if ($role == 'admin') {
                return redirect('/admin/dashboard');
            }

            if ($role == 'kasir') {
                return redirect('/kasir/dashboard');
            }
        }

        return $next($request);
    }
}