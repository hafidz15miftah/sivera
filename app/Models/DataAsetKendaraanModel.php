<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAsetKendaraanModel extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'nama_kendaraan',
        'plat',
        'tgl_pembelian',
        'merk',
        'tipe',
        'inventarisir',
        'kondisi',
        'keterangan',
    ];
}
