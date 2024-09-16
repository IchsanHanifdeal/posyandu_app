<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanFisik extends Model
{
    use HasFactory;
    protected $table = "pemeriksaan_fisik";
    protected $primaryKey = "id_pemeriksaanfisik";
    protected $fillable = [
        "id_ibu",
        "keadaan_umum",
        "konjunctiva",
        "sklera",
        "kulit",
        "leher",
        "gigi_mulut",
        "tht",
        "dada",
        "jantung",
        "paru",
        "perut",
        "tungkai",
    ];
}
