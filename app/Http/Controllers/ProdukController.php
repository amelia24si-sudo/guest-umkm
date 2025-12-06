<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['umkm', 'media'])->paginate(10);

        // Hitung statistik untuk dashboard
        $totalProduk = Produk::count();
        $produkAktif = Produk::where('status', 'aktif')->count();
        $totalStok   = Produk::sum('stok');
        $produkBaru  = Produk::whereMonth('created_at', date('m'))->count();

        return view('page.tambahdata.produk.index', compact('produk', 'totalProduk', 'produkAktif', 'totalStok', 'produkBaru'));

    }

    public function create()
    {
        $umkm = Umkm::with('pemilik')->orderBy('nama_usaha', 'asc')->get();
        return view('page.tambahdata.produk.create', compact('umkm'));
    }

    public function store(Request $request)
    {
        // Di method store
        $validated = $request->validate([
            'umkm_id'     => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'status'      => 'required|in:aktif,nonaktif', // Pastikan hanya menerima 'aktif' atau 'nonaktif'
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Format harga
        $validated['harga'] = (float) $validated['harga'];

        $produk = Produk::create($validated);

        // Handle file upload untuk foto produk
        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $path = $file->store('produk', 'public');
            Media::create([
                'ref_table' => 'produk',
                'ref_id'    => $produk->produk_id,
                'file_url'  => $path,
                'mime_type' => $file->getMimeType(),
                'caption'   => 'Foto Produk',
            ]);
        }

        session()->flash('success', 'Data produk berhasil ditambahkan.');
        return redirect()->route('produk.index');
    }

    public function show(Produk $produk)
    {
        $produk->load(['umkm.pemilik', 'media']);
        return view('page.tambahdata.produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $umkm = Umkm::with('pemilik')->orderBy('nama_usaha', 'asc')->get();
        $produk->load('media');
        return view('page.tambahdata.produk.edit', compact('produk', 'umkm'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'umkm_id'     => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'status'      => 'required|in:aktif,nonaktif',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Format harga
        $validated['harga'] = (float) $validated['harga'];

        $produk->update($validated);

        // Handle file upload
        if ($request->hasFile('foto_produk')) {
            // Hapus media lama jika ada
            $oldMedia = $produk->media()->where('caption', 'Foto Produk')->first();
            if ($oldMedia) {
                Storage::disk('public')->delete($oldMedia->file_url);
                $oldMedia->delete();
            }

            $file = $request->file('foto_produk');
            $path = $file->store('produk', 'public');
            Media::create([
                'ref_table' => 'produk',
                'ref_id'    => $produk->produk_id,
                'file_url'  => $path,
                'mime_type' => $file->getMimeType(),
                'caption'   => 'Foto Produk',
            ]);
        }

        session()->flash('success', 'Data produk berhasil diperbarui.');
        return redirect()->route('produk.index');
    }

    public function destroy(Produk $produk)
    {
        // Hapus media terkait
        foreach ($produk->media as $media) {
            Storage::disk('public')->delete($media->file_url);
            $media->delete();
        }

        $produk->delete();

        session()->flash('success', 'Data produk berhasil dihapus.');
        return redirect()->route('produk.index');
    }
}
