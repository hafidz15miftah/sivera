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
        'barang_id',
        'ruang_id',
        'tgl_pembelian',
        'sumber_dana',
        'baik',
        'rusak_ringan',
        'rusak_berat',
        'jumlah',
        'keterangan',
        'gambar',
    ];

    // one to many
    public function barang(){
        return $this->belongsTo(DataBarangModel::class, 'barang_id', 'id');
    }

    public function ruang(){
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }
}
