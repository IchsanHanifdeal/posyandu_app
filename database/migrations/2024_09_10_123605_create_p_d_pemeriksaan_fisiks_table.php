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
        Schema::create('pd_pemeriksaan_fisik', function (Blueprint $table) {
            $table->id('id_pdpemeriksaanfisik');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('konjunctiva', ['baik', 'anemia', 'tidak_anemia']);
            $table->enum('sklera', ['baik', 'ikretik', 'tidak_ikretik']);
            $table->enum('leher', ['normal', 'tidak_normal'])->default('normal');
            $table->enum('gigi_mulut', ['normal', 'tidak_normal'])->default('normal');
            $table->enum('tht', ['normal', 'tidak_normal'])->default('normal');
            $table->enum('jantung', ['normal', 'tidak_normal'])->default('normal');
            $table->enum('paru', ['normal', 'tidak_normal'])->default('normal');
            $table->enum('perut', ['normal', 'tidak_normal'])->default('normal');
            $table->enum('tungkai', ['normal', 'tidak_normal'])->default('normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pd_pemeriksaan_fisik');
    }
};
