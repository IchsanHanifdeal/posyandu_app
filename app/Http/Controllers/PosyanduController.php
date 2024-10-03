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
        $validatedData = $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'pengurus' => 'array'
        ]);

        $posyandu = Posyandu::create($validatedData);

        if ($request->has('pengurus')) {
            $posyandu->users()->attach($request->pengurus);
        }

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Posyandu berhasil didaftarkan!'
            ]
        );
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
    public function update(Request $request, Posyandu $id_posyandu)
    {
        $validatedData = $request->validate([
            'nama_posyandu' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'pengurus' => 'array',
        ]);

        // Update data posyandu
        $id_posyandu->update($validatedData);

        // Sync pengurus (update hubungan many-to-many)
        if ($request->has('pengurus')) {
            $id_posyandu->users()->sync($request->pengurus);
        }

        // Redirect kembali dengan toast notification
        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Data Posyandu berhasil diperbarui!'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posyandu $id_posyandu)
    {
        $id_posyandu->delete();

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Posyandu berhasil dihapus!'
            ]
        );
    }
}
