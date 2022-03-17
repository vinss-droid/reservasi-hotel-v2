<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';

    protected $fillable = [
        'tipe_kamar',
        'jumlah_kamar',
        'foto_kamar',
        'kamar_aktif',
    ];
}
