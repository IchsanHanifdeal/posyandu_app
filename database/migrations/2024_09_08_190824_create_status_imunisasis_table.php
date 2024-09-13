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
        Schema::create('status_imunisasi', function (Blueprint $table) {
            $table->id('id_statusimunisasi');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('1_bulan')->default(false);
            $table->boolean('6_bulan')->default(false);
            $table->boolean('12_bulan10')->default(false);
            $table->boolean('12_bulan25')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_imunisasi');
    }
};
