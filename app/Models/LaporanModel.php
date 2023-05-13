<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanModel extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'kode_laporan',
        'kode_barang',
        'kondisi',
        'jumlah',
        'gambar',
        'keterangan',
        'status',
    ];

    public function kodebar() {
        return $this->belongsTo(DataBarangModel::class, 'kode_barang', 'id');
    }
}
