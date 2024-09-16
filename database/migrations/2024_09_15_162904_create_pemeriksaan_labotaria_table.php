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
        Schema::create('pemeriksaan_labotarium', function (Blueprint $table) {
            $table->id('id_pemeriksaanlabotarium');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->string('hemoglobin');
            $table->string('rencana_hemoglobin')->nullable();
            $table->string('gula_darah_puasa');
            $table->string('rencana_gula_darah_puasa')->nullable();
            $table->string('gula_darah_2_jam_post_prandial');
            $table->string('rencana_gula_darah_2_jam_post_prandial')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_labotaria');
    }
};
