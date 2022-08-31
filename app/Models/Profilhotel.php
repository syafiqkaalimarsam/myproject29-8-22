<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profilhotel extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_hotel',
        'nomor_kamar',
        'alamat_hotel',
        'nomor_telp',
        'id_pesanan',
    ];
}
