<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return redirect()->route('super.diskon.index');
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

        return redirect()->route('super.diskon.index');
    }

    public function destroy($id)
    {
        Diskon::destroy($id);

        return redirect()->route('super.diskon.index');
    }
}
