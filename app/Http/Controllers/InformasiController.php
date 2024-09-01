<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function InformasiIbuHamil()
    {
        return view('dashboard.informasi_ibu');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function InformasiIbuBersalin()
    {
        return view('dashboard.informasi_bersalin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function kelasIbuHamil(Request $request)
    {
        return view('dashboard.kelas_ibu');
    }

    /**
     * Display the specified resource.
     */
    public function keluargaBerencana()
    {
        return view('dashboard.keluarga_berencana');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function ibuNifas()
    {
        return view('dashboard.informasi_ibu_nifas');
    }

    /**
     * Update the specified resource in storage.
     */
    public function ibuMenyusui()
    {
        return view('dashboard.informasi_ibu_menyusui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
