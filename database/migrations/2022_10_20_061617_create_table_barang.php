<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('ruang', ['Kepala Desa', 'Sekretaris Desa', 'Kaur Umum dan Perencanaan', 'Kaur Keuangan dan Kasi Kesejahteraan', 'Kasi Pelayanan', 'Kasi Pemerintahan']);
            $table->date('tanggal');
            $table->string('kode_barang');
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat']);
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
