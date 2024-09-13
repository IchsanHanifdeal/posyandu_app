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
        Schema::create('riwayat_kesehatan', function (Blueprint $table) {
            $table->id('id_riwayatkesehatan');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('jantung')->default(false);
            $table->boolean('hipertensi')->default(false);
            $table->boolean('tyroid')->default(false);
            $table->boolean('alergi')->default(false);
            $table->boolean('autoimun')->default(false);
            $table->boolean('asma')->default(false);
            $table->boolean('tb')->default(false);
            $table->boolean('hepasitis_b')->default(false);
            $table->boolean('jiwa')->default(false);
            $table->boolean('sifilis')->default(false);
            $table->boolean('diabetes')->default(false);
            $table->string('lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kesehatan');
    }
};
