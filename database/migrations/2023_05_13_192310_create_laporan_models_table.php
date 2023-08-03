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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained();
            $table->foreignId('ruang_id')->constrained();
            $table->foreignId('info_id')->constrained();
            $table->date('tgl_perolehan');
            $table->string('merk')->nullable();
            $table->string('sumber');
            $table->date('inventarisir');
            $table->integer('harga')->nullable();
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
        Schema::dropIfExists('details');
    }
};
