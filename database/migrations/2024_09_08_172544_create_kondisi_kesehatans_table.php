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
        Schema::create('kondisi_kesehatan', function (Blueprint $table) {
            $table->id('id_kondisikesehatan');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->string('tb');
            $table->string('bb');
            $table->string('lila');
            $table->enum('imt',['kurus', 'normal', 'obesitas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi_kesehatan');
    }
};
