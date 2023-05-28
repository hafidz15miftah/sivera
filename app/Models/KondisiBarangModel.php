<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiBarangModel extends Model
{
    use HasFactory;

    protected $table = 'infos';

    protected $fillable = [
        'kode_detail',
        'kondisi',
        'ruang_id',
        'barang_id',
    ];

    // one to many
    public function barang()
    {
        return $this->belongsTo(DataBarangModel::class, 'barang_id', 'id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }
}
