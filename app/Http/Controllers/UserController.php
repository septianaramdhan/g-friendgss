<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
{
    $users = User::all(); // ambil semua user

    return view('super.index', compact('users'));
}

    public function create()
    {
        return view('super.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/users')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('super.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        // Kalau password diisi, baru update password
        if ($request->password) {
            $updateData['password'] = Hash::make($request->password);
        }

        $data->update($updateData);

        return redirect('/users')->with('success', 'User berhasil diupdate');
    }

   public function delete($id)
{
    $data = User::findOrFail($id);

    // Cegah hapus akun sendiri
    if (Auth::id() == $data->id) {
        return redirect('/users')->with('error', 'Tidak bisa menghapus akun sendiri');
    }

    $data->delete();

    return redirect('/users')->with('success', 'User berhasil dihapus');
}
}