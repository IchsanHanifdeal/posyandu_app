<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    use HasFactory;
    protected $table = 'rujukan';
    protected $primaryKey = 'id_rujukan';
    protected $fillable = ['id_ibu', 'alasan', 'tanggal', 'diagnosis_oleh', 'resume', 'anjuran', 'rekomendasi'];

    public function ibu()
    {
        return $this->belongsTo(Ibu::class, 'id_ibu', 'id_ibu');
    }
}
