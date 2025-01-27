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
        Schema::create('tb_penanggulangan', function (Blueprint $table) {
            $table->id('id_penanggulangan');
            $table->unsignedBigInteger('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('tb_kecamatan');
            $table->string('nama_penanggulangan');
            $table->string('jenis_penanggulangan');
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai')->nullable();
            $table->integer('status_penanggulangan');
            $table->string('petugas')->nullable();
            $table->string('anggaran')->nullable();
            $table->text('deskripsi_penanggulangan')->nullable();
            $table->text('bukti_penanggulangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_penanggulangan');
    }
};
