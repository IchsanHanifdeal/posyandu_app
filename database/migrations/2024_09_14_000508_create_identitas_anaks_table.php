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
            $table->string('no_surat');
            $table->string('hari');
            $table->date('tanggal');
            $table->string('pukul');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('jenis_kelahiran', ['tunggal', 'kembar 2', 'kembar 3', 'lainnya']);
            $table->string('kelahiran_ke');
            $table->string('berat');
            $table->string('panjang');
            $table->string('tempat_kelahiran');
            $table->string('nama');
            $table->string('ttd_saksi1');
            $table->string('nama_saksi1');
            $table->string('ttd_saksi2');
            $table->string('nama_saksi2');
            $table->string('ttd_penolong_persalinan');
            $table->string('nama_penolong_persalinan');
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
