@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<div class="flex items-center justify-center min-h-screen">

<div class="bg-gradient-to-br from-purple-600 to-pink-500 shadow-2xl rounded-2xl p-8 w-96 text-white">

<h2 class="text-2xl font-bold text-center mb-6">
Edit Barang
</h2>

<form method="POST" action="{{ route('super.barang.update',$barang->id) }}">

@csrf
@method('PUT')

<div class="mb-4">
<label>Nama Barang</label>
<input type="text" name="nama_barang"
value="{{ old('nama_barang',$barang->nama_barang) }}"
class="w-full mt-1 p-2 rounded-lg text-black">
</div>

<div class="mb-4">
<label>Harga</label>
<input type="number" name="harga"
value="{{ old('harga',$barang->harga) }}"
class="w-full mt-1 p-2 rounded-lg text-black">
</div>

<div class="mb-4">
<label>Stok</label>
<input type="number" name="stok"
value="{{ old('stok',$barang->stok) }}"
class="w-full mt-1 p-2 rounded-lg text-black">
</div>

<div class="mb-6">
<label>Diskon</label>
<input type="number" name="diskon"
value="{{ old('diskon',$barang->diskon) }}"
class="w-full mt-1 p-2 rounded-lg text-black">
</div>

<button
class="w-full bg-white text-purple-600 font-semibold py-2 rounded-lg hover:scale-105 transition">
Update
</button>

</form>

</div>

</div>

@endsection