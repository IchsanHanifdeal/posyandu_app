<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\Amanat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class AmanatPersalinanController extends Controller
{
    public function index()
    {
        return view('dashboard.amanat_persalinan', [
            'ibu' => Ibu::all(),
            'amanat' => Amanat::all(),
        ]);
    }

    public function downloadPdf()
    {
        $pdf = PDF::loadView('components.amanat_persalinan.amanat_persalinan');

        return $pdf->download('amanat_persalinan.pdf');
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'id_ibu' => 'required|exists:ibu,id_ibu',
            'bulan' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'dokter_1' => 'required|string|max:255',
            'dokter_2' => 'nullable|string|max:255',
            'dana_persalinan' => 'required|string|max:255',
            'metode_persalinan' => 'required|string|max:255',
            'golongan_darah' => 'required|string|max:255',
            'rhesus' => 'required|string|max:255',
            'kendaraan_1' => 'required|string|max:255',
            'hp_kendaraan_1' => 'required|string|max:15',
            'kendaraan_2' => 'nullable|string|max:255',
            'hp_kendaraan_2' => 'nullable|string|max:15',
            'kendaraan_3' => 'nullable|string|max:255',
            'hp_kendaraan_3' => 'nullable|string|max:15',
            'bantuan_1' => 'nullable|string|max:255',
            'hp_bantuan_1' => 'nullable|string|max:15',
            'bantuan_2' => 'nullable|string|max:255',
            'hp_bantuan_2' => 'nullable|string|max:15',
            'bantuan_3' => 'nullable|string|max:255',
            'hp_bantuan_3' => 'nullable|string|max:15',
            'bantuan_4' => 'nullable|string|max:255',
            'hp_bantuan_4' => 'nullable|string|max:15',
            'persetujuan_pendamping' => 'nullable|string|max:255',
            'persetujuan_ibu' => 'nullable|string|max:255',
            'persetujuan_dokter' => 'nullable|string|max:255',
        ]);

        // Create a new Amanat entry
        Amanat::create($validated);

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Data Posyandu berhasil diperbarui!'
            ]
        );
    }
}
