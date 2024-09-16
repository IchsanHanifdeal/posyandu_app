<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusImunisasi extends Model
{
    use HasFactory;
    protected $table = "status_imunisasi";
    protected $primaryKey = "id_statusimunisasi";
    protected $fillable = [
        "id_ibu",
        "1_bulan",
        "6_bulan",
        "12_bulan10",
        "25_bulan25",
    ];
}
