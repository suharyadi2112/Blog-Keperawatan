<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasis';

    protected $fillable = [
        'nama_dokumentasi',
        'foto_dokumentasi',
        'id_informasi'
    ];

    public function informasi()
    {
        return $this->belongsTo(Informasi::class, 'id_informasi');
    }
}
