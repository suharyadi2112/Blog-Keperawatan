<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenModel extends Model
{
    use HasFactory;
    protected $table = 'dokumen_models';

    protected $fillable = [
        'nama',
        'deskripsi',
        'file',
        'id_user',
        'id_informasi',
    ];

    public function informasiDokumen()
    {
        return $this->belongsTo(Informasi::class, 'id_informasi');
    }
}
