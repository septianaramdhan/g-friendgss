@extends('layouts.app')

@section('title', 'Laporan Pendapatan')

@section('content')

<div class="bg-gradient-to-r from-purple-600 to-pink-500 text-white p-6 rounded-xl shadow-lg mb-6">
    <h3 class="text-2xl font-bold">Laporan Pendapatan</h3>
    <p class="text-sm opacity-90">Rekap pendapatan per hari</p>
</div>

<!-- Filter -->
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-sm mb-1">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-purple-400">
        </div>

        <div>
            <label class="block text-sm mb-1">Sampai Tanggal</label>
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

<!-- Total Keseluruhan -->
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h4 class="text-gray-500 text-sm">Total Keseluruhan</h4>
    <p class="text-3xl font-bold text-pink-600">
        Rp {{ number_format($totalKeseluruhan,0,',','.') }}
    </p>
</div>

<!-- Table -->
<div class="bg-white p-6 rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Tanggal</th>
                <th class="text-left p-2">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendapatan as $p)
                <tr class="border-b hover:bg-purple-50">
                    <td class="p-2">
                        {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}
                    </td>
                    <td class="p-2 font-semibold">
                        Rp {{ number_format($p->total,0,',','.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-4 text-center text-gray-500">
                        Tidak ada data pendapatan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection