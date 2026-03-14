<?php

namespace App\Http\Controllers\Super;

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

        if (Auth::user()->role != 'superadmin') {
            Auth::logout();
            return redirect('/login');
        }

        // TOTAL PENJUALAN
        $totalPenjualan = DB::table('transaksi')->sum('total_harga');

        // TOTAL TRANSAKSI
        $totalTransaksi = DB::table('transaksi')->count();

        // TOTAL PROFIT (harga jual - harga beli)
        $totalProfit = DB::table('detail_transaksi')
            ->join('barang','detail_transaksi.barang_id','=','barang.id')
            ->select(DB::raw('SUM((detail_transaksi.harga - barang.harga_modal) * detail_transaksi.qty) as profit'))
            ->value('profit');

        // STOK MENIPIS
        $stokMenipis = DB::table('barang')
            ->where('stok','<=',5)
            ->count();

        return view('super.dashboard', compact(
            'totalPenjualan',
            'totalTransaksi',
            'totalProfit',
            'stokMenipis'
        ));
    }
}