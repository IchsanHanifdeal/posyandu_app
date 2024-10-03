<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkembanganAnak extends Model
{
    use HasFactory;
    protected $table = 'perkembangan_anak';
    protected $fillable = [
        'id_ibu',
        'id_anak',
        'pemeriksaan',
        'tinggi_badan',
        'berat_badan',
        'pemberian_asi',
        'pelayanan',
        'pemberian_imunisasi',
        'catatan',
    ];

    public function anak()
    {
        return $this->belongsTo(IdentitasAnak::class, 'id_anak', 'id_anak');
    }

    public function ibu()
    {
        return $this->belongsTo(Ibu::class, 'id_ibu', 'id_ibu');
    }
}
