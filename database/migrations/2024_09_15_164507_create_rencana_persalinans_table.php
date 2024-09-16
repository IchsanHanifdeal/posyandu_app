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
        Schema::create('rencana_persalinan', function (Blueprint $table) {
            $table->id('id_rencana_persalinan');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('persalinan_normal')->default(false);
            $table->boolean('persalinan_pervaginam')->default(false);
            $table->boolean('sectio_caesaria')->default(false);
            $table->boolean('berbantu')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_persalinan');
    }
};
