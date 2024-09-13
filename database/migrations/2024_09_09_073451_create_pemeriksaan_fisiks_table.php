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
        Schema::create('pemeriksaan_fisik', function (Blueprint $table) {
            $table->id('id_pemeriksaanfisik');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->string('keadaan_umum')->nullable();
            $table->enum('konjunctiva',['normal','tidak'])->default('normal');
            $table->enum('sklera',['normal','tidak normal'])->default('normal');
            $table->enum('kulit',['normal','tidak normal'])->default('normal');
            $table->enum('leher',['normal','tidak normal'])->default('normal');
            $table->enum('gigi_mulut',['normal','tidak normal'])->default('normal');
            $table->enum('tht',['normal','tidak normal'])->default('normal');
            $table->enum('dada',['normal','tidak normal'])->default('normal');
            $table->enum('jantung',['normal','tidak normal'])->default('normal');
            $table->enum('paru',['normal','tidak normal'])->default('normal');
            $table->enum('perut',['normal','tidak normal'])->default('normal');
            $table->enum('tungkai',['normal','tidak normal'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_fisik');
    }
};
