<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('dashboard.profile', [
            'last_login' => $request->session()->get('login_time')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function password(Request $request, $id_user)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required|string',
            'password_baru' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->input('password_lama'), $user->password)) {
            return redirect()->back()->withErrors(['password_lama' => 'Password lama tidak sesuai']);
        }

        // Update password baru
        $user->password = Hash::make($request->input('password_baru'));
        $user->save();

        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Profil berhasil di perbarui!'
            ]
        );
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
    public function update(Request $request, $id_user)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Dapatkan user yang sedang login
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'User tidak ditemukan']);
        }

        // Simpan perubahan
        $user->nama = $request->input('nama');
        $user->no_hp = $request->input('no_hp');
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Profil berhasil di perbarui!'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
