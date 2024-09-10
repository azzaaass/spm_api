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
        Schema::create('penelitian_dosens', function (Blueprint $table) {
            $table->id();
            $table->integer('nip_dosen');
            $table->foreign('nip_dosen')->references('nip')->on('dosens');
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
        Schema::dropIfExists('penelitian_dosens');
    }
};
