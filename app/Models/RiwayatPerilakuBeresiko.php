<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerilakuBeresiko extends Model
{
    use HasFactory;
    protected $table = "riwayat_perilaku_beresiko";
    protected $primaryKey = "id_riwayatperilakuberesiko";
    protected $fillable = [
        "id_ibu",
        "merokok",
        "pola_makan_beresiko",
        "alkohol",
        "obat-obatan",
        "kosmetik",
        "lainnya",
    ];
}
