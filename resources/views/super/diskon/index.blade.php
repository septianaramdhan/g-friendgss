@extends('layouts.app')

@section('title', 'Kelola Diskon')

@section('content')

<div class="min-h-screen p-8 bg-gradient-to-br from-white via-pink-100 to-pink-300">

    <div class="max-w-6xl mx-auto">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-3xl font-bold text-purple-700">
                Kelola Diskon
            </h2>

            <a href="{{ route('super.diskon.create') }}"
               class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition">
                + Tambah Diskon
            </a>

        </div>


        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

            <table class="w-full text-left">

                <thead class="bg-gradient-to-r from-purple-600 to-pink-500 text-white">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Diskon</th>
                        <th class="p-4">Persen</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($diskon as $index => $d)

                    <tr class="border-b hover:bg-pink-50 transition">

                        <td class="p-4">{{ $index+1 }}</td>

                        <td class="p-4">
                            {{ $d->nama_diskon }}
                        </td>

                        <td class="p-4">
                            {{ $d->persen }} %
                        </td>

                        <td class="p-4 text-center space-x-2">

                            <a href="{{ route('super.diskon.edit',$d->id) }}"
                               class="bg-yellow-400 text-white px-3 py-1 rounded-lg">
                               Edit
                            </a>

                            <form action="{{ route('super.diskon.destroy',$d->id) }}"
                                  method="POST"
                                  class="inline-block">

                                @csrf
                                @method('DELETE')

                                <button
                                class="bg-red-600 text-white px-3 py-1 rounded-lg">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center p-6 text-gray-500">
                            Belum ada data diskon
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection