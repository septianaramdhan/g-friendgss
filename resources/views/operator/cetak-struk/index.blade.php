@extends('layouts.app')

@section('title','Cetak Struk')

@section('content')

<div class="bg-white p-6 rounded-xl shadow max-w-sm">

<h3 class="text-center font-bold mb-4">
G-FRIEND STORE
</h3>

<p>Kode : TRX-001</p>
<p>Tanggal : 14-03-2026</p>

<hr class="my-2">

<p>Indomie x2 - 6000</p>
<p>Aqua x1 - 4000</p>

<hr class="my-2">

<p class="font-bold">
Total : Rp 10000
</p>

<button onclick="window.print()"
class="mt-4 bg-purple-600 text-white px-4 py-2 rounded w-full">

Cetak

</button>

</div>

@endsection