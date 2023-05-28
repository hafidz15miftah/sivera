<?php

namespace App\Models;

use App\Http\Controllers\KondisiController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangModel extends Model
{
    use HasFactory;

    protected $table = 'details';

    protected $fillable = [
        'barang_id',
        'ruang_id',
        'info_id',
        'tgl_perolehan',
        'merk',
        'sumber',
        'harga',
        'keterangan',
    ];

    // one to many
    public function barang(){
        return $this->belongsTo(DataBarangModel::class, 'barang_id', 'id');
    }

    public function ruang(){
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }

    public function info(){
        return $this->belongsTo(KondisiBarangModel::class, 'info_id', 'id');
    }
}