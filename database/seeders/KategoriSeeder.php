<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        Kategori::create([
            'nama_kategori' => 'Mesin',
            'kode_kategori' => '02',
        ]);

        Kategori::create([
            'nama_kategori' => 'Perlengkapan/Peralatan',
            'kode_kategori' => '03',
        ]);
    }
}
