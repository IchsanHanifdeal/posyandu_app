<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class AmanatPersalinanController extends Controller
{
    public function index() {
        return view('dashboard.amanat_persalinan', [
            'ibu' => Ibu::all(),
        ]);
    }

    public function downloadPdf()
    {
        $pdf = PDF::loadView('components.amanat_persalinan.amanat_persalinan');
        
        return $pdf->download('amanat_persalinan.pdf');
    }
}
