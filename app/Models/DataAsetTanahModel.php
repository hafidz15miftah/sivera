<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAsetTanahModel extends Model
{
    use HasFactory;

    protected $table = 'tanah';

    protected $fillable = [
        'nama_obyek',
        'alamat',
        'no_sertifikat',
        'luas',
        'inventarisir',
        'kondisi',
        'keterangan',
    ];
}
