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
    public function bayiBaruLahir()
    {
        return view('dashboard.informasi_bayi_baru_lahir');
    }

    public function kondisiBalita()
    {
        return view('dashboard.informasi_kondisi_balita');
    }

    public function bayiAnakBalita624Bulan()
    {
        return view('dashboard.informasi_624bulan');
    }

    public function anakBalita23Tahun()
    {
        return view('dashboard.informasi_23tahun');
    }

    public function anakBalita34Tahun()
    {
        return view('dashboard.informasi_34tahun');
    }

    public function anakBalita45Tahun()
    {
        return view('dashboard.informasi_45tahun');
    }

    public function anak56Tahun()
    {
        return view('dashboard.informasi_informasi56tahun');
    }
}
