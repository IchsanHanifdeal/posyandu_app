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
        Schema::create('riwayat_perilaku_beresiko', function (Blueprint $table) {
            $table->id('id_riwayatperilakuberesiko');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('merokok')->default(false);
            $table->boolean('pola_makan_beresiko')->default(false);
            $table->boolean('alkohol')->default(false);
            $table->boolean('obat-obatan')->default(false);
            $table->boolean('kosmetik')->default(false);
            $table->string('lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_perilaku_beresiko');
    }
};
