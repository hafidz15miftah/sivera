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
        $data = [
            'Kepala Desa', 
            'Sekretaris Desa', 
            'Kepala Urusan Umum dan Perencanaan', 
            'Kepala Urusan Keuangan dan Kepala Urusan Kesejahteraan', 
            'Kepala Urusan Pelayanan', 
            'Kepala Urusan Pemerintahan'
        ];

        foreach($data as $d){
            Ruang::create(['nama_ruang' => $d]);
        }
    }
}
