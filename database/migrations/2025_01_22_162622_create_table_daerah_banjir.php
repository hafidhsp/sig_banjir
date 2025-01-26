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
        Schema::create('tb_daerah_banjir', function (Blueprint $table) {
            $table->id('id_daerah_banjir');
            $table->unsignedBigInteger('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('tb_kecamatan')->onDelete('cascade');
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai');
            $table->string('pemberi_informasi');
            $table->text('radius_daerah_banjir');
            $table->text('warna_radius');
            $table->boolean('konfirasi_st');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_daerah_banjir');
    }
};
