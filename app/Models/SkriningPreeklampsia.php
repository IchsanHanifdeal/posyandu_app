<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningPreeklampsia extends Model
{
    use HasFactory;
    protected $table = 'skrining_preeklampsia';
    protected $fillable = [
        'id_ibu',
        'kriteria',
        'risiko',
    ];
}
