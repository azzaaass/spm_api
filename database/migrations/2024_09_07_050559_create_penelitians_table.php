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
        Schema::create('penelitians', function (Blueprint $table) {
            $table->id();
            $table->string('no_sk')->nullable();
            $table->string('no_kontrak')->nullable();
            $table->string('judul');
            $table->string('skema')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('bidang')->nullable();
            $table->integer('dana')->nullable();
            $table->enum('sumber_dana', ['Internal', 'Eksternal'])->nullable();
            $table->string('laporan_akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitians');
    }
};
