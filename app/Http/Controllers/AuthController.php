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
        return view('auth.login');
    }

    // Menampilkan form registrasi
    public function showRegister()
    {
        return view('auth.registrasi');
    }

    // Memproses registrasi
    public function register(Request $request)
    {
        // Validasi form
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login user setelah registrasi
        Auth::login($user);

        return redirect('/umkm')
            ->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name);
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

        // Coba login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/umkm')
                ->with('success', 'Login berhasil! Selamat datang ' . Auth::user()->name);
        }

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah!'])
            ->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/umkm')
            ->with('success', 'Logout berhasil!');
    }
}
