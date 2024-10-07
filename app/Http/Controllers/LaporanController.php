<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\PengurusPosyandu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch laporan data and include nama_posyandu by joining with both posyandu and pengurus_posyandu tables
        $laporan = DB::table('laporan')
            ->join('pengurus_posyandu', 'laporan.id_posyandu', '=', 'pengurus_posyandu.id_posyandu')
            ->join('posyandu', 'laporan.id_posyandu', '=', 'posyandu.id_posyandu') // Join to get nama_posyandu
            ->where('pengurus_posyandu.id_user', $user->id_user)
            ->select('laporan.*', 'posyandu.nama_posyandu') // Select laporan fields and nama_posyandu
            ->get();

        // dd($laporan);
        // Return view with laporan data
        return view('dashboard.laporan', [
            'laporan' => $laporan,
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
        $request->validate([
            'sasaran_balita_perbulan' => 'required|string',
            'sasaran_ds_perbulan' => 'required|string',
            'sasaran_ibu_hamil' => 'required|string',
            'ibu_hamil_yang_dapat_pelayanan' => 'required|string',
            'sasaran_remaja' => 'required|string',
            'remaja_yang_dapat_pelayanan_kesehatan' => 'required|string',
            'sasaran_usia_produktif' => 'required|string',
            'usia_produktif_yang_dapat_pelayanan_kesehatan' => 'required|string',
            'sasaran_lansia' => 'required|string',
            'lansia_yang_dapat_pelayanan_kesehatan' => 'required|string',
            'jumlah_bayi_yang_di_imunisasi' => 'required|integer',
            'jumlah_kunjungan_rumah' => 'required|integer',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Get the authenticated user
            $user = Auth::user();

            // Get the user's associated id_posyandu
            $pengurusPosyandu = DB::table('pengurus_posyandu')
                ->where('id_user', $user->id_user)
                ->first();

            if (!$pengurusPosyandu) {
                return redirect()->back()->withErrors(['error' => 'User not associated with any posyandu']);
            }

            // Create the new laporan
            $laporan = new Laporan();
            $laporan->id_posyandu = $pengurusPosyandu->id_posyandu; // Set id_posyandu from pengurus_posyandu
            $laporan->sasaran_balita_perbulan = $request->sasaran_balita_perbulan;
            $laporan->sasaran_ds_perbulan = $request->sasaran_ds_perbulan;
            $laporan->sasaran_ibu_hamil = $request->sasaran_ibu_hamil;
            $laporan->ibu_hamil_yang_dapat_pelayanan = $request->ibu_hamil_yang_dapat_pelayanan;
            $laporan->sasaran_remaja = $request->sasaran_remaja;
            $laporan->remaja_yang_dapat_pelayanan_kesehatan = $request->remaja_yang_dapat_pelayanan_kesehatan;
            $laporan->sasaran_usia_produktif = $request->sasaran_usia_produktif;
            $laporan->usia_produktif_yang_dapat_pelayanan_kesehatan = $request->usia_produktif_yang_dapat_pelayanan_kesehatan;
            $laporan->sasaran_lansia = $request->sasaran_lansia;
            $laporan->lansia_yang_dapat_pelayanan_kesehatan = $request->lansia_yang_dapat_pelayanan_kesehatan;
            $laporan->jumlah_bayi_yang_di_imunisasi = $request->jumlah_bayi_yang_di_imunisasi;
            $laporan->jumlah_kunjungan_rumah = $request->jumlah_kunjungan_rumah;

            // Save the laporan to the database
            $laporan->save();

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Data imunisasi berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback the transaction if there is an error

            // Log the error for debugging
            Log::error('Error saving laporan: ' . $e->getMessage());

            // Return with an error message
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Begin a transaction
        DB::beginTransaction();

        try {
            // Find the laporan by ID
            $laporan = Laporan::findOrFail($id);

            // Ensure the authenticated user is authorized to delete this laporan
            // Optional: Add your authorization logic here if needed

            // Delete the laporan
            $laporan->delete();

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Laporan berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if there is an error
            DB::rollBack();

            // Optionally log the error for debugging
            // Log::error($e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus laporan!',
            ]);
        }
    }
}
