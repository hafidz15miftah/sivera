<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiLaporanModel extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'detail_id',
        'nama_laporan',
        'tanggal_dilaporkan',
        'gambar',
        'path',
        'status',
    ];

    public function detail(){
        return $this->belongsTo(DetailBarangModel::class, 'detail_id', 'id');
    }
}
