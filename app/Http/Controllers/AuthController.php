<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
        // Jika user sudah login, redirect berdasarkan role
        if (Auth::check()) {
            $user = Auth::user();
            return $user->role === 'admin'
                ? redirect()->route('dashboard')
                : redirect()->route('umkm.index');
        }

        return view('auth.login');
    }

    // Memproses form login
    public function login(Request $request)
    {
        // Validasi form
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user exists dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['email' => 'Email atau password salah!'])
                ->withInput();
        }

        // Login user
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil! Selamat datang ' . $user->name);
        } else {
            return redirect()->route('umkm.index')
                ->with('success', 'Login berhasil! Selamat datang ' . $user->name);
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')
            ->with('success', 'Logout berhasil!');
    }
}
