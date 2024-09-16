<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiKesehatan extends Model
{
    use HasFactory;
    protected $table = "kondisi_kesehatan";
    protected $primaryKey = "id_kondisikesehatan";
    protected $fillable = [
        'id_ibu',
        'tanggal',
        'tb',
        'bb',
        'lila',
        'imt',
    ];
}
