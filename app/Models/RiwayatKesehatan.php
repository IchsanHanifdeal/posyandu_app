<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKesehatan extends Model
{
    use HasFactory;
    protected $table = "riwayat_kesehatan";
    protected $primaryKey = "id_riwayatkesehatan";
    protected $fillable = [
        "id_ibu",
        "jantung",
        "hipertensi",
        "tyroid",
        "alergi",
        "autoimun",
        "asma",
        "tb",
        "hepasitis_b",
        "jiwa",
        "sifilis",
        "diabetes",
        "lainnya",
    ];
}
