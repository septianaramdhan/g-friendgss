@extends('layouts.app')

@section('title', 'Laporan Stok')

@section('content')

<div class="bg-gradient-to-r from-purple-600 to-pink-500 text-white p-6 rounded-xl shadow-lg mb-6">
    <h3 class="text-2xl font-bold">Laporan Stok Barang</h3>
    <p class="text-sm opacity-90">Monitoring stok barang</p>
</div>

<!-- Info Stok Menipis -->
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h4 class="text-gray-500 text-sm">Jumlah Barang Stok Menipis (≤ 5)</h4>
    <p class="text-2xl font-bold text-red-500">
        {{ $stokMenipis }} Barang
    </p>
</div>

<!-- Table -->
<div class="bg-white p-6 rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Nama Barang</th>
                <th class="text-left p-2">Harga</th>
                <th class="text-left p-2">Stok</th>
                <th class="text-left p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $b)
                <tr class="border-b hover:bg-purple-50">
                    <td class="p-2">{{ $b->nama_barang }}</td>
                    <td class="p-2">
                        Rp {{ number_format($b->harga,0,',','.') }}
                    </td>
                    <td class="p-2 font-semibold">
                        {{ $b->stok }}
                    </td>
                    <td class="p-2">
                        @if($b->stok <= 5)
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">
                                Stok Menipis
                            </span>
                        @else
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
                                Aman
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Tidak ada data barang
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection