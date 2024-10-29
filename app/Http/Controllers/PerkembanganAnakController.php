<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\IdentitasAnak;
use App\Models\PerkembanganAnak;
use Illuminate\Support\Facades\Auth;

class PerkembanganAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'user') {
            $ibu = Auth::user()->ibu;

            if ($ibu) {
                $anaks = $ibu->identitas_anak;
                $pemeriksaan = PerkembanganAnak::whereIn('id_anak', $anaks->pluck('id_anak'))->orderBy('pemeriksaan', 'asc')->get();
            } else {
                $anaks = collect();
                $pemeriksaan = collect();
            }
        } else {
            $anaks = IdentitasAnak::all();
            $pemeriksaan = PerkembanganAnak::orderBy('pemeriksaan', 'asc')->get();
        }

        foreach ($anaks as $anak) {
            $pemeriksaans = $pemeriksaan->where('id_anak', $anak->id_anak)->sortBy('pemeriksaan');
            $previousData = null;

            foreach ($pemeriksaans as $item) {
                if ($previousData) {
                    $item->status_gizi = $this->hitungStatusGizi($item, $previousData);
                } else {
                    $item->status_gizi = 'Gizi Normal (Normal)';
                }

                $previousData = $item;
            }
        }

        return view('dashboard.perkembangan_anak', [
            'users' => Ibu::all(),
            'anaks' => $anaks,
            'pemeriksaan' => $pemeriksaan,
            'id_ibu' => Auth::user()->role === 'user' ? $ibu->id_ibu : null
        ]);
    }

    protected function hitungStatusGizi($currentData, $previousData)
    {
        $baselineZScore = ((float)$previousData->berat_badan + (float)$previousData->tinggi_badan) / 2;
        $currentZScore = ((float)$currentData->berat_badan + (float)$currentData->tinggi_badan) / 2;
        $difference = $currentZScore - $baselineZScore;

        if ($difference < -3) {
            return 'Gizi Buruk (Severely Wasted)';
        } elseif ($difference >= -3 && $difference < -2) {
            return 'Kurang Gizi (Wasted)';
        } elseif ($difference >= -2 && $difference <= 1) {
            return 'Gizi Normal (Normal)';
        } elseif ($difference > 1 && $difference <= 2) {
            return 'Berisiko Obesitas (At Risk of Overweight)';
        } elseif ($difference > 2) {
            return 'Obesitas';
        }

        return 'Tidak Diketahui';
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
    public function destroy($id)
    {
        try {
            // Temukan data perkembangan anak berdasarkan ID
            $perkembanganAnak = PerkembanganAnak::findOrFail($id);

            // Hapus data perkembangan anak
            $perkembanganAnak->delete();

            // Redirect dengan notifikasi toast sukses
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Data perkembangan anak berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect kembali dengan notifikasi toast error
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data perkembangan anak!'
            ]);
        }
    }
}
