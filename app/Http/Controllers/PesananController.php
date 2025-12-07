<?php
namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status', 'metode_bayar', 'rt', 'rw'];
        $searchableColumns = ['nomor_pesanan', 'alamat_kirim'];

        $pesananQuery = Pesanan::with(['warga']);

        // Apply search
        $pesananQuery->search($request, $searchableColumns);

        // Apply filters
        $pesananQuery->filter($request, $filterableColumns);

        // Apply date filter
        if ($request->filled('dari') && $request->filled('sampai')) {
            $pesananQuery->filterTanggal($request->dari, $request->sampai);
        }

        // Apply warga filter
        if ($request->filled('warga_id')) {
            $pesananQuery->filterWarga($request->warga_id);
        }

        // Apply sorting
        $sort = $request->input('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $pesananQuery->orderBy('created_at', 'asc');
                break;
            case 'total_tertinggi':
                $pesananQuery->orderBy('total', 'desc');
                break;
            case 'total_terendah':
                $pesananQuery->orderBy('total', 'asc');
                break;
            case 'nomor_asc':
                $pesananQuery->orderBy('nomor_pesanan', 'asc');
                break;
            case 'nomor_desc':
                $pesananQuery->orderBy('nomor_pesanan', 'desc');
                break;
            case 'terbaru':
            default:
                $pesananQuery->orderBy('created_at', 'desc');
                break;
        }

        // Hitung statistik
        $totalPesanan    = Pesanan::count();
        $totalPendapatan = Pesanan::where('status', 'selesai')->sum('total');
        $pesananBaru     = Pesanan::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $pesananDiproses = Pesanan::where('status', 'diproses')->count();

        $pesanan   = $pesananQuery->paginate(15)->onEachSide(2)->withQueryString();
        $wargaList = Warga::orderBy('nama', 'asc')->get();

        return view('page.tambahdata.pesanan.index', compact(
            'pesanan',
            'wargaList',
            'totalPesanan',
            'totalPendapatan',
            'pesananBaru',
            'pesananDiproses'
        ));
    }

    public function create()
    {
        $wargaList = Warga::orderBy('nama', 'asc')->get();
        return view('page.tambahdata.pesanan.create', compact('wargaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id'        => 'required|exists:warga,warga_id',
            'total'           => 'required|numeric|min:0',
            'status'          => 'required|in:menunggu_pembayaran,diproses,dikirim,selesai,dibatalkan',
            'alamat_kirim'    => 'required',
            'rt'              => 'required',
            'rw'              => 'required',
            'metode_bayar'    => 'required|in:transfer,cod,lainnya',
            'bukti_bayar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resi_pengiriman' => 'nullable|string|max:100',
        ]);

        try {
            $data                  = $request->all();
            $data['nomor_pesanan'] = 'PES-' . date('Ymd') . '-' . Str::random(6);

            // Handle file upload
            if ($request->hasFile('bukti_bayar')) {
                $file                = $request->file('bukti_bayar');
                $filename            = time() . '_' . Str::slug($data['nomor_pesanan']) . '.' . $file->getClientOriginalExtension();
                $path                = $file->storeAs('bukti_bayar', $filename, 'public');
                $data['bukti_bayar'] = $path;
            }

            Pesanan::create($data);

            return redirect()->route('pesanan.index')
                ->with('success', 'Pesanan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['warga']);
        return view('page.tambahdata.pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        $wargaList = Warga::orderBy('nama', 'asc')->get();
        return view('page.tambahdata.pesanan.edit', compact('pesanan', 'wargaList'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'warga_id'        => 'required|exists:warga,warga_id',
            'total'           => 'required|numeric|min:0',
            'status'          => 'required|in:menunggu_pembayaran,diproses,dikirim,selesai,dibatalkan',
            'alamat_kirim'    => 'required',
            'rt'              => 'required',
            'rw'              => 'required',
            'metode_bayar'    => 'required|in:transfer,cod,lainnya',
            'bukti_bayar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resi_pengiriman' => 'nullable|string|max:100',
        ]);

        try {
            $data = $request->all();

            // Handle file upload
            if ($request->hasFile('bukti_bayar')) {
                // Delete old file if exists
                if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
                    Storage::disk('public')->delete($pesanan->bukti_bayar);
                }

                $file                = $request->file('bukti_bayar');
                $filename            = time() . '_' . Str::slug($pesanan->nomor_pesanan) . '.' . $file->getClientOriginalExtension();
                $path                = $file->storeAs('bukti_bayar', $filename, 'public');
                $data['bukti_bayar'] = $path;
            }

            $pesanan->update($data);

            return redirect()->route('pesanan.index')
                ->with('success', 'Pesanan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Pesanan $pesanan)
    {
        try {
            // Delete file if exists
            if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
                Storage::disk('public')->delete($pesanan->bukti_bayar);
            }

            $pesanan->delete();

            return redirect()->route('pesanan.index')
                ->with('success', 'Pesanan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:menunggu_pembayaran,diproses,dikirim,selesai,dibatalkan',
        ]);

        try {
            $pesanan->update(['status' => $request->status]);

            return redirect()->back()
                ->with('success', 'Status pesanan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Upload bukti bayar
     */
    public function uploadBuktiBayar(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Delete old file if exists
            if ($pesanan->bukti_bayar && Storage::disk('public')->exists($pesanan->bukti_bayar)) {
                Storage::disk('public')->delete($pesanan->bukti_bayar);
            }

            $file     = $request->file('bukti_bayar');
            $filename = time() . '_' . Str::slug($pesanan->nomor_pesanan) . '.' . $file->getClientOriginalExtension();
            $path     = $file->storeAs('bukti_bayar', $filename, 'public');

            $pesanan->update([
                'bukti_bayar' => $path,
                'status'      => 'diproses',
            ]);

            return redirect()->back()
                ->with('success', 'Bukti bayar berhasil diupload');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get pesanan statistics for dashboard
     */
    public function dashboard()
    {
        $totalPesanan    = Pesanan::count();
        $totalPendapatan = Pesanan::where('status', 'selesai')->sum('total');
        $pesananBaru     = Pesanan::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Pesanan per status
        $pesananMenunggu = Pesanan::where('status', 'menunggu_pembayaran')->count();
        $pesananDiproses = Pesanan::where('status', 'diproses')->count();
        $pesananDikirim  = Pesanan::where('status', 'dikirim')->count();
        $pesananSelesai  = Pesanan::where('status', 'selesai')->count();

        // Pesanan terbaru
        $pesananTerbaru = Pesanan::with('warga')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('page.tambahdata.pesanan.dashboard', compact(
            'totalPesanan',
            'totalPendapatan',
            'pesananBaru',
            'pesananMenunggu',
            'pesananDiproses',
            'pesananDikirim',
            'pesananSelesai',
            'pesananTerbaru'
        ));
    }

    /**
     * Get pesanan by warga
     */
    public function getByWarga(Warga $warga)
    {
        $pesanan = Pesanan::where('warga_id', $warga->warga_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('page.tambahdata.pesanan.by-warga', compact('pesanan', 'warga'));
    }

    /**
     * Generate laporan pesanan
     */
    public function laporan(Request $request)
    {
        $pesananQuery = Pesanan::with('warga');

        if ($request->filled('dari') && $request->filled('sampai')) {
            $pesananQuery->whereBetween('created_at', [$request->dari, $request->sampai]);
        }

        if ($request->filled('status')) {
            $pesananQuery->where('status', $request->status);
        }

        $pesanan = $pesananQuery->orderBy('created_at', 'desc')->get();

        $totalPendapatan = $pesanan->where('status', 'selesai')->sum('total');

        return view('page.tambahdata.pesanan.laporan', compact('pesanan', 'totalPendapatan'));
    }
}
