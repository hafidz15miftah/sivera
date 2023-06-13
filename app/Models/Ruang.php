<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $table = 'ruangs';

    protected $fillable = [
        'nama_ruang',
        'kode_ruang'
    ];

    // one to many
    public function barang(){
        return $this->hasMany(DataBarangModel::class, 'ruang_id');
    }
}

