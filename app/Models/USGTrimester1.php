<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class USGTrimester1 extends Model
{
    use HasFactory;
    protected $table = "usg_trimester1";
    protected $primaryKey = "id_usgtrimester";
    protected $fillable = [
        "id_ibu",
        "hpht",
        "kehamilan",
        "gs",
        "crl",
        "djj",
        "letak_jantung_janin",
        "taksiran_persalinan",
        "tanggal",
        "hemoglobin",
        "golongan_darah",
        "gula_darah_sewaktu",
        "h",
        "s",
        "hepasisitis_b",
        "lainnya",
        "kesimpulan",
        "rekomendasi",
    ];
}
