<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quality_controls', function (Blueprint $table) {
            $table->id('id_qc');
            $table->foreignId('kode_proses')->constrained('proses_produksis', 'kode_proses'); 
            $table->date('tanggal_qc');
            $table->string('diperiksa');
            $table->integer('layak');
            $table->integer('reject');
            $table->integer('repair');
            $table->string('deskripsi_repair') ->nullable();
            $table->timestamps(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('quality_controls');
    }
};
