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
        Schema::create('usg_trimester3', function (Blueprint $table) {
            $table->id('id_trimester3');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('janin', ['hidup', 'tidak_hidup']);
            $table->string('bpd_janin');
            $table->string('ukuran_janin');
            $table->enum('jumlah_janin', ['tunggal', 'ganda']);
            $table->string('hc_jumlahjanin');
            $table->string('ukuran_jumlahjanin');
            $table->enum('letak_janin', ['intrauterine', 'ekstrauterine', 'presentasi_kepala', 'presentasi_sungsang', 'presentasi_melintang']);
            $table->string('ac_letakjanin');
            $table->string('ukuran_letakjanin');
            $table->string('berat_janin');
            $table->string('fl_beratjanin');
            $table->string('ukuran_beratjanin');
            $table->enum('plasenta', ['normal', 'tidak_normal']);
            $table->boolean('cairan_ketuban');
            $table->string('ukuran_plasenta');
            $table->string('usia_kehamilan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usg_trimester3');
    }
};
