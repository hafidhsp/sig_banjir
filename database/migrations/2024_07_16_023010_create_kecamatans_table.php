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
        Schema::create('tb_kecamatan', function (Blueprint $table) {
            $table->id('id_kecamatan');
            $table->string('nama_kecamatan');
            $table->text('long_atitude')->nullable();
            $table->text('la_atitude')->nullable();
            $table->string('icon')->nullable();
            $table->string('radius')->nullable();
            $table->string('warna_radius')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kecamatan');
    }
};