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
        Schema::create('ibu', function (Blueprint $table) {
            $table->id('id_ibu');
            $table->unsignedBigInteger('id_posyandu');
            $table->foreign('id_posyandu')->references('id_posyandu')->on('posyandu')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nik')->unique()->nullable();
            $table->string('no_jkn')->nullable();
            $table->string('faskes_tk_1')->nullable();
            $table->string('faskes_rujukan')->nullable();
            $table->string('pembiayaan')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('puskesmas_domisili')->nullable();
            $table->string('no_register_kohort')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu');
    }
};
