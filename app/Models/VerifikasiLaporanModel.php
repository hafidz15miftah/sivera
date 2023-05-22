<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiLaporanModel extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_laporan';

    protected $fillable = [
        'nama_laporan',
        'tanggal_dilaporkan',
        'path',
        'status',
    ];
}
