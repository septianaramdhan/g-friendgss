<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role != 'admin') {
            Auth::logout();
            return redirect('/login');
        }

        $totalBarang = DB::table('barang')->count();
        $totalDiskon = DB::table('diskon')->count();
        $stokMenipis = DB::table('barang')
                        ->where('stok','<=',5)
                        ->count();

        return view('admin.dashboard', compact(
            'totalBarang',
            'totalDiskon',
            'stokMenipis'
        ));
    }
}