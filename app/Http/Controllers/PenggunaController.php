<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = User::all();

        $pengguna_terbaru = User::latest()->first()->nama;

        $jumlah_pengguna = User::count();

        return view('dashboard.pengguna', [
            'pengguna' => $pengguna,
            'pengguna_terbaru' => $pengguna_terbaru,
            'jumlah_pengguna' => $jumlah_pengguna,
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_handphone' => 'required|numeric',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_handphone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Pengguna berhasil ditambahkan!'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function update_photo(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_profil', 'public');

            // Hapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::disk('public')->delete('foto_profil/' . $user->foto_profil);
            }

            $user->update(['foto_profil' => basename($path)]);
        }

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Foto profil berhasil diperbarui!'
            ]
        );
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
    public function destroy(string $id_user)
    {
        $user = User::findOrFail($id_user);

        // Hapus foto profil jika ada
        if ($user->foto_profil) {
            Storage::disk('public')->delete('foto_profil/' . $user->foto_profil);
        }

        $user->delete();

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Pengguna berhasil dihapus!'
            ]
        );
    }
}
