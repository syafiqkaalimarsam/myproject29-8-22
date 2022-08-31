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
        Schema::create('profilhotels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hotel');
            $table->string('nomor_kamar');
            $table->string('alamat_hotel');
            $table->string('nomor_telp');
            $table->string('id_pesanan');
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
        Schema::dropIfExists('profilhotels');
    }
};
