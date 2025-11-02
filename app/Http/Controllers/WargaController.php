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
    public function index()
    {
        $warga = Warga::orderBy('nama', 'asc')->get();
        return view('page.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.warga.create');
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
        return view('page.warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        return view('page.warga.edit', compact('warga'));
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
        $warga = Warga::select('warga_id', 'nama', 'no_ktp', 'alamat', 'rt', 'rw','telp')
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
