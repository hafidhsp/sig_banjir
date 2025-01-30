<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_jalan_daerah_banjir', function (Blueprint $table) {
            $table->id('id_jalan_daerah_banjir');
            $table->unsignedBigInteger('id_daerah_banjir');
            $table->foreign('id_daerah_banjir')->references('id_daerah_banjir')->on('tb_daerah_banjir');
            $table->string('jenis_banjir');
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai');
            $table->text('nama_jalan');
            $table->string('nomor_jalan');
            $table->string('panjang_jalan');
            $table->string('tinggi_banjir');
            $table->text('long_atitude')->nullable();
            $table->text('la_atitude')->nullable();
            $table->string('icon')->nullable();
            $table->string('radius')->nullable();
            $table->string('warna_radius')->nullable();
            $table->boolean('konfirmasi_st');
            $table->text('bukti_foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_jalan_daerah_banjir');
    }
};
