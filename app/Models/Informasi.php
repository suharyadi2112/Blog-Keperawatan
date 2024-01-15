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
    ];
}

