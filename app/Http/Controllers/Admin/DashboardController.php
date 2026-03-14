<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = DB::table('barang')->count();
        $totalDiskon = DB::table('diskon')->count();

        $stokMenipis = DB::table('barang')
                        ->where('stok','<=',5)
                        ->count();

        // BARANG TERMAHAL
        $barangTermahal = DB::table('barang')
                        ->orderByDesc('harga')
                        ->first();

        // BARANG TERMURAH
        $barangTermurah = DB::table('barang')
                        ->orderBy('harga')
                        ->first();

        return view('admin.dashboard', compact(
            'totalBarang',
            'totalDiskon',
            'stokMenipis',
            'barangTermahal',
            'barangTermurah'
        ));
    }
}