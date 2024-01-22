<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'informasis';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'judul_informasi',
        'isi_informasi',
        'id_user',
        'thumbnail',
        'publish',
    ];

    public function dokumentasis()
    {
        return $this->hasMany(Dokumentasi::class, 'id_informasi', 'id');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenModel::class, 'id_informasi', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

