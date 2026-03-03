@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')

<div class="bg-gradient-to-r from-purple-600 to-pink-500 text-white p-6 rounded-xl shadow-lg mb-6">
    <h3 class="text-2xl font-bold">Laporan Transaksi</h3>
    <p class="text-sm opacity-90">Monitoring transaksi oleh Superadmin</p>
</div>

<!-- Filter -->
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium mb-1">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-400">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-pink-400">
        </div>

        <div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white p-2 rounded-lg hover:opacity-90 transition">
                Filter
            </button>
        </div>
    </form>
</div>

<!-- Summary -->
<div class="grid md:grid-cols-2 gap-6 mb-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-gray-500 text-sm">Total Transaksi</h4>
        <p class="text-2xl font-bold text-purple-600">
            {{ $totalTransaksi }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-gray-500 text-sm">Total Pendapatan</h4>
        <p class="text-2xl font-bold text-pink-600">
            Rp {{ number_format($totalPendapatan,0,',','.') }}
        </p>
    </div>

</div>

<!-- Table -->
<div class="bg-white p-6 rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Tanggal</th>
                <th class="text-left p-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
                <tr class="border-b hover:bg-purple-50">
                    <td class="p-2">
                        {{ $t->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="p-2 font-semibold">
                        Rp {{ number_format($t->total_harga,0,',','.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-4 text-center text-gray-500">
                        Tidak ada data transaksi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection