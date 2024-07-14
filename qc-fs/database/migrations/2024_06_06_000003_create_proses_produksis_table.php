<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    
    public function up()
    {
        Schema::create('proses_produksis', function (Blueprint $table) {
            $table->id('kode_proses');
            $table->string('nama_proses');
            $table->foreignId('kode_produksi')->constrained('produksis', 'kode_produksi'); 
            $table->integer('proses_ke');
            $table->date('tanggal_proses');
            $table->integer('jumlah_barang');
            $table->integer('status')->default(1);
            $table->timestamps(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('proses_produksis');
    }
};
