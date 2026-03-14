<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // VALIDASI INPUT
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // COBA LOGIN
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role;

            // REDIRECT BERDASARKAN ROLE
            if ($role === 'superadmin') {
                return redirect()->route('super.dashboard');
            }

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'operator') {
                return redirect()->route('operator.dashboard');
            }

            // JIKA ROLE TIDAK DIKENALI
            Auth::logout();

            return redirect()
                ->route('login')
                ->with('error', 'Role tidak dikenali');
        }

        // LOGIN GAGAL
        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}