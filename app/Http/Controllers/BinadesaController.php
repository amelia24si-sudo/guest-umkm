<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Umkm;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BinadesaController extends Controller
{
    public function index(Request $request)
    {
       $searchableColumns = ['nama_usaha', 'alamat', 'deskripsi'];
        $filterableColumns = ['kategori'];

        $umkmQuery = Umkm::with('pemilik', 'media');

        // Apply search
        $umkmQuery->search($request, $searchableColumns);

        // Apply kategori filter
        if ($request->filled('kategori')) {
            $umkmQuery->filterByCategory($request->kategori);
        }

        // Apply sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $umkmQuery->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $umkmQuery->orderBy('nama_usaha', 'asc');
                break;
            case 'name_desc':
                $umkmQuery->orderBy('nama_usaha', 'desc');
                break;
            case 'newest':
            default:
                $umkmQuery->orderBy('created_at', 'desc');
                break;
        }

        $binadesa = $umkmQuery->paginate(12)->onEachSide(2)->withQueryString();

        // Hitung statistik untuk dashboard
        $totalUsaha        = Umkm::count();
        $usahaAktif        = Umkm::count(); // Sesuaikan jika ada field status
        $kategoriTerbanyak = Umkm::select('kategori')
            ->groupBy('kategori')
            ->orderByRaw('COUNT(*) DESC')
            ->value('kategori') ?? 'Belum ada data';
        $usahaBaru = Umkm::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Get unique categories for filter
        $kategoriList = Umkm::distinct()->whereNotNull('kategori')->orderBy('kategori')->pluck('kategori');

        return view('page.tambahdata.umkm.index', compact(
            'binadesa',
            'totalUsaha',
            'usahaAktif',
            'kategoriTerbanyak',
            'usahaBaru',
            'kategoriList'
        ));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama', 'asc')->get();
        return view('page.tambahdata.umkm.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha'       => 'required|string|max:255',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat'           => 'required|string',
            'rt'               => 'required|string|max:10',
            'rw'               => 'required|string|max:10',
            'kategori'         => 'required|string|max:255',
            'kontak'           => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'logo'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $binadesa = Umkm::create($validated);

        // Handle file upload untuk logo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('umkm', 'public');
            Media::create([
                'ref_table' => 'umkm',
                'ref_id'    => $binadesa->umkm_id,
                'file_url'  => $path,
                'mime_type' => $file->getMimeType(),
                'caption'   => 'Logo UMKM',
            ]);
        }

        session()->flash('success', 'Data UMKM berhasil ditambahkan.');
        return redirect()->route('binadesa.index');
    }

    public function show(Umkm $binadesa)
    {
        $binadesa->load('pemilik', 'media');
        return view('page.tambahdata.umkm.show', compact('binadesa'));
    }

    public function edit(Umkm $binadesa)
    {
        $warga = Warga::orderBy('nama', 'asc')->get();
        $binadesa->load('media');
        return view('page.tambahdata.umkm.edit', compact('binadesa', 'warga'));
    }

    public function update(Request $request, Umkm $binadesa)
    {
        $validated = $request->validate([
            'nama_usaha'       => 'required|string|max:255',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'alamat'           => 'required|string',
            'rt'               => 'required|string|max:10',
            'rw'               => 'required|string|max:10',
            'kategori'         => 'required|string|max:255',
            'kontak'           => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'logo'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $binadesa->update($validated);

        // Handle file upload
        if ($request->hasFile('logo')) {
            // Hapus media lama jika ada
            $oldMedia = $binadesa->media()->where('caption', 'Logo UMKM')->first();
            if ($oldMedia) {
                Storage::disk('public')->delete($oldMedia->file_url);
                $oldMedia->delete();
            }

            $file = $request->file('logo');
            $path = $file->store('umkm', 'public');
            Media::create([
                'ref_table' => 'umkm',
                'ref_id'    => $binadesa->umkm_id,
                'file_url'  => $path,
                'mime_type' => $file->getMimeType(),
                'caption'   => 'Logo UMKM',
            ]);
        }

        session()->flash('success', 'Data UMKM berhasil diperbarui.');
        return redirect()->route('binadesa.index');
    }

    public function destroy(Umkm $binadesa)
    {
        // Hapus media terkait
        foreach ($binadesa->media as $media) {
            Storage::disk('public')->delete($media->file_url);
            $media->delete();
        }

        $binadesa->delete();

        session()->flash('success', 'Data UMKM berhasil dihapus.');
        return redirect()->route('binadesa.index');
    }
}
