<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarangModel extends Model
{
    use HasFactory;


    protected $table = 'barangs';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'ruang_id'
];

    // one to many
    public function ruang(){
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }
}
