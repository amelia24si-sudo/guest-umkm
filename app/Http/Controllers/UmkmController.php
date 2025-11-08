<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UmkmController extends Controller
{
    // Method untuk halaman beranda - tampilkan 6 UMKM terbaru
    public function beranda()
    {
        try {
            $umkms = Umkm::with(['pemilik', 'media'])
                        ->whereHas('pemilik')
                        ->orderBy('created_at', 'desc')
                        ->limit(6)
                        ->get();

            return view('layout.users.app', compact('umkms'));

        } catch (\Exception $e) {
            $umkms = collect();
            return view('layout.users.app', compact('umkms'));
        }
    }

    // Method untuk halaman UMKM lengkap - tampilkan semua
    public function index()
    {
        try {
            $umkms = Umkm::with(['pemilik', 'media'])
                        ->whereHas('pemilik')
                        ->orderBy('nama_usaha', 'asc')
                        ->get();

            return view('page.Umkm.app', compact('umkms'));

        } catch (\Exception $e) {
            $umkms = collect();
            return view('page.Umkm.app', compact('umkms'));
        }
    }

    // Menampilkan detail UMKM
    public function show($id)
    {
        try {
            $umkm = Umkm::with(['pemilik', 'media'])
                        ->where('umkm_id', $id)
                        ->firstOrFail();

            $umkmLainnya = Umkm::with(['pemilik', 'media'])
                              ->where('umkm_id', '!=', $id)
                              ->whereHas('pemilik')
                              ->inRandomOrder()
                              ->limit(4)
                              ->get();

            return view('page.Umkm.show', compact('umkm', 'umkmLainnya'));

        } catch (\Exception $e) {
            return redirect()->route('umkm.index')
                ->with('error', 'UMKM tidak ditemukan.');
        }
    }

    public function layanan()
    {
        return view('page.Layanan.app');
    }

    public function about()
    {
        return view('page.about.app');
    }

    public function kontak()
    {
        return view('page.kontak.app');
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subjek' => 'required|string|max:200',
            'pesan' => 'required|string|max:1000'
        ]);

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan merespons secepatnya.');
    }
}
