<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Diskon;

class DiskonController extends Controller
{

    public function index()
    {
        $diskon = Diskon::latest()->get();

        return view('super.diskon.index', compact('diskon'));
    }

    public function create()
    {
        return view('super.diskon.create');
    }

    public function store(Request $request)
    {
        Diskon::create([
            'nama_diskon' => $request->nama_diskon,
            'persen' => $request->persen
        ]);

        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin.diskon.index')
                ->with('success','Diskon berhasil ditambahkan');
        }

        return redirect()->route('super.diskon.index')
            ->with('success','Diskon berhasil ditambahkan');
    }

    public function edit($id)
    {
        $diskon = Diskon::findOrFail($id);

        return view('super.diskon.edit', compact('diskon'));
    }

    public function update(Request $request,$id)
    {
        $diskon = Diskon::findOrFail($id);

        $diskon->update([
            'nama_diskon' => $request->nama_diskon,
            'persen' => $request->persen
        ]);

        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin.diskon.index')
                ->with('success','Diskon berhasil diupdate');
        }

        return redirect()->route('super.diskon.index')
            ->with('success','Diskon berhasil diupdate');
    }

    public function destroy($id)
    {
        Diskon::destroy($id);

        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin.diskon.index')
                ->with('success','Diskon berhasil dihapus');
        }

        return redirect()->route('super.diskon.index')
            ->with('success','Diskon berhasil dihapus');
    }
}