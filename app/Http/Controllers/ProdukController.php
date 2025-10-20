<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('umkm')->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        $umkm = Umkm::all();
        return view('admin.produk.create', compact('umkm'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::create($validated);

        // Handle file upload untuk foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('produk', 'public');
            Media::create([
                'ref_table' => 'produk',
                'ref_id' => $produk->produk_id,
                'file_url' => $path,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Produk',
            ]);
        }

        session()->flash('success', 'Produk berhasil ditambahkan.');
        return redirect()->route('produk.index');
    }

    public function show(Produk $produk)
    {
        $produk->load('umkm', 'media');
        return view('admin.produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $umkm = Umkm::all();
        $produk->load('media');
        return view('admin.produk.edit', compact('produk', 'umkm'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'umkm_id' => 'required|exists:umkm,umkm_id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk->update($validated);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Hapus media lama jika ada
            $oldMedia = $produk->media()->where('caption', 'Foto Produk')->first();
            if ($oldMedia) {
                Storage::disk('public')->delete($oldMedia->file_url);
                $oldMedia->delete();
            }

            $file = $request->file('foto');
            $path = $file->store('produk', 'public');
            Media::create([
                'ref_table' => 'produk',
                'ref_id' => $produk->produk_id,
                'file_url' => $path,
                'mime_type' => $file->getMimeType(),
                'caption' => 'Foto Produk',
            ]);
        }

        session()->flash('success', 'Produk berhasil diperbarui.');
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

        session()->flash('success', 'Produk berhasil dihapus.');
        return redirect()->route('produk.index');
    }
}
