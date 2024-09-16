<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanKhusus extends Model
{
    use HasFactory;
    protected $table = "pemeriksaan_khusus";
    protected $primaryKey = "id_pemeriksaankhusus";
    protected $fillable = [
        "id_ibu",
        "vulva",
        "uretra",
        "vagina",
        "porsio",
    ];
}
