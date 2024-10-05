<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentitasIbuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'user') {
            $ibu = Auth::user()->ibu;
    
            $ibu_terbaru = $ibu ? $ibu->user->nama : '-';
            $jumlah_ibu = $ibu ? 1 : 0; // Only one ibu if the user has a related Ibu
    
            return view('dashboard.identitas_ibu', [
                'ibu' => collect([$ibu]), // Wrap single Ibu in a collection
                'jumlah_ibu' => $jumlah_ibu,
                'ibu_terbaru' => $ibu_terbaru,
            ]);
        }
    
        $ibu_terbaru = Ibu::latest()->first()->user->nama ?? '-';
        $jumlah_ibu = Ibu::count();
    
        return view('dashboard.identitas_ibu', [
            'ibu' => Ibu::all(),
            'jumlah_ibu' => $jumlah_ibu,
            'ibu_terbaru' => $ibu_terbaru,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
