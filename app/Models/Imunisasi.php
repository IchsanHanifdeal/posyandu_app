<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;
    protected $table = 'imunisasi';
    protected $fillable = ['id_ibu', 'id_anak', 'jenis_vaksin', 'tanggal'];

    public function anak()
    {
        return $this->belongsTo(IdentitasAnak::class, 'id_anak', 'id_anak');
    }

    public function ibu()
    {
        return $this->belongsTo(Ibu::class, 'id_ibu', 'id_ibu');
    }

}
