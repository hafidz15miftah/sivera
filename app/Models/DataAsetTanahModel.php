<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAsetTanahModel extends Model
{
    use HasFactory;

    protected $table = 'tanah';

    protected $fillable = [
        'kategori_id',
        'nama_obyek',
        'alamat',
        'no_sertifikat',
        'luas',
        'kondisi',
        'keterangan',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
