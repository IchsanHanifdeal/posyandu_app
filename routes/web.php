<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PosyanduController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth.login');
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register/post', [AuthController::class, 'post'])->name('post.register');

Route::middleware(['auth'])->group(function () {
    // Route for Dashboard
    // Routes for GENERAL
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/posyandu', [PosyanduController::class, 'index'])->name('posyandu');
    Route::post('/dashboard/posyandu/post', [PosyanduController::class, 'store'])->name('store.posyandu');
    Route::put('/dashboard/posyandu/{id_posyandu}/update', [PosyanduController::class, 'update'])->name('update.posyandu');
    Route::delete('/dashboard/posyandu/{id_posyandu}/hapus', [PosyanduController::class, 'destroy'])->name('delete.posyandu');
    Route::get('/dashboard/pengguna', [PenggunaController::class, 'index'])->name('pengguna');

    // Routes for CATATAN IBU
    Route::get('/dashboard/identitas_ibu_hamil', [AuthController::class, 'identitasIbuHamil'])->name('identitas_ibu_hamil');
    Route::get('/dashboard/pernyataan_pelayanan', [AuthController::class, 'pernyataanPelayanan'])->name('pernyataan_pelayanan');
    Route::get('/dashboard/amanat_persalinan', [AuthController::class, 'amanatPersalinan'])->name('amanat_persalinan');
    Route::get('/dashboard/pelayanan_dokter', [AuthController::class, 'pelayananDokter'])->name('pelayanan_dokter');
    Route::get('/dashboard/pelayanan_kehamilan', [AuthController::class, 'pelayananKehamilan'])->name('pelayanan_kehamilan');
    Route::get('/dashboard/pelayanan_nifas', [AuthController::class, 'pelayananNifas'])->name('pelayanan_nifas');
    Route::get('/dashboard/rujukan', [AuthController::class, 'rujukan'])->name('rujukan');

    // Routes for INFORMASI IBU
    Route::get('/dashboard/ibu_hamil', [AuthController::class, 'ibuHamil'])->name('ibu_hamil');
    Route::get('/dashboard/ibu_bersalin', [AuthController::class, 'ibuBersalin'])->name('ibu_bersalin');
    Route::get('/dashboard/ibu_nifas', [AuthController::class, 'ibuNifas'])->name('ibu_nifas');
    Route::get('/dashboard/ibu_menyusui', [AuthController::class, 'ibuMenyusui'])->name('ibu_menyusui');
    Route::get('/dashboard/keluarga_berencana', [AuthController::class, 'keluargaBerencana'])->name('keluarga_berencana');
    Route::get('/dashboard/kelas_ibu_hamil', [AuthController::class, 'kelasIbuHamil'])->name('kelas_ibu_hamil');

    // Routes for CATATAN ANAK
    Route::get('/dashboard/identitas_anak', [AuthController::class, 'identitasAnak'])->name('identitas_anak');
    Route::get('/dashboard/pelayanan_neonatus', [AuthController::class, 'pelayananNeonatus'])->name('pelayanan_neonatus');
    Route::get('/dashboard/sdidtk', [AuthController::class, 'sdidtk'])->name('sdidtk');
    Route::get('/dashboard/kurva_pertumbuhan', [AuthController::class, 'kurvaPertumbuhan'])->name('kurva_pertumbuhan');
    Route::get('/dashboard/imunisasi', [AuthController::class, 'imunisasi'])->name('imunisasi');
    Route::get('/dashboard/pmba', [AuthController::class, 'pmba'])->name('pmba');
    Route::get('/dashboard/vit_a', [AuthController::class, 'vitA'])->name('vit_a');
    Route::get('/dashboard/obat_cacing', [AuthController::class, 'obatCacing'])->name('obat_cacing');
    Route::get('/dashboard/ringkasan_pelayanan_mtbs', [AuthController::class, 'ringkasanPelayananMtbs'])->name('ringkasan_pelayanan_mtbs');
    Route::get('/dashboard/rujukan_anak', [AuthController::class, 'rujukanAnak'])->name('rujukan_anak');

    // Routes for INFORMASI ANAK
    Route::get('/dashboard/bayi_baru_lahir', [AuthController::class, 'bayiBaruLahir'])->name('bayi_baru_lahir');
    Route::get('/dashboard/kondisi_balita', [AuthController::class, 'kondisiBalita'])->name('kondisi_balita');
    Route::get('/dashboard/bayi_anak_balita_6_24_bulan', [AuthController::class, 'bayiAnakBalita624Bulan'])->name('bayi_anak_balita_6_24_bulan');
    Route::get('/dashboard/anak_balita_2_3_tahun', [AuthController::class, 'anakBalita23Tahun'])->name('anak_balita_2_3_tahun');
    Route::get('/dashboard/anak_balita_3_4_tahun', [AuthController::class, 'anakBalita34Tahun'])->name('anak_balita_3_4_tahun');
    Route::get('/dashboard/anak_balita_4_5_tahun', [AuthController::class, 'anakBalita45Tahun'])->name('anak_balita_4_5_tahun');
    Route::get('/dashboard/anak_5_6_tahun', [AuthController::class, 'anak56Tahun'])->name('anak_5_6_tahun');
    Route::get('/dashboard/kelas_ibu_balita', [AuthController::class, 'kelasIbuBalita'])->name('kelas_ibu_balita');

    // Route for Profile
    Route::get('/dashboard/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/dashboard/logout', [AuthController::class, 'logout'])->name('logout');
});
