<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amanat extends Model
{
    use HasFactory;

    protected $table = 'amanat';
    protected $primaryKey = 'id_amanat';
    protected $fillable = [
        'id_ibu',
        'bulan',
        'tahun',
        'dokter_1',
        'dokter_2',
        'dana_persalinan',
        'kendaraan_1',
        'hp_kendaraan_1',
        'kendaraan_2',
        'hp_kendaraan_2',
        'kendaraan_3',
        'hp_kendaraan_3',
        'metode_persalinan',
        'golongan_darah',
        'rhesus',
        'bantuan_1',
        'hp_bantuan_1',
        'bantuan_2',
        'hp_bantuan_2',
        'bantuan_3',
        'hp_bantuan_3',
        'bantuan_4',
        'hp_bantuan_4',
        'persetujuan_pendamping',
        'persetujuan_ibu',
        'persetujuan_dokter',
    ];
}
