@extends('layouts.app')

@section('title', 'Kelola Barang')

@section('content')

<div class="min-h-screen p-8 bg-gradient-to-br from-white via-pink-100 to-pink-300">

    <div class="max-w-6xl mx-auto">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-3xl font-bold text-purple-700">
                List Barang
            </h2>

            <a href="{{ route('super.barang.create') }}"
               class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition">
                + Tambah Barang
            </a>

        </div>


        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

            <table class="w-full text-left">

                <thead class="bg-gradient-to-r from-purple-600 to-pink-500 text-white">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Barang</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Stok</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($barang as $index => $b)

                        <tr class="border-b hover:bg-pink-50 transition">

                            <td class="p-4">{{ $index + 1 }}</td>

                            <td class="p-4">
                                {{ $b->nama_barang }}
                            </td>

                            <td class="p-4">
                                Rp {{ number_format($b->harga,0,',','.') }}
                            </td>

                            <td class="p-4">
                                {{ $b->stok }}
                            </td>


                            <td class="p-4 text-center space-x-2">

                                <a href="{{ route('super.barang.edit', $b->id) }}"
                                   class="bg-yellow-400 text-white px-3 py-1 rounded-lg hover:opacity-80 transition">
                                   Edit
                                </a>


                                <form action="{{ route('super.barang.destroy', $b->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Yakin hapus barang ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Belum ada data barang
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection