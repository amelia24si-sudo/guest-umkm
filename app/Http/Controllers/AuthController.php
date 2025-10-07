<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
        return view('auth.login');
    }

    // Memproses form login
    public function login(Request $request)
    {
        // Validasi form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Simpan email yang berhasil login
        $email = $request->email;

        // Untuk sementara, kita anggap login selalu berhasil
        // Dalam aplikasi real, di sini akan ada proses autentikasi

        return view('auth.success', ['email' => $email]);
    }
}
