<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKehamilan extends Model
{
    use HasFactory;
    protected $table = "riwayat_kehamilan";
    protected $primaryKey = "id_riwayatkehamilan";
    protected $fillable = [
        "id_ibu",
        "tahun",
        "berat_lahir",
        "persalinan",
        "penolong_persalinan",
        "komplikasi",
    ];
}
