<?php

use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SkriningPreeklampsia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\RujukanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\TrimesterController;
use App\Http\Controllers\IdentitasIbuController;
use App\Http\Controllers\IdentitasAnakController;
use App\Http\Controllers\PelayananNifasController;
use App\Http\Controllers\AmanatPersalinanController;
use App\Http\Controllers\PerkembanganAnakController;
use App\Http\Controllers\EvaluasiKesehatanController;
use App\Http\Controllers\PernyataanPelayananController;
use App\Http\Controllers\SkriningPreeklampsiaController;

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

Route::get('/', function (Request $request) {

    $posyanduList = Posyandu::with('laporan')->get();

    // Daftar item yang ingin ditampilkan
    $summaryItems = [
        'sasaran_balita_perbulan',
        'sasaran_ds_perbulan',
        'sasaran_ibu_hamil',
        'ibu_hamil_yang_dapat_pelayanan',
        'sasaran_remaja',
        'remaja_yang_dapat_pelayanan_kesehatan',
        'sasaran_usia_produktif',
        'usia_produktif_yang_dapat_pelayanan_kesehatan',
        'sasaran_lansia',
        'lansia_yang_dapat_pelayanan_kesehatan',
        'jumlah_bayi_yang_di_imunisasi',
        'jumlah_kunjungan_rumah'
    ];


    return view('home.index', compact('posyanduList', 'summaryItems'));
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth.login');
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register/post', [AuthController::class, 'store'])->name('post.register');

Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', function () {
        $user = Auth::user();
        $ibu = DB::table('ibu')->where('id_user', $user->id_user)->first();

        if ($user->role == 'user' && $ibu) {
            $anak = DB::table('identitas_anak')->where('id_ibu', $ibu->id_ibu)->first();

            if ($anak) {
                $perkembangan = DB::table('perkembangan_anak')
                    ->where('id_anak', $anak->id_anak)
                    ->orderBy('pemeriksaan', 'desc')
                    ->get();

                $perkembanganTinggiBadan = $perkembangan->pluck('tinggi_badan')->toArray();
                $perkembanganBeratBadan = $perkembangan->pluck('berat_badan')->toArray();
                $tanggalpemeriksaan = $perkembangan->pluck('pemeriksaan')->toArray();

                $latestPerkembangan = $perkembangan->first();
                $latestTinggiBadan = $latestPerkembangan ? $latestPerkembangan->tinggi_badan : null;
                $latestBeratBadan = $latestPerkembangan ? $latestPerkembangan->berat_badan : null;
            } else {
                $perkembanganTinggiBadan = [];
                $perkembanganBeratBadan = [];
                $latestTinggiBadan = null;
                $latestBeratBadan = null;
            }

            return view('dashboard.index', [
                'nama_anak' => $anak->nama ?? null,
                'tinggi_badan' => $latestTinggiBadan,
                'berat_badan' => $latestBeratBadan,
                'perkembanganTinggiBadan' => $perkembanganTinggiBadan,
                'perkembanganBeratBadan' => $perkembanganBeratBadan,
                'tanggalpemeriksaan' => $tanggalpemeriksaan,
            ]);
        } elseif ($user->role == 'admin') {
            $idPosyanduAdmin = DB::table('pengurus_posyandu')
                ->where('id_user', $user->id_user)
                ->pluck('id_posyandu')
                ->toArray();

            $averageData = DB::table('laporan')
                ->whereIn('id_posyandu', $idPosyanduAdmin)
                ->select(
                    DB::raw('SUM(sasaran_balita_perbulan) as sasaran_balita_perbulan'),
                    DB::raw('SUM(sasaran_ds_perbulan) as sasaran_D_s_perbulan'),
                    DB::raw('SUM(sasaran_ibu_hamil) as sasaran_ibu_hamil'),
                    DB::raw('SUM(ibu_hamil_yang_dapat_pelayanan) as ibu_hamil_yang_dapat_pelayanan'),
                    DB::raw('SUM(sasaran_remaja) as sasaran_remaja'),
                    DB::raw('SUM(remaja_yang_dapat_pelayanan_kesehatan) as remaja_yang_dapat_pelayanan_kesehatan'),
                    DB::raw('SUM(sasaran_usia_produktif) as sasaran_usia_produktif'),
                    DB::raw('SUM(usia_produktif_yang_dapat_pelayanan_kesehatan) as usia_produktif_yang_dapat_pelayanan_kesehatan'),
                    DB::raw('SUM(sasaran_lansia) as sasaran_lansia'),
                    DB::raw('SUM(lansia_yang_dapat_pelayanan_kesehatan) as lansia_yang_dapat_pelayanan_kesehatan'),
                    DB::raw('SUM(jumlah_bayi_yang_di_imunisasi) as jumlah_bayi_yang_di_imunisasi'),
                    DB::raw('SUM(jumlah_kunjungan_rumah) as jumlah_kunjungan_rumah')
                )
                ->first();

            $monthlyData = DB::table('laporan')
                ->whereIn('id_posyandu', $idPosyanduAdmin)
                ->select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('SUM(sasaran_balita_perbulan) as sasaran_balita_perbulan'),
                    DB::raw('SUM(sasaran_ds_perbulan) as sasaran_D_s_perbulan'),
                    DB::raw('SUM(sasaran_ibu_hamil) as sasaran_ibu_hamil'),
                    DB::raw('SUM(ibu_hamil_yang_dapat_pelayanan) as ibu_hamil_yang_dapat_pelayanan'),
                    DB::raw('SUM(sasaran_remaja) as sasaran_remaja'),
                    DB::raw('SUM(remaja_yang_dapat_pelayanan_kesehatan) as remaja_yang_dapat_pelayanan_kesehatan'),
                    DB::raw('SUM(sasaran_usia_produktif) as sasaran_usia_produktif'),
                    DB::raw('SUM(usia_produktif_yang_dapat_pelayanan_kesehatan) as usia_produktif_yang_dapat_pelayanan_kesehatan'),
                    DB::raw('SUM(sasaran_lansia) as sasaran_lansia'),
                    DB::raw('SUM(lansia_yang_dapat_pelayanan_kesehatan) as lansia_yang_dapat_pelayanan_kesehatan'),
                    DB::raw('SUM(jumlah_bayi_yang_di_imunisasi) as jumlah_bayi_yang_di_imunisasi'),
                    DB::raw('SUM(jumlah_kunjungan_rumah) as jumlah_kunjungan_rumah')
                )
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $months = [];
            $dataMonthly = [
                'sasaran_balita_perbulan' => [],
                'sasaran_D_s_perbulan' => [],
                'sasaran_ibu_hamil' => [],
                'ibu_hamil_yang_dapat_pelayanan' => [],
                'sasaran_remaja' => [],
                'remaja_yang_dapat_pelayanan_kesehatan' => [],
                'sasaran_usia_produktif' => [],
                'usia_produktif_yang_dapat_pelayanan_kesehatan' => [],
                'sasaran_lansia' => [],
                'lansia_yang_dapat_pelayanan_kesehatan' => [],
                'jumlah_bayi_yang_di_imunisasi' => [],
                'jumlah_kunjungan_rumah' => []
            ];

            foreach ($monthlyData as $data) {
                $months[] = date('F', mktime(0, 0, 0, $data->month, 1));
                foreach ($dataMonthly as $key => &$values) {
                    $values[] = $data->$key;
                }
            }

            return view('dashboard.index', [
                'sasaran_balita_perbulan' => $averageData->sasaran_balita_perbulan,
                'sasaran_D_s_perbulan' => $averageData->sasaran_D_s_perbulan,
                'sasaran_ibu_hamil' => $averageData->sasaran_ibu_hamil,
                'ibu_hamil_yang_dapat_pelayanan' => $averageData->ibu_hamil_yang_dapat_pelayanan,
                'sasaran_remaja' => $averageData->sasaran_remaja,
                'remaja_yang_dapat_pelayanan_kesehatan' => $averageData->remaja_yang_dapat_pelayanan_kesehatan,
                'sasaran_usia_produktif' => $averageData->sasaran_usia_produktif,
                'usia_produktif_yang_dapat_pelayanan_kesehatan' => $averageData->usia_produktif_yang_dapat_pelayanan_kesehatan,
                'sasaran_lansia' => $averageData->sasaran_lansia,
                'lansia_yang_dapat_pelayanan_kesehatan' => $averageData->lansia_yang_dapat_pelayanan_kesehatan,
                'jumlah_bayi_yang_di_imunisasi' => $averageData->jumlah_bayi_yang_di_imunisasi,
                'jumlah_kunjungan_rumah' => $averageData->jumlah_kunjungan_rumah,
                'months' => json_encode($months),
                'dataMonthly' => json_encode($dataMonthly),
            ]);
        } else {
            return view('dashboard.index');
        }
    })->name('dashboard');



    Route::get('/dashboard/posyandu', [PosyanduController::class, 'index'])->name('posyandu');
    Route::post('/dashboard/posyandu/post', [PosyanduController::class, 'store'])->name('store.posyandu');
    Route::put('/dashboard/posyandu/{id_posyandu}/update', [PosyanduController::class, 'update'])->name('update.posyandu');
    Route::delete('/dashboard/posyandu/{id_posyandu}/hapus', [PosyanduController::class, 'destroy'])->name('delete.posyandu');

    Route::get('/dashboard/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::post('/dashboard/pengguna', [PenggunaController::class, 'store'])->name('store.pengguna');
    Route::put('/dashboard/pengguna/{id_user}/update_photo', [PenggunaController::class, 'update_photo'])->name('photo.update');
    Route::delete('/dashboard/pengguna/{id_user}/delete', [PenggunaController::class, 'destroy'])->name('delete.pengguna');

    // Routes for CATATAN IBU
    Route::get('/dashboard/identitas_ibu_hamil', [IdentitasIbuController::class, 'index'])->name('identitas_ibu_hamil');

    Route::get('/dashboard/pernyataan_pelayanan', [PernyataanPelayananController::class, 'index'])->name('pernyataan_pelayanan');

    Route::get('/dashboard/amanat_persalinan', [AmanatPersalinanController::class, 'index'])->name('amanat_persalinan');
    Route::post('/dashboard/amanat_persalinan', [AmanatPersalinanController::class, 'store'])->name('amanat.store');
    Route::put('/dashboard/amanat_persalinan/{id_ibu}', [AmanatPersalinanController::class, 'update'])->name('amanat.update');

    Route::get('/maternity-plan/download', [AmanatPersalinanController::class, 'downloadPdf'])->name('print.amanat_persalinan');

    Route::get('/dashboard/pelayanan_dokter', [AuthController::class, 'pelayananDokter'])->name('pelayanan_dokter');

    Route::get('/dashboard/pelayanan_dokter/evaluasi_kesehatan', [EvaluasiKesehatanController::class, 'index'])->name('evaluasi_kesehatan');
    Route::post('/dashboard/pelayanan_dokter/evaluasi_kesehatan/post', [EvaluasiKesehatanController::class, 'store'])->name('store.evaluasi_kesehatan');
    Route::put('/dashboard/pelayanan_dokter/evaluasi_kesehatan/{id_ibu}/update', [EvaluasiKesehatanController::class, 'update'])->name('update.evaluasi_kesehatan');
    Route::delete('/dashboard/pelayanan_dokter/evaluasi_kesehatan/{id}/delete', [EvaluasiKesehatanController::class, 'destroy'])->name('destroy.evaluasi_kesehatan');
    Route::get('/dashboard/pelayanan_dokter/evaluasi_kesehatan/{id_ibu}/detail_evaluasi', [EvaluasiKesehatanController::class, 'show'])->name('show.evaluasi_kesehatan');

    Route::get('/dashboard/pelayanan_dokter/trimester_1', [TrimesterController::class, 'index'])->name('trimester_1');
    Route::post('/dashboard/pelayanan_dokter/trimester_1/post', [TrimesterController::class, 'store'])->name('store.trimester_1');
    Route::put('/dashboard/pelayanan_dokter/trimester_1/{id}/update', [TrimesterController::class, 'update'])->name('update.trimester_1');
    Route::delete('/dashboard/pelayanan_dokter/trimester_1/{id}/delete', [TrimesterController::class, 'destroy'])->name('destroy.trimester_1');

    Route::get('/dashboard/pelayanan_dokter/trimester_3', [TrimesterController::class, 'index_3'])->name('trimester_3');
    Route::post('/dashboard/pelayanan_dokter/trimester_3/post', [TrimesterController::class, 'store_3'])->name('store.trimester_3');
    Route::put('/dashboard/pelayanan_dokter/trimester_3/{id}/update', [TrimesterController::class, 'update_3'])->name('update.trimester_3');
    Route::delete('/dashboard/pelayanan_dokter/trimester_3/{id}/delete', [TrimesterController::class, 'destroy_3'])->name('destroy.trimester_3');

    Route::get('/dashboard/pelayanan_dokter/skrining_preeklampsia', [SkriningPreeklampsiaController::class, 'index'])->name('skrining_preeklampsia');
    Route::post('/dashboard/pelayanan_dokter/skrining_preeklampsia/post', [SkriningPreeklampsiaController::class, 'store'])->name('store.skrining_preeklampsia');
    Route::put('/dashboard/pelayanan_dokter/skrining_preeklampsia/{id}/update', [SkriningPreeklampsiaController::class, 'update'])->name('update.skrining_preeklampsia');
    Route::delete('/dashboard/pelayanan_dokter/skrining_preeklampsia/{id}/delete', [SkriningPreeklampsiaController::class, 'destroy'])->name('destroy.skrining_preeklampsia');

    // Route::get('/dashboard/pelayanan_kehamilan', [AuthController::class, 'pelayananKehamilan'])->name('pelayanan_kehamilan');

    Route::get('/dashboard/pelayanan_nifas', [AuthController::class, 'pelayananNifas'])->name('pelayanan_nifas');
    Route::post('/dashboard/pelayanan_nifas/store', [PelayananNifasController::class, 'store'])->name('store.pelayanan_nifas');
    Route::put('/dashboard/pelayanan_nifas/{id}/update', [PelayananNifasController::class, 'update'])->name('update.pelayanan_nifas');
    Route::delete('/dashboard/pelayanan_nifas/{id}/destroy', [PelayananNifasController::class, 'destroy'])->name('destroy.pelayanan_nifas');

    Route::get('/dashboard/rujukan', [RujukanController::class, 'index'])->name('rujukan');
    Route::post('/dashboard/rujukan/post', [RujukanController::class, 'store'])->name('store.rujukan');
    Route::put('/dashboard/rujukan/{}/update', [RujukanController::class, 'update'])->name('update.rujukan');
    Route::delete('/dashboard/rujukan/{}/delete', [RujukanController::class, 'destroy'])->name('destroy.rujukan');

    // Routes for INFORMASI IBU
    Route::get('/dashboard/ibu_hamil', [InformasiController::class, 'InformasiIbuHamil'])->name('ibu_hamil');
    Route::get('/dashboard/ibu_bersalin', [InformasiController::class, 'InformasiIbuBersalin'])->name('ibu_bersalin');
    Route::get('/dashboard/ibu_nifas', [InformasiController::class, 'ibuNifas'])->name('ibu_nifas');
    Route::get('/dashboard/ibu_menyusui', [InformasiController::class, 'ibuMenyusui'])->name('ibu_menyusui');
    Route::get('/dashboard/keluarga_berencana', [InformasiController::class, 'keluargaBerencana'])->name('keluarga_berencana');
    Route::get('/dashboard/kelas_ibu_hamil', [InformasiController::class, 'kelasIbuHamil'])->name('kelas_ibu_hamil');

    // Routes for CATATAN ANAK
    Route::get('/dashboard/identitas_anak', [IdentitasAnakController::class, 'index'])->name('identitas_anak');
    Route::post('/dashboard/identitas_anak/post', [IdentitasAnakController::class, 'store'])->name('store.anak');
    Route::put('/dashboard/identitas_anak/{id_anak}/update', [IdentitasAnakController::class, 'update'])->name('update.anak');
    Route::delete('/dashboard/identitas_anak/{id_anak}/delete', [IdentitasAnakController::class, 'destroy'])->name('delete.anak');

    Route::get('/dashboard/perkembangan_anak', [PerkembanganAnakController::class, 'index'])->name('perkembangan_anak');
    Route::post('/dashboard/perkembangan_anak/store', [PerkembanganAnakController::class, 'store'])->name('store.perkembangan');
    Route::delete('/dashboard/perkembangan_anak/{id}/delete', [PerkembanganAnakController::class, 'destroy'])->name('delete.perkembangan');

    // Route::get('/dashboard/pelayanan_neonatus', [AuthController::class, 'pelayananNeonatus'])->name('pelayanan_neonatus');
    // Route::get('/dashboard/sdidtk', [AuthController::class, 'sdidtk'])->name('sdidtk');
    // Route::get('/dashboard/kurva_pertumbuhan', [AuthController::class, 'kurvaPertumbuhan'])->name('kurva_pertumbuhan');

    Route::get('/dashboard/imunisasi', [ImunisasiController::class, 'index'])->name('imunisasi');
    Route::post('/dashboard/imunisasi/store', [ImunisasiController::class, 'store'])->name('store.imunisasi');
    Route::put('/dashboard/imunisasi/{id}/update', [ImunisasiController::class, 'update'])->name('update.imunisasi');
    Route::delete('/dashboard/imunisasi/{id}/delete', [ImunisasiController::class, 'destroy'])->name('destroy.imunisasi');

    Route::get('/dashboard/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::post('/dashboard/laporan/store', [LaporanController::class, 'store'])->name('store.laporan');
    Route::put('/dashboard/laporan/{id}/update', [LaporanController::class, 'update'])->name('update.laporan');
    Route::delete('/dashboard/laporan/{id}/delete', [LaporanController::class, 'destroy'])->name('destroy.laporan');

    // Route::get('/dashboard/pmba', [AuthController::class, 'pmba'])->name('pmba');
    // Route::get('/dashboard/vit_a', [AuthController::class, 'vitA'])->name('vit_a');
    // Route::get('/dashboard/obat_cacing', [AuthController::class, 'obatCacing'])->name('obat_cacing');
    // Route::get('/dashboard/ringkasan_pelayanan_mtbs', [AuthController::class, 'ringkasanPelayananMtbs'])->name('ringkasan_pelayanan_mtbs');
    // Route::get('/dashboard/rujukan_anak', [AuthController::class, 'rujukanAnak'])->name('rujukan_anak');

    // Routes for INFORMASI ANAK
    Route::get('/dashboard/bayi_baru_lahir', [InformasiController::class, 'bayiBaruLahir'])->name('bayi_baru_lahir');
    Route::get('/dashboard/kondisi_balita', [InformasiController::class, 'kondisiBalita'])->name('kondisi_balita');
    Route::get('/dashboard/bayi_anak_balita_6_24_bulan', [InformasiController::class, 'bayiAnakBalita624Bulan'])->name('bayi_anak_balita_6_24_bulan');
    Route::get('/dashboard/anak_balita_2_3_tahun', [InformasiController::class, 'anakBalita23Tahun'])->name('anak_balita_2_3_tahun');
    Route::get('/dashboard/anak_balita_3_4_tahun', [InformasiController::class, 'anakBalita34Tahun'])->name('anak_balita_3_4_tahun');
    Route::get('/dashboard/anak_balita_4_5_tahun', [InformasiController::class, 'anakBalita45Tahun'])->name('anak_balita_4_5_tahun');
    Route::get('/dashboard/anak_5_6_tahun', [InformasiController::class, 'anak56Tahun'])->name('anak_5_6_tahun');
    Route::get('/dashboard/kelas_ibu_balita', [InformasiController::class, 'kelasIbuBalita'])->name('kelas_ibu_balita');

    // Route for Profile
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/dashboard/profile/{id_user}/profile', [ProfileController::class, 'update'])->name('update.profile');
    Route::put('/dashboard/profile/{id_user}/password', [ProfileController::class, 'password'])->name('change_password.profile');

    Route::post('/dashboard/logout', [AuthController::class, 'logout'])->name('logout');
});
