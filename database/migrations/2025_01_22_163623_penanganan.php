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
        Schema::create('tb_penanganan', function (Blueprint $table) {
            $table->id('id_penanganan');
            $table->unsignedBigInteger('id_jalan_daerah_banjir');
            $table->foreign('id_jalan_daerah_banjir')->references('id_jalan_daerah_banjir')->on('tb_jalan_daerah_banjir')->onDelete('cascade');
            $table->string('nama_penanganan');
            // $table->string('jenis_penanganan');
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai')->nullable();
            $table->integer('status_penanganan');
            $table->string('petugas');
            $table->string('anggaran');
            $table->text('deskripsi_penanganan');
            $table->boolean('konfirmasi_st');
            $table->text('bukti_penanganan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_penanganan');
    }
};
