<?php
namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin', 'pekerjaan'];
        $searchableColumns = ['nama', 'no_ktp', 'alamat', 'email'];

        $wargaQuery = Warga::withCount('umkm')
            ->with('umkm');

        // Apply search
        $wargaQuery->search($request, $searchableColumns);

        // Apply filters
        $wargaQuery->filter($request, $filterableColumns);

        // Apply UMKM filter - pastikan nama parameter sama dengan form
        if ($request->filled('umkm_status')) {
            $wargaQuery->filterUmkm($request->umkm_status);
        }

        // Apply sorting
        $sort = $request->input('sort', 'nama_asc');
        switch ($sort) {
            case 'terbaru':
                $wargaQuery->orderBy('created_at', 'desc');
                break;
            case 'terlama':
                $wargaQuery->orderBy('created_at', 'asc');
                break;
            case 'nama_desc':
                $wargaQuery->orderBy('nama', 'desc');
                break;
            case 'nama_asc':
            default:
                $wargaQuery->orderBy('nama', 'asc');
                break;
        }

        $warga         = $wargaQuery->paginate(12)->onEachSide(2)->withQueryString();
        $pekerjaanList = Warga::distinct()->whereNotNull('pekerjaan')->orderBy('pekerjaan')->pluck('pekerjaan');

        return view('page.tambahdata.warga.index', compact('warga', 'pekerjaanList'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.tambahdata.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp|max:16',
            'nama'          => 'required|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'nullable|email',
            'alamat'        => 'required',
            'rt'            => 'required',
            'rw'            => 'required',
        ]);

        try {
            Warga::create($request->all());

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Warga $warga)
    {
        $warga->load('umkm');
        return view('page.tambahdata.warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        return view('page.tambahdata.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'no_ktp'        => 'required|max:16|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama'          => 'required|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'nullable|email',
            'alamat'        => 'required',
            'rt'            => 'required',
            'rw'            => 'required',
        ]);

        try {
            $warga->update($request->all());

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Warga $warga)
    {
        try {
            // Cek apakah warga memiliki UMKM menggunakan count()
            if ($warga->umkm->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus warga karena memiliki usaha UMKM');
            }

            $warga->delete();

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get warga data for dropdown (API)
     */
    public function getWargaDropdown()
    {
        $warga = Warga::select('warga_id', 'nama', 'no_ktp', 'alamat', 'rt', 'rw', 'telp')
            ->orderBy('nama', 'asc')
            ->get();

        return response()->json($warga);
    }

    /**
     * Dashboard statistics
     */
    public function dashboard()
    {
        $totalWarga     = Warga::count();
        $wargaLaki      = Warga::where('jenis_kelamin', 'L')->count();
        $wargaPerempuan = Warga::where('jenis_kelamin', 'P')->count();

        // Hitung pemilik UMKM dengan query yang benar
        $pemilikUmkm = Warga::has('umkm')->count();

        $wargaBaru = Warga::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('admin.warga.dashboard', compact(
            'totalWarga',
            'wargaLaki',
            'wargaPerempuan',
            'pemilikUmkm',
            'wargaBaru'
        ));
    }
}
