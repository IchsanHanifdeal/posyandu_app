<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;
    protected $table = 'posyandu';
    protected $primaryKey = 'id_posyandu';
    protected $fillable = [
        'nama_posyandu',
        'alamat',
        'fasilitas',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'pengurus_posyandu', 'id_posyandu', 'id_user');
    }
}
