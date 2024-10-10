<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\Imunisasi;
use Illuminate\Http\Request;
use App\Models\IdentitasAnak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'user') {
            $ibu = Auth::user()->ibu;

            if ($ibu) {
                $anak = $ibu->identitas_anak;
            } else {
                $anak = collect(); // Empty collection
            }

            return view('dashboard.imunisasi', [
                'anak' => $anak, // Only display anak related to the user
                'users' => collect([$ibu]), // Single ibu, if available
            ]);
        } else {

            return view('dashboard.imunisasi', [
                'ibu' => Ibu::all(), // Display all anak records
                'anak' => IdentitasAnak::all(), // Display all anak records
                'imunisasianak' => Imunisasi::all(), // Display all anak records
            ]);
        }
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
            'id_ibu' => 'required',  // Ensures the selected ibu exists in the ibu table
            'id_anak' => 'required',  // Ensures the selected anak exists in the anak table
            'jenis_vaksin' => 'required|string',  // The vaccine type is required and must be a string
            'tanggal' => 'required|date',  // The date of the vaccination is required and must be a valid date
        ]);

        // Try to save the immunization data into the database
        try {
            DB::beginTransaction();  // Start transaction

            Imunisasi::create([
                'id_ibu' => $validatedData['id_ibu'],
                'id_anak' => $validatedData['id_anak'],
                'jenis_vaksin' => $validatedData['jenis_vaksin'],
                'tanggal' => $validatedData['tanggal'],
                'no_batch' => $request->input('no_batch'),  // If no_batch is included in the form
            ]);

            DB::commit();  // Commit transaction

            // Redirect back with success message
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Data imunisasi berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();  // Rollback the transaction if there is an error

            // Log the error (optional for debugging)
            // Log::error($e->getMessage());

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
    public function show(Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imunisasi $imunisasi)
    {
        //
    }
}
