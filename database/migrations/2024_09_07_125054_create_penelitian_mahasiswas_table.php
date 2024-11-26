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
        Schema::create('penelitian_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nim_mahasiswa');
            $table->foreign('nim_mahasiswa')->references('nim')->on('mahasiswas');
            $table->foreignId('id_penelitian')->constrained('penelitians');
            $table->integer('flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitian_mahasiswas');
    }
};
