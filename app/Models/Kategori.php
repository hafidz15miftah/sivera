<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
        'kode_kategori'
    ];

    // one to many
    public function barang(){
        return $this->hasMany(DataBarangModel::class, 'kategori_id');
    }
}
