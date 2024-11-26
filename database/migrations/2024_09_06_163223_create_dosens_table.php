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
        Schema::create('dosens', function (Blueprint $table) {
            $table->integer('nip')->primary();
            $table->string('nidn')->unique();
            $table->string('name');
            $table->enum('status', ['Aktif', 'Tidak aktif'])->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('kode_dosen')->unique()->nullable();
            $table->foreignId('id_prodi')->constrained('prodis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};