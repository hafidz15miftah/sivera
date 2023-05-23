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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained();
            $table->foreignId('ruang_id')->constrained();
            $table->date('tgl_pembelian');
            $table->string('sumber_dana');
            $table->integer('baik')->default(0);
            $table->integer('rusak_ringan')->default(0);
            $table->integer('rusak_berat')->default(0);
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('laporan');
    }
};
