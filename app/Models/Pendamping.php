<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendamping extends Model
{
    use HasFactory;
    protected $table = 'pendamping';
    protected $primaryKey = 'id_pendamping';
    protected $fillable = ['id_ibu', 'nama', 'nik', 'nomor_jkn', 'faskes_tk_1', 'faskes_rujukan', 'pembiayaan', 'golongan_darah', 'tempat_lahir', 'tanggal_lahir', 'pendidikan', 'pekerjaan', 'alamat', 'no_hp'];

    public function ibu()
    {
        return $this->belongsTo(Ibu::class, 'id_ibu', 'id_ibu');
    }
}
