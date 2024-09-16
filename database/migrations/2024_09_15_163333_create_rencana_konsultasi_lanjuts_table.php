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
        Schema::create('rencana_konsultasi_lanjut', function (Blueprint $table) {
            $table->id('id_rencana_konsultasi_lanjut');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('gizi')->default(false);
            $table->boolean('kebidanan')->default(false);
            $table->boolean('anak')->default(false);
            $table->boolean('penyakit_dalam')->default(false);
            $table->boolean('neurologi')->default(false);
            $table->boolean('tht')->default(false);
            $table->boolean('psikiatri')->default(false);
            $table->string('lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_konsultasi_lanjut');
    }
};
