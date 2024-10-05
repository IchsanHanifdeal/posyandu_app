<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\IdentitasAnak;
use App\Models\PerkembanganAnak;

class PerkembanganAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.perkembangan_anak', [
            'pemeriksaan' => PerkembanganAnak::all(),
            'users' => Ibu::all(),
            'anaks' => IdentitasAnak::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'id_ibu' => 'required|exists:users,id_user',
            'id_anak' => 'required|exists:identitas_anak,id_anak',
            'pemeriksaan' => 'required|date',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'pemberian_asi' => 'required|string|max:255',
            'pelayanan' => 'required|string|max:255',
            'pemberian_imunisasi' => 'required|string|max:255',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Simpan data ke tabel identitas_anak
        try {
            PerkembanganAnak::create([
                'id_ibu' => $request->id_ibu,
                'id_anak' => $request->id_anak,
                'pemeriksaan' => $request->pemeriksaan,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'pemberian_asi' => $request->pemberian_asi,
                'pelayanan' => $request->pelayanan,
                'pemberian_imunisasi' => $request->pemberian_imunisasi,
                'catatan' => $request->catatan,
            ]);

            // Redirect dengan notifikasi toast sukses
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Data perkembangan anak berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect kembali dengan notifikasi toast error
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data perkembangan anak!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PerkembanganAnak $perkembanganAnak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerkembanganAnak $perkembanganAnak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerkembanganAnak $perkembanganAnak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerkembanganAnak $perkembanganAnak)
    {
        //
    }
}