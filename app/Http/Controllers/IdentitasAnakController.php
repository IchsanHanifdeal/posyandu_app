<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\IdentitasAnak;
use Illuminate\Support\Facades\Validator;

class IdentitasAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anak_terbaru = IdentitasAnak::latest()->first()->nama ?? '-';

        $jumlah_anak = IdentitasAnak::count();

        return view('dashboard.identitas_anak', [
            'anak' => IdentitasAnak::all(),
            'Anak_baru_lahir' => $anak_terbaru,
            'jumlah_anak_terdaftar' => $jumlah_anak,
            'users' => Ibu::all(),
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
        // Validasi input sesuai dengan fillable dari model
        $validator = Validator::make($request->all(), [
            'id_ibu' => 'required', // pastikan id_ibu ada di tabel users
            'no_surat' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pukul' => 'required|date_format:H:i',
            'jenis_kelamin' => 'required|string',
            'jenis_kelahiran' => 'required|string',
            'kelahiran_ke' => 'required|string|max:255',
            'berat' => 'required|numeric',
            'panjang' => 'required|numeric',
            'tempat_kelahiran' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'nama_saksi1' => 'required|string|max:255',
            'nama_saksi2' => 'required|string|max:255',
            'nama_penolong_persalinan' => 'required|string|max:255',
            'ttd_saksi1' => 'nullable|string|max:255',
            'ttd_saksi2' => 'nullable|string|max:255',
            'ttd_penolong_persalinan' => 'nullable|string|max:255',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke dalam tabel IdentitasAnak
        try {
            IdentitasAnak::create([
                'id_ibu' => $request->input('id_ibu'),
                'no_surat' => $request->input('no_surat'),
                'hari' => $request->input('hari'),
                'tanggal' => $request->input('tanggal'),
                'pukul' => $request->input('pukul'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'jenis_kelahiran' => $request->input('jenis_kelahiran'),
                'kelahiran_ke' => $request->input('kelahiran_ke'),
                'berat' => $request->input('berat'),
                'panjang' => $request->input('panjang'),
                'tempat_kelahiran' => $request->input('tempat_kelahiran'),
                'nama' => $request->input('nama'),
                'ttd_saksi1' => $request->input('ttd_saksi1'),
                'nama_saksi1' => $request->input('nama_saksi1'),
                'ttd_saksi2' => $request->input('ttd_saksi2'),
                'nama_saksi2' => $request->input('nama_saksi2'),
                'ttd_penolong_persalinan' => $request->input('ttd_penolong_persalinan'),
                'nama_penolong_persalinan' => $request->input('nama_penolong_persalinan'),
            ]);

            // Redirect dengan toast sukses
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Data Anak berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(IdentitasAnak $identitasAnak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IdentitasAnak $identitasAnak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IdentitasAnak $identitasAnak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_anak)
    {
        try {
            $anak = IdentitasAnak::findOrFail($id_anak);

            $anak->delete();

            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Data Anak berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data anak!'
            ]);
        }
    }
}
