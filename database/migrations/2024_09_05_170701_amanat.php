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
        Schema::create('amanat', function (Blueprint $table) {
            $table->id('id_amanat');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bulan');
            $table->integer('tahun');
            $table->string('dokter_1');
            $table->string('dokter_2')->nullable();
            $table->string('dana_persalinan');
            $table->string('kendaraan_1');
            $table->string('hp_kendaraan_1');
            $table->string('kendaraan_2')->nullable();
            $table->string('hp_kendaraan_2')->nullable();
            $table->string('kendaraan_3')->nullable();
            $table->string('hp_kendaraan_3')->nullable();
            $table->string('metode_persalinan');
            $table->string('golongan_darah');
            $table->string('rhesus');
            $table->string('bantuan_1');
            $table->string('hp_bantuan_1');
            $table->string('bantuan_2')->nullable();
            $table->string('hp_bantuan_2')->nullable();
            $table->string('bantuan_3')->nullable();
            $table->string('hp_bantuan_3')->nullable();
            $table->string('bantuan_4')->nullable();
            $table->string('hp_bantuan_4')->nullable();
            $table->string('persetujuan_pendamping')->nullable();
            $table->string('persetujuan_ibu')->nullable();
            $table->string('persetujuan_dokter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amanat');
    }
};
