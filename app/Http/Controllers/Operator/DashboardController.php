<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        // transaksi hari ini
        $transaksiHariIni = DB::table('transaksi')
            ->whereDate('created_at', Carbon::today())
            ->count();

        // pendapatan hari ini
        $pendapatanHariIni = DB::table('transaksi')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

        // riwayat transaksi terakhir
        $riwayat = DB::table('transaksi')
            ->orderBy('created_at','desc')
            ->limit(5)
            ->get();

        // barang paling laku
        $bestSeller = DB::table('detail_transaksi')
            ->join('barang','barang.id','=','detail_transaksi.barang_id')
            ->select(
                'barang.nama_barang',
                DB::raw('SUM(detail_transaksi.qty) as total')
            )
            ->groupBy('barang.nama_barang')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('operator.dashboard', compact(
            'transaksiHariIni',
            'pendapatanHariIni',
            'riwayat',
            'bestSeller'
        ));
    }
}