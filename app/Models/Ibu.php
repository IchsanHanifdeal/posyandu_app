<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibu extends Model
{
    use HasFactory;
    protected $table = "ibu";
    protected $primaryKey = "id_ibu";
    protected $fillable = ['id_user', 'nik', 'no_jkn', 'faskes_tk_1', 'faskes_rujukan', 'pembiayaan', 'golongan_darah', 'tempat_lahir', 'tanggal_lahir', 'pendidikan', 'pekerjaan', 'alamat', 'puskesmas_domisili', 'no_register_kohort'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pendamping()
    {
        return $this->hasOne(Pendamping::class, 'id_ibu', 'id_ibu');
    }
}
