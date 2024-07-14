<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produksis', function (Blueprint $table) {
            $table->id('kode_produksi');
            $table->String('nama_produksi');
            $table->foreignId('id_barang')->constrained('barangs', 'id_barang'); 
            $table->integer('jumlah_produksi');
            $table->integer('barang_diproses');
            $table->integer('jumlah_proses');
            $table->integer('status')->default(1);
            $table->timestamps(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('produksis');
    }
};
