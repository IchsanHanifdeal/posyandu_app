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
        Schema::create('pelayanan_neonatus', function (Blueprint $table) {
            $table->id('id_pelayanan_neonatus');
            $table->unsignedBigInteger('id_ibu');
            $table->foreign('id_ibu')->references('id_ibu')->on('ibu')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_anak');
            $table->foreign('id_anak')->references('id_anak')->on('identitas_anak')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('tanda_bayi_baru_lahir_sehat')->default(false);
            $table->boolean('pelayanan_essensial_bayi')->default(false);
            $table->boolean('perawatan_bayi_baru_lahir')->default(false);
            $table->boolean('pelayanan_kesehatan_pada_bayi_baru_lahir')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan_neo_natuses');
    }
};
