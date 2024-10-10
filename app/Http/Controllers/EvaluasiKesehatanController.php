<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use Illuminate\Http\Request;
use App\Models\StatusImunisasi;
use App\Models\KondisiKesehatan;
use App\Models\RiwayatKehamilan;
use App\Models\RiwayatKesehatan;
use App\Models\EvaluasiKesehatan;
use App\Models\PemeriksaanKhusus;
use App\Models\RiwayatPenyakitKeluarga;
use App\Models\RiwayatPerilakuBeresiko;

class EvaluasiKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'dashboard.evaluasi_kesehatan',
            [
                'ibu' => Ibu::all(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_ibu' => 'required|exists:ibu,id_ibu',
            'tanggal' => 'required|date',
            'tb' => 'required|string',
            'berat_badan' => 'required|string',
            'lila' => 'required|string',
            'imt' => 'required|in:kurus,normal,obesitas',
            // Validation rules for health history
            'jantung' => 'boolean',
            'hipertensi' => 'boolean',
            'tyroid' => 'boolean',
            'alergi' => 'boolean',
            'autoimun' => 'boolean',
            'asma' => 'boolean',
            'tb' => 'boolean',
            'hepasitis_b' => 'boolean',
            'jiwa' => 'boolean',
            'sifilis' => 'boolean',
            'diabetes' => 'boolean',
            'lainnya' => 'nullable|string',
            // Validation rules for immunization status
            '1_bulan' => 'boolean',
            '6_bulan' => 'boolean',
            '12_bulan10' => 'boolean',
            '12_bulan25' => 'boolean',
            // Validation rules for risk behaviors
            'merokok' => 'boolean',
            'pola_makan_beresiko' => 'boolean',
            'alkohol' => 'boolean',
            'obat-obatan' => 'boolean',
            'kosmetik' => 'boolean',
            'lainnya_perilaku' => 'nullable|string',
            // Validation rules for pregnancy history
            'tahun' => 'nullable|integer',
            'berat_lahir' => 'nullable|integer',
            'persalinan' => 'nullable|string',
            'penolong_persalinan' => 'nullable|string',
            'komplikasi' => 'nullable|string',
            // Validation rules for family disease history
            'hipertensi' => 'boolean',
            'diabetes' => 'boolean',
            'sesak_nafas' => 'boolean',
            'jantung' => 'boolean',
            'tb' => 'boolean',
            'alergi' => 'boolean',
            'jiwa' => 'boolean',
            'kelainan_darah' => 'boolean',
            'hepasitis_b' => 'boolean',
            'lainnya_penyakit' => 'nullable|string',
            // Validation rules for special examinations
            'vulva' => 'required|in:normal,tidak_normal',
            'uretra' => 'required|in:normal,tidak_normal',
            'vagina' => 'required|in:normal,tidak_normal',
            'porsio' => 'required|in:normal,tidak_normal',
        ]);

        // Store the health condition data
        $kondisiKesehatan = KondisiKesehatan::create([
            'id_ibu' => $validatedData['id_ibu'],
            'tanggal' => $validatedData['tanggal'],
            'tb' => $validatedData['tb'],
            'bb' => $validatedData['berat_badan'],
            'lila' => $validatedData['lila'],
            'imt' => $validatedData['imt'],
        ]);

        // Store the health history data
        $riwayatKesehatan = RiwayatKesehatan::create([
            'id_ibu' => $validatedData['id_ibu'],
            'jantung' => $validatedData['jantung'],
            'hipertensi' => $validatedData['hipertensi'],
            'tyroid' => $validatedData['tyroid'],
            'alergi' => $validatedData['alergi'],
            'autoimun' => $validatedData['autoimun'],
            'asma' => $validatedData['asma'],
            'tb' => $validatedData['tb'],
            'hepasitis_b' => $validatedData['hepasitis_b'],
            'jiwa' => $validatedData['jiwa'],
            'sifilis' => $validatedData['sifilis'],
            'diabetes' => $validatedData['diabetes'],
            'lainnya' => $validatedData['lainnya'],
        ]);

        // Store the immunization status data
        $statusImunisasi = StatusImunisasi::create([
            'id_ibu' => $validatedData['id_ibu'],
            '1_bulan' => $validatedData['1_bulan'],
            '6_bulan' => $validatedData['6_bulan'],
            '12_bulan10' => $validatedData['12_bulan10'],
            '12_bulan25' => $validatedData['12_bulan25'],
        ]);

        // Store the risk behavior history data
        $riwayatPerilakuBeresiko = RiwayatPerilakuBeresiko::create([
            'id_ibu' => $validatedData['id_ibu'],
            'merokok' => $validatedData['merokok'],
            'pola_makan_beresiko' => $validatedData['pola_makan_beresiko'],
            'alkohol' => $validatedData['alkohol'],
            'obat-obatan' => $validatedData['obat-obatan'],
            'kosmetik' => $validatedData['kosmetik'],
            'lainnya' => $validatedData['lainnya_perilaku'],
        ]);

        // Store the pregnancy history data
        $riwayatKehamilan = RiwayatKehamilan::create([
            'id_ibu' => $validatedData['id_ibu'],
            'tahun' => $validatedData['tahun'],
            'berat_lahir' => $validatedData['berat_lahir'],
            'persalinan' => $validatedData['persalinan'] ?? '-',
            'penolong_persalinan' => $validatedData['penolong_persalinan'] ?? '-',
            'komplikasi' => $validatedData['komplikasi'] ?? '-',
        ]);

        // Store the family disease history data
        $riwayatPenyakitKeluarga = RiwayatPenyakitKeluarga::create([
            'id_ibu' => $validatedData['id_ibu'],
            'hipertensi' => $validatedData['hipertensi'],
            'diabetes' => $validatedData['diabetes'],
            'sesak_nafas' => $validatedData['sesak_nafas'],
            'jantung' => $validatedData['jantung'],
            'tb' => $validatedData['tb'],
            'alergi' => $validatedData['alergi'],
            'jiwa' => $validatedData['jiwa'],
            'kelainan_darah' => $validatedData['kelainan_darah'],
            'hepasitis_b' => $validatedData['hepasitis_b'],
            'lainnya' => $validatedData['lainnya_penyakit'],
        ]);

        // Store the special examination data
        $pemeriksaanKhusus = PemeriksaanKhusus::create([
            'id_ibu' => $validatedData['id_ibu'],
            'vulva' => $validatedData['vulva'],
            'uretra' => $validatedData['uretra'],
            'vagina' => $validatedData['vagina'],
            'porsio' => $validatedData['porsio'],
        ]);

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Evaluasi Kesehatan berhasil!'
            ]
        );
    }


    /**
     * Display the specified resource.
     */
    public function show($id_ibu)
    {
        $ibu = Ibu::where('id_ibu', $id_ibu)->firstOrFail();

        $kondisiKesehatan = KondisiKesehatan::where('id_ibu', $id_ibu)->firstOrFail();

        $riwayatKesehatan = RiwayatKesehatan::where('id_ibu', $id_ibu)->firstOrFail();
        $statusImunisasi = StatusImunisasi::where('id_ibu', $id_ibu)->firstOrFail();
        $riwayatPerilakuBeresiko = RiwayatPerilakuBeresiko::where('id_ibu', $id_ibu)->firstOrFail();
        $riwayatKehamilan = RiwayatKehamilan::where('id_ibu', $id_ibu)->firstOrFail();
        $riwayatPenyakitKeluarga = RiwayatPenyakitKeluarga::where('id_ibu', $id_ibu)->firstOrFail();
        $pemeriksaanKhusus = PemeriksaanKhusus::where('id_ibu', $id_ibu)->firstOrFail();

        return view('dashboard.detail_evaluasi_kesehatan', [
            'ibu' => $ibu,
            'kondisiKesehatan' => $kondisiKesehatan,
            'riwayatKesehatan' => $riwayatKesehatan,
            'statusImunisasi' => $statusImunisasi,
            'riwayatPerilakuBeresiko' => $riwayatPerilakuBeresiko,
            'riwayatKehamilan' => $riwayatKehamilan,
            'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
            'pemeriksaanKhusus' => $pemeriksaanKhusus,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvaluasiKesehatan $evaluasiKesehatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluasiKesehatan $evaluasiKesehatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_ibu)
    {
        PemeriksaanKhusus::where('id_ibu', $id_ibu)->delete();

        RiwayatPenyakitKeluarga::where('id_ibu', $id_ibu)->delete();

        RiwayatKehamilan::where('id_ibu', $id_ibu)->delete();

        RiwayatPerilakuBeresiko::where('id_ibu', $id_ibu)->delete();

        StatusImunisasi::where('id_ibu', $id_ibu)->delete();

        RiwayatKesehatan::where('id_ibu', $id_ibu)->delete();

        KondisiKesehatan::where('id_ibu', $id_ibu)->delete();

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Data Evaluasi Kesehatan berhasil dihapus!'
            ]
        );
    }
}
