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
        Schema::create('history_jabatans', function (Blueprint $table) {
            $table->id();
            $table->integer('nip_dosen');
            $table->foreign('nip_dosen')->references('nip')->on('dosens');
            $table->foreignId('id_jabatan')->constrained('jabatans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_jabatans');
    }
};
