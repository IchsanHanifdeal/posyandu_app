<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporan';
    protected $fillable = [
        'id_posyandu',
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
        'jumlah_kunjungan_rumah',
    ];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id_posyandu');
    }
}
