<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role != 'operator') {
            Auth::logout();
            return redirect('/login');
        }

        return view('operator.dashboard');
    }
}