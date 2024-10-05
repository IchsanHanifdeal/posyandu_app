<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasAnak extends Model
{
    use HasFactory;
    protected $table = "identitas_anak";
    protected $primaryKey = "id_anak";
    protected $fillable = [
        'id_ibu',
        'no_surat',
        'hari',
        'tanggal',
        'pukul',
        'jenis_kelamin',
        'jenis_kelahiran',
        'kelahiran_ke',
        'berat',
        'panjang',
        'tempat_kelahiran',
        'nama',
        'ttd_saksi1',
        'nama_saksi1',
        'ttd_saksi2',
        'nama_saksi2',
        'ttd_penolong_persalinan',
        'nama_penolong_persalinan',
    ];

    public function ibu()
    {
        return $this->belongsTo(Ibu::class, 'id_ibu', 'id_ibu');
    }
}
