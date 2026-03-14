@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')

<div class="grid grid-cols-3 gap-6 mb-6">

    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-6 rounded-xl shadow-lg">
        <h3 class="text-sm">Total Barang</h3>
        <p class="text-2xl font-bold mt-2">
            {{ $totalBarang ?? 0 }}
        </p>
    </div>

    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6 rounded-xl shadow-lg">
        <h3 class="text-sm">Total Diskon</h3>
        <p class="text-2xl font-bold mt-2">
            {{ $totalDiskon ?? 0 }}
        </p>
    </div>

    <div class="bg-gradient-to-r from-pink-500 to-rose-500 text-white p-6 rounded-xl shadow-lg">
        <h3 class="text-sm">Stok Menipis</h3>
        <p class="text-2xl font-bold mt-2">
            {{ $stokMenipis ?? 0 }}
        </p>
    </div>

</div>

<div class="bg-white p-6 rounded-xl shadow-lg">

    <h3 class="mb-4 font-bold text-lg">Informasi Admin</h3>

    <p class="text-gray-600">
        Selamat datang <span class="font-bold text-purple-700">{{ auth()->user()->name }}</span>.
        Anda dapat mengelola barang, diskon, dan memantau laporan stok dari menu sidebar.
    </p>

</div>

@endsection