<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDPemeriksaanFisik extends Model
{
    use HasFactory;
    protected $table = "pd_pemeriksaan_fisik";
    protected $primaryKey = "id_pdpemeriksaanfisik";
    protected $fillable = [
        'id_ibu',
        'konjunctiva',
        'sklera',
        'leher',
        'gigi_mulut',
        'tht',
        'jantung',
        'paru',
        'perut',
        'tungkai',
    ];
}
