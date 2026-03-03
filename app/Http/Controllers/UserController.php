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
    $user = User::findOrFail($id);

    // ❌ Cegah edit akun super utama
    if ($user->email === 'super@gfriend.com') {
        return redirect('/users')
            ->with('error', 'Akun Super Utama tidak bisa diedit!');
    }

    return view('super.edit', compact('user'));
}

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // ❌ Cegah update akun super utama
    if ($user->email === 'super@gfriend.com') {
        return redirect('/users')
            ->with('error', 'Akun Super Utama tidak bisa diupdate!');
    }

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

    if ($request->password) {
        $updateData['password'] = Hash::make($request->password);
    }

    $user->update($updateData);

    return redirect('/users')
        ->with('success', 'User berhasil diupdate!');
}

 public function destroy($id)
{
    $user = User::findOrFail($id);

    // ❌ Cegah hapus akun super utama
    if ($user->email === 'super@gfriend.com') {
        return redirect('/users')
            ->with('error', 'Akun Super Utama tidak bisa dihapus!');
    }

    // ❌ Cegah hapus akun sendiri
    if (Auth::id() == $user->id) {
        return redirect('/users')
            ->with('error', 'Tidak bisa menghapus akun sendiri!');
    }

    // ✅ Hapus user
    $user->delete();

    return redirect('/users')
        ->with('success', 'User berhasil dihapus!');
}
}