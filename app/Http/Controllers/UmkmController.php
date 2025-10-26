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
}
