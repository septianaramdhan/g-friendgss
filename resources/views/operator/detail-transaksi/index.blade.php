@extends('layouts.app')

@section('title','Detail Transaksi')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-bold text-lg mb-4">
Detail Transaksi
</h3>

<table class="w-full border">

<thead class="bg-gray-100">

<tr>
<th class="p-2">Kode</th>
<th class="p-2">Barang</th>
<th class="p-2">Qty</th>
<th class="p-2">Subtotal</th>
</tr>

</thead>

<tbody>

<tr>
<td class="p-2">TRX-001</td>
<td class="p-2">Indomie</td>
<td class="p-2">2</td>
<td class="p-2">6000</td>
</tr>

</tbody>

</table>

</div>

@endsection