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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_posyandu');
            $table->foreign('id_posyandu')->references('id_posyandu')->on('posyandu')->onDelete('cascade')->onUpdate('cascade');
            $table->string('sasaran_balita_perbulan');
            $table->string('sasaran_ds_perbulan');
            $table->string('sasaran_ibu_hamil');
            $table->string('ibu_hamil_yang_dapat_pelayanan');
            $table->string('sasaran_remaja');
            $table->string('remaja_yang_dapat_pelayanan_kesehatan');
            $table->string('sasaran_usia_produktif');
            $table->string('usia_produktif_yang_dapat_pelayanan_kesehatan');
            $table->string('sasaran_lansia');
            $table->string('lansia_yang_dapat_pelayanan_kesehatan');
            $table->string('jumlah_bayi_yang_di_imunisasi');
            $table->string('jumlah_kunjungan_rumah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
