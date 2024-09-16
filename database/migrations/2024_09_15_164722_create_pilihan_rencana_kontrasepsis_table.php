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
        Schema::create('pilihan_rencana_kontrasepsi', function (Blueprint $table) {
            $table->id('id_pilihan_rencana_kontrasepsi');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('mal')->default(false);
            $table->boolean('pil')->default(false);
            $table->boolean('suntik')->default(false);
            $table->boolean('akdr')->default(false);
            $table->boolean('implan')->default(false);
            $table->boolean('steril')->default(false);
            $table->boolean('belum_memilih')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihan_rencana_kontrasepsi');
    }
};
