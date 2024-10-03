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
        Schema::create('perkembangan_anak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_anak');
            $table->foreign('id_anak')->references('id_anak')->on('identitas_anak')->onDelete('cascade')->onUpdate('cascade');
            $table->date('pemeriksaan');
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('pemberian_asi')->nullable();
            $table->string('pelayanan')->nullable();
            $table->string('pemberian_imunisasi')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkembangan_anak');
    }
};
