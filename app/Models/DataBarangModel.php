<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarangModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruang',
        'tanggal',
        'kode_barang',
        'nama_barang',
        'kondisi',
        'jumlah',
        'deskripsi',
];
    protected $table = 'barang';
    protected $primaryKey = 'id';
}
