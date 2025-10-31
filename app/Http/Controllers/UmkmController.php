<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Media;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    // Menampilkan semua UMKM
    public function index(Request $request)
    {
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

        return view('Umkm.index', compact('umkms'));
    }

    // Menampilkan detail UMKM
    public function show($id)
    {
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
