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
        Schema::create('identitas_anak', function (Blueprint $table) {
            $table->id('id_anak');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_surat')->nullable();
            $table->string('hari')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('pukul')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->enum('jenis_kelahiran', ['tunggal', 'kembar 2', 'kembar 3', 'lainnya'])->nullable();
            $table->string('kelahiran_ke')->nullable();
            $table->string('berat')->nullable();
            $table->string('panjang')->nullable();
            $table->string('tempat_kelahiran')->nullable();
            $table->string('nama')->nullable();
            $table->string('ttd_saksi1')->nullable();
            $table->string('nama_saksi1')->nullable();
            $table->string('ttd_saksi2')->nullable();
            $table->string('nama_saksi2')->nullable();
            $table->string('ttd_penolong_persalinan')->nullable();
            $table->string('nama_penolong_persalinan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_anak');
    }
};
