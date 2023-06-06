<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruang::create([
            'nama_ruang' => 'Kepala Desa',
            'kode_ruang' => '01',
        ]);

        Ruang::create([
            'nama_ruang' => 'Sekretaris Desa',
            'kode_ruang' => '02',
        ]);

        Ruang::create([
            'nama_ruang' => 'Kepala Urusan Umum dan Perencanaan',
            'kode_ruang' => '03',
        ]);

        Ruang::create([
            'nama_ruang' => 'Kepala Urusan Keuangan dan Kepala Urusan Kesejahteraan',
            'kode_ruang' => '04',
        ]);

        Ruang::create([
            'nama_ruang' => 'Kepala Urusan Pelayanan',
            'kode_ruang' => '05',
        ]);

        Ruang::create([
            'nama_ruang' => 'Kepala Urusan Pemerintahan',
            'kode_ruang' => '06',
        ]);
    }
}
