<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenyakitKeluarga extends Model
{
    use HasFactory;
    protected $table = "riwayat_penyakit_keluarga";
    protected $primaryKey = "id_riwayatpenyakitkeluarga";
    protected $fillable = ["id_ibu", 'hipertensi', 'diabetes', 'sesak_nafas', 'jantung', 'tb', 'alergi', 'jiwa', 'kelainan_darah', 'hepasitis_b', 'lainnya'];
}
