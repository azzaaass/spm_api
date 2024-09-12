<?php

namespace Database\Seeders;

use App\Models\PrestasiMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrestasiMahasiswa::create([
            'nim_mahasiswa' => 1202210481,
            'id_prestasi' => 1,
            'flag' => 1
        ]);
    }
}
