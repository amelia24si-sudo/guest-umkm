<?php
// app/Http/Controllers/PesananController.php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Media;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get filter parameters
        // Build query dengan filter
        $query = Pesanan::with(['warga', 'buktiBayar'])
            ->search($request->search)
            ->byStatus($request->status)
            ->byWarga($request->warga_id)
            ->byMetodeBayar($request->metode_bayar)
            ->byDateRange($request->start_date, $request->end_date);

        // Sorting
        if ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($request->sort == 'total_asc') {
            $query->orderBy('total', 'asc');
        } elseif ($request->sort == 'total_desc') {
            $query->orderBy('total', 'desc');
        } else {
            $query->latest();
        }

        // Get statistics untuk dashboard cards
        $totalPesanan    = Pesanan::count();
        $pesananPending  = Pesanan::where('status', 'pending')->count();
        $pesananDiproses = Pesanan::where('status', 'diproses')->count();
        $pesananSelesai  = Pesanan::where('status', 'selesai')->count();

        // Paginate results
        $pesanan = $query->paginate(10);

        // Get data untuk filters
        $warga = Warga::orderBy('nama')->get();

        return view('page.tambahdata.pesanan.index', compact(
            'pesanan',
            'warga',
            'totalPesanan',
            'pesananPending',
            'pesananDiproses',
            'pesananSelesai'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga  = Warga::orderBy('nama')->get();
        $produk = Produk::where('status', 'aktif')->orderBy('nama_produk')->get();

        return view('page.tambahdata.pesanan.create', compact('warga', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dasar
        $validated = $request->validate([
            'warga_id'       => 'required|exists:warga,warga_id',
            'status'         => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
            'alamat_kirim'   => 'required|string|max:500',
            'rt'             => 'required|string|max:3',
            'rw'             => 'required|string|max:3',
            'metode_bayar'   => 'required|in:transfer,cod,tunai',
            'bukti_bayar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'produk_id'      => 'required|array|min:1',
            'produk_id.*'    => 'exists:produk,produk_id',
            'qty'            => 'required|array|min:1',
            'qty.*'          => 'integer|min:1',
            'harga_satuan'   => 'required|array|min:1',
            'harga_satuan.*' => 'numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Generate nomor pesanan
            $validated['nomor_pesanan'] = Pesanan::generateNomorPesanan();

            // Hitung total dari detail produk
            $total = 0;
            foreach ($validated['produk_id'] as $key => $produkId) {
                $subtotal = $validated['qty'][$key] * $validated['harga_satuan'][$key];
                $total += $subtotal;
            }

            // Create pesanan
            $pesanan = Pesanan::create([
                'nomor_pesanan' => $validated['nomor_pesanan'],
                'warga_id'      => $validated['warga_id'],
                'total'         => $total,
                'status'        => $validated['status'],
                'alamat_kirim'  => $validated['alamat_kirim'],
                'rt'            => $validated['rt'],
                'rw'            => $validated['rw'],
                'metode_bayar'  => $validated['metode_bayar'],
            ]);

            // Simpan detail pesanan
            foreach ($validated['produk_id'] as $key => $produkId) {
                DetailPesanan::create([
                    'pesanan_id'   => $pesanan->pesanan_id,
                    'produk_id'    => $produkId,
                    'qty'          => $validated['qty'][$key],
                    'harga_satuan' => $validated['harga_satuan'][$key],
                    'subtotal'     => $validated['qty'][$key] * $validated['harga_satuan'][$key],
                ]);

                // Update stok produk (opsional, jika ingin mengurangi stok)
                $produk = Produk::find($produkId);
                if ($produk) {
                    $produk->decrement('stok', $validated['qty'][$key]);
                }
            }

            // Upload bukti bayar jika ada
            if ($request->hasFile('bukti_bayar')) {
                $file     = $request->file('bukti_bayar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path     = $file->storeAs('bukti_bayar', $filename, 'public');

                Media::create([
                    'ref_table'  => 'pesanan',
                    'ref_id'     => $pesanan->pesanan_id,
                    'file_nama'  => $path,
                    'caption'    => 'Bukti Bayar - ' . $pesanan->nomor_pesanan,
                    'mime_type'  => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }

            DB::commit();

            return redirect()->route('pesanan.show', $pesanan->pesanan_id)
                ->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['warga', 'media', 'detailPesanan.produk.umkm']);

        return view('page.tambahdata.pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        $pesanan->load(['warga', 'buktiBayar', 'detailPesanan.produk']);
        $warga  = Warga::orderBy('nama')->get();
        $produk = Produk::where('status', 'aktif')->orderBy('nama_produk')->get();

        return view('page.tambahdata.pesanan.edit', compact('pesanan', 'warga', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        // Validasi dasar
        $validated = $request->validate([
            'warga_id'       => 'required|exists:warga,warga_id',
            'status'         => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
            'alamat_kirim'   => 'required|string|max:500',
            'rt'             => 'required|string|max:3',
            'rw'             => 'required|string|max:3',
            'metode_bayar'   => 'required|in:transfer,cod,tunai',
            'bukti_bayar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'produk_id'      => 'required|array|min:1',
            'produk_id.*'    => 'exists:produk,produk_id',
            'qty'            => 'required|array|min:1',
            'qty.*'          => 'integer|min:1',
            'harga_satuan'   => 'required|array|min:1',
            'harga_satuan.*' => 'numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Generate nomor pesanan
            $validated['nomor_pesanan'] = Pesanan::generateNomorPesanan();

            // Hitung total dari detail produk
            $total = 0;
            foreach ($validated['produk_id'] as $key => $produkId) {
                $subtotal = $validated['qty'][$key] * $validated['harga_satuan'][$key];
                $total += $subtotal;
            }

            // Create pesanan
            $pesanan = Pesanan::create([
                'nomor_pesanan' => $validated['nomor_pesanan'],
                'warga_id'      => $validated['warga_id'],
                'total'         => $total,
                'status'        => $validated['status'],
                'alamat_kirim'  => $validated['alamat_kirim'],
                'rt'            => $validated['rt'],
                'rw'            => $validated['rw'],
                'metode_bayar'  => $validated['metode_bayar'],
            ]);

            // Simpan detail pesanan
            foreach ($validated['produk_id'] as $key => $produkId) {
                DetailPesanan::create([
                    'pesanan_id'   => $pesanan->pesanan_id,
                    'produk_id'    => $produkId,
                    'qty'          => $validated['qty'][$key],
                    'harga_satuan' => $validated['harga_satuan'][$key],
                    'subtotal'     => $validated['qty'][$key] * $validated['harga_satuan'][$key],
                ]);

                // Update stok produk (opsional, jika ingin mengurangi stok)
                $produk = Produk::find($produkId);
                if ($produk) {
                    $produk->decrement('stok', $validated['qty'][$key]);
                }
            }

            // Upload bukti bayar jika ada
            if ($request->hasFile('bukti_bayar')) {
                $file     = $request->file('bukti_bayar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path     = $file->storeAs('bukti_bayar', $filename, 'public');

                Media::create([
                    'ref_table'  => 'pesanan',
                    'ref_id'     => $pesanan->pesanan_id,
                    'file_nama'  => $path,
                    'caption'    => 'Bukti Bayar - ' . $pesanan->nomor_pesanan,
                    'mime_type'  => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }

            DB::commit();

            return redirect()->route('pesanan.show', $pesanan->pesanan_id)
                ->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        DB::beginTransaction();
        try {
            // Hapus detail pesanan terlebih dahulu
            $pesanan->detailPesanan()->delete();

            // Hapus bukti bayar jika ada
            $oldMedia = $pesanan->buktiBayar;
            if ($oldMedia) {
                Storage::disk('public')->delete($oldMedia->file_nama);
                $oldMedia->delete();
            }

            // Hapus pesanan
            $pesanan->delete();

            DB::commit();

            return redirect()->route('pesanan.index')
                ->with('success', 'Pesanan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus item dari detail pesanan
     */
    public function hapusItemDetail(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'detail_id' => 'required|exists:detail_pesanan,detail_id',
        ]);

        $detail = DetailPesanan::find($request->detail_id);

        if ($detail && $detail->pesanan_id == $pesanan->pesanan_id) {
            $detail->delete();

            // Update total pesanan
            $total = $pesanan->detailPesanan()->sum('subtotal');
            $pesanan->update(['total' => $total]);

            return back()->with('success', 'Item berhasil dihapus dari pesanan.');
        }

        return back()->with('error', 'Gagal menghapus item.');
    }

    /**
     * Menghapus bukti bayar
     */
    public function hapusBuktiBayar(Request $request, Pesanan $pesanan)
    {
        $media = Media::find($request->media_id);

        if ($media && $media->ref_id == $pesanan->pesanan_id && $media->ref_table == 'pesanan') {
            Storage::disk('public')->delete($media->file_nama);
            $media->delete();

            return back()->with('success', 'Bukti bayar berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus bukti bayar.');
    }

    /**
     * Mengubah status pesanan
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
        ]);

        $pesanan->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
