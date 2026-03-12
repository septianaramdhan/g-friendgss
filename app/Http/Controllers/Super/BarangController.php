<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Diskon;

class BarangController extends Controller
{

    public function index()
    {
        $barang = Barang::with('diskon')->latest()->get();

        return view('super.barang.index', compact('barang'));
    }

    public function create()
    {
        $diskon = Diskon::all();

        return view('super.barang.create', compact('diskon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'diskon_id' => 'nullable'
        ]);

        Barang::create($request->all());

        return redirect()->route('super.barang.index')
            ->with('success','Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $diskon = Diskon::all();

        return view('super.barang.edit', compact('barang','diskon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'diskon_id' => 'nullable'
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update($request->all());

        return redirect()->route('super.barang.index')
            ->with('success','Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('super.barang.index')
            ->with('success','Barang berhasil dihapus');
    }
}