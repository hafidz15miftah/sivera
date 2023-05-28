<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiLaporanModel extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'info_id',
        'nama_laporan',
        'tanggal_dilaporkan',
        'gambar',
        'path',
        'status',
    ];

    public function info(){
        return $this->belongsTo(KondisiBarangModel::class, 'info_id', 'id');
    }
}
