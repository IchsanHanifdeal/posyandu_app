<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;
    protected $table = 'pengurus_posyandu';
    protected $primaryKey = 'id_pengurus';
    protected $fillable = [
        'id_posyandu',
        'id_user',
    ];
}
