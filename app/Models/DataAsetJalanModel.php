<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAsetJalanModel extends Model
{
    use HasFactory;

    protected $table = 'jalans';

    protected $fillable = [
        'nama_jalan',
        'no_dokumen',
        'panjang',
        'sumber',
        'kondisi',
        'keterangan',
    ];
}
