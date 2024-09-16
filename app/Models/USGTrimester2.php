<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class USGTrimester2 extends Model
{
    use HasFactory;
    protected $table = "usg_trimester3";
    protected $primaryKey = "id_ibu";
    protected $fillable = [
        "id_ibu",
        "janin",
        "bpd_janin",
        "ukuran_janin",
        "jumlah_janin",
        "hc_jumlahjanin",
        "ukuran_jumlahjanin",
        "letak_janin",
        "ac_letakjanin",
        "ukuran_letakjanin",
        "berat_letakjanin",
        "fl_beratjanin",
        "ukuran_beratjanin",
        "plasenta",
        "cairan_ketuban",
        "ukuran_plasenta",
        "usia_kehamilan",
    ];
}
