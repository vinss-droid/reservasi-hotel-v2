<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'id_pemesan',
        'id_kamar',
        'tgl_reservasi',
        'tgl_checkin',
        'tgl_checkout',
        'nama_tamu',
        'jumlah_kamar',
        'selesai',
    ];

}
