<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\UlasanProduk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                ->paginate(9); // Tampilkan 9 UMKM per halaman

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
            $umkm = Umkm::with(['pemilik', 'media', 'produk.ulasan.warga'])
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

    public function showFormUlasan($produkId)
    {
        try {
            $produk = Produk::with(['umkm', 'ulasan.warga'])
                ->findOrFail($produkId);

            return view('page.Umkm.form-ulasan', compact('produk'));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Produk tidak ditemukan.');
        }
    }

    /**
     * Menambahkan ulasan produk
     */
    public function tambahUlasan(Request $request, $produkId)
    {
        try {
            $request->validate([
                'rating'   => 'required|integer|between:1,5',
                'komentar' => 'nullable|string|max:1000',
            ]);

            // Cek apakah produk ada
            $produk = Produk::findOrFail($produkId);

            // Cek apakah user sudah login
            if (! Auth::check()) {
                return redirect()->route('login')
                    ->with('error', 'Silakan login terlebih dahulu untuk memberikan ulasan.');
            }

            // Ambil ID user yang login
            $userId = Auth::id();

            // NOTE: Asumsi warga_id sama dengan user_id
            $wargaId = $userId;

            // Cek apakah sudah memberikan ulasan untuk produk ini
            $existingUlasan = UlasanProduk::where('produk_id', $produkId)
                ->where('warga_id', $wargaId)
                ->first();

            if ($existingUlasan) {
                $existingUlasan->update([
                    'rating'   => $request->rating,
                    'komentar' => $request->komentar,
                ]);
                $message = 'Ulasan berhasil diperbarui.';
            } else {
                UlasanProduk::create([
                    'produk_id' => $produkId,
                    'warga_id'  => $wargaId,
                    'rating'    => $request->rating,
                    'komentar'  => $request->komentar,
                ]);
                $message = 'Ulasan berhasil ditambahkan.';
            }

            return redirect()->route('umkm.show', $produk->umkm_id)
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan ulasan. ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan semua ulasan untuk sebuah produk
     */
    public function tampilUlasan($produkId)
    {
        try {
            $produk = Produk::with(['umkm', 'ulasan.warga'])
                ->findOrFail($produkId);

            $ulasan = $produk->ulasan()
                ->with('warga')
                ->latest()
                ->paginate(10);

            return view('page.Umkm.ulasan', compact('produk', 'ulasan'));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:100',
            'subjek' => 'required|string|max:200',
            'pesan'  => 'required|string|max:1000',
        ]);

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan merespons secepatnya.');
    }
}
