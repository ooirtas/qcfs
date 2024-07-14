<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang');
            $table->integer('stock');
            $table->integer('status')->default(1);
            $table->timestamps(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
