<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UmkmController extends Controller
{
    // Menampilkan semua UMKM
    public function index(Request $request)
    {
        try {
            $query = Umkm::with(['pemilik', 'media'])
                        ->whereHas('pemilik');

            // Filter berdasarkan pencarian
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_usaha', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('kategori', 'like', "%{$search}%")
                      ->orWhereHas('pemilik', function($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      });
                });
            }

            // Filter berdasarkan kategori
            if ($request->has('kategori') && $request->kategori != '') {
                $query->where('kategori', $request->kategori);
            }

            $umkms = $query->orderBy('nama_usaha', 'asc')->get();

            // Debug: Uncomment baris berikut jika masih ada masalah
            // dd($umkms);

            return view('layout.users.index3', compact('umkms'));

        } catch (\Exception $e) {
            // Fallback jika ada error
            $umkms = collect(); // empty collection
            return view('layout.users.index3', compact('umkms'));
        }
    }

    // Menampilkan detail UMKM
    public function show($id)
    {
        try {
            // Ambil data UMKM dari database berdasarkan ID
            $umkm = Umkm::with(['pemilik', 'media'])
                        ->where('umkm_id', $id)
                        ->firstOrFail();

            // Ambil UMKM lainnya untuk rekomendasi
            $umkmLainnya = Umkm::with(['pemilik', 'media'])
                              ->where('umkm_id', '!=', $id)
                              ->whereHas('pemilik')
                              ->inRandomOrder()
                              ->limit(4)
                              ->get();

            return view('Umkm.show', compact('umkm', 'umkmLainnya'));

        } catch (\Exception $e) {
            return redirect()->route('umkm.index')
                ->with('error', 'UMKM tidak ditemukan.');
        }
    }

    public function layanan()
    {
        return view('Umkm.layanan');
    }

    public function about()
    {
        return view('Umkm.about');
    }

    // Menampilkan halaman kontak
    public function kontak()
    {
        return view('Umkm.kontak');
    }

    // Proses form kontak
    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subjek' => 'required|string|max:200',
            'pesan' => 'required|string|max:1000'
        ]);

        // Di sini Anda bisa menambahkan logika untuk mengirim email
        // atau menyimpan pesan ke database

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan merespons secepatnya.');
    }
}
