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
        Schema::create('pemeriksaan_khusus', function (Blueprint $table) {
            $table->id('id_pemeriksaankhusus');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('vulva',['normal', 'tidak_normal'])->default('normal');
            $table->enum('uretra',['normal', 'tidak_normal'])->default('normal');
            $table->enum('vagina',['normal', 'tidak_normal'])->default('normal');
            $table->enum('porsio',['normal', 'tidak_normal'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_khusus');
    }
};
