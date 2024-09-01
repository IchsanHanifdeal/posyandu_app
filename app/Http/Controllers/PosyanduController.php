<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posyandu = Posyandu::with('users')->get();

        $posyandu_terbaru = Posyandu::latest()->first()->nama_posyandu;

        $jumlah_posyandu = Posyandu::count();

        $users = User::where('role', 'admin')->get();

        return view('dashboard.posyandu', [
            'posyandu' => $posyandu,
            'posyandu_terbaru' => $posyandu_terbaru,
            'jumlah_posyandu' => $jumlah_posyandu,
            'users' => $users,
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
    public function show(Posyandu $posyandu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posyandu $posyandu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posyandu $posyandu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posyandu $posyandu)
    {
        //
    }
}
