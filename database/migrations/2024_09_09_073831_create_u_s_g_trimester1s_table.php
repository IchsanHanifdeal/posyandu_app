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
        Schema::create('usg_trimester1', function (Blueprint $table) {
            $table->id('id_usgtrimester');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->string('hpht');
            $table->string('kehamilan');
            $table->string('gs');
            $table->string('crl');
            $table->string('djj');
            $table->enum('letak_jantung_janin', ['intrauterin', 'ekstrauterin']);
            $table->string('taksiran_persalinan');
            $table->date('tanggal');
            $table->string('hemoglobin');
            $table->string('golongan_darah');
            $table->string('gula_darah_sewaktu');
            $table->string('h');
            $table->string('s');
            $table->string('hepasitis_b');
            $table->string('lainnya')->nullable();
            $table->string('kesimpulan');
            $table->string('rekomendasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usg_trimester1');
    }
};
