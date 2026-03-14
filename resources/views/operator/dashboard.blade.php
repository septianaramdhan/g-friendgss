@extends('layouts.app')

@section('title','Dashboard Operator')

@section('content')

<div class="grid grid-cols-3 gap-6 mb-6">

    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-6 rounded-xl shadow-lg">
        <h3 class="text-sm">Transaksi Hari Ini</h3>
        <p class="text-2xl font-bold mt-2">
            {{ $transaksiHariIni ?? 0 }}
        </p>
    </div>

    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-6 rounded-xl shadow-lg">
        <h3 class="text-sm">Pendapatan Hari Ini</h3>
        <p class="text-2xl font-bold mt-2">
            Rp {{ number_format($pendapatanHariIni ?? 0,0,',','.') }}
        </p>
    </div>

    <div class="bg-gradient-to-r from-pink-500 to-rose-500 text-white p-6 rounded-xl shadow-lg">
        <h3 class="text-sm">Jam Sekarang</h3>
        <p id="jam" class="text-2xl font-bold mt-2">
            00:00:00
        </p>
    </div>

</div>


<div class="grid grid-cols-3 gap-6">

    {{-- RIWAYAT TRANSAKSI --}}
    <div class="col-span-2 bg-white p-6 rounded-xl shadow-lg">

        <h3 class="font-bold text-lg mb-4">
            Riwayat Transaksi
        </h3>

        <table class="w-full text-sm">

            <thead class="border-b">
                <tr>
                    <th class="text-left p-2">No</th>
                    <th class="text-left p-2">Kode</th>
                    <th class="text-left p-2">Total</th>
                    <th class="text-left p-2">Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($riwayat as $i => $trx)

                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $i+1 }}</td>
                    <td class="p-2">{{ $trx->kode_transaksi }}</td>
                    <td class="p-2">
                        Rp {{ number_format($trx->total,0,',','.') }}
                    </td>
                    <td class="p-2">
                        {{ $trx->created_at }}
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-500">
                        Belum ada transaksi
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- BEST SELLER --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">

        <h3 class="font-bold text-lg mb-4">
            Best Seller
        </h3>

        @forelse($bestSeller as $item)

        <div class="mb-3">

            <p class="font-bold text-purple-700">
                {{ $item->nama_barang }}
            </p>

            <p class="text-sm text-gray-600">
                Terjual {{ $item->total }}x
            </p>

        </div>

        @empty

        <p class="text-gray-500 text-sm">
            Belum ada transaksi
        </p>

        @endforelse

    </div>

</div>


<script>

function updateJam(){

    const now = new Date();

    let jam = now.getHours().toString().padStart(2,'0');
    let menit = now.getMinutes().toString().padStart(2,'0');
    let detik = now.getSeconds().toString().padStart(2,'0');

    document.getElementById("jam").innerText = jam + ":" + menit + ":" + detik;

}

setInterval(updateJam,1000);
updateJam();

</script>

@endsection