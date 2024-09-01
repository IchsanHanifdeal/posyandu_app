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
        Schema::create('pengurus_posyandu', function (Blueprint $table) {
            $table->id('id_pengurus');
            $table->foreignId('id_posyandu')->references('id_posyandu')->on('posyandu')->constrained()->onDelete('cascade');
            $table->foreignId('id_user')->references('id_user')->on('users')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus_posyandu');
    }
};
