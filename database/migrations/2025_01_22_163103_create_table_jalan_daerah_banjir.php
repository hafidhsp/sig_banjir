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
            // $table->unsignedBigInteger('id_daerah_banjir');
            // $table->foreign('id_daerah_banjir')->references('id_daerah_banjir')->on('tb_daerah_banjir');
            // Start Revisi Merge
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_kecamatan');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('tb_kecamatan')->onDelete('cascade');
            $table->string('pemberi_informasi');
            $table->boolean('batal_st');
            // End Revisi Merge
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai')->nullable();
            $table->text('nama_jalan');
            $table->string('nomor_jalan');
            $table->string('panjang_jalan');
            // $table->string('jenis_banjir')->nullable();
            $table->string('tinggi_banjir')->nullable();
            $table->text('long_atitude')->nullable();
            $table->text('la_atitude')->nullable();
            $table->string('icon')->nullable();
            // $table->string('radius')->nullable();
            $table->integer('radius')->nullable();
            $table->string('warna_radius')->nullable();
            $table->boolean('konfirmasi_st');
            $table->text('bukti_foto')->nullable();
            // STart Revisi Catatan Kepala
            $table->text('jalan_daerah_banjir_catatan_kepala')->nullable();
            $table->text('jalan_daerah_banjir_kepala_id')->nullable();
            // End Revisi Catatan Kepala
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
