<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FKamar extends Model
{
    use HasFactory;

    protected $table = 'fasilitas_kamar';

    protected $fillable = [
        'id_kamar',
        'nama_fasilitas'
    ];
}
