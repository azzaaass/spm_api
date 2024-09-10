<?php

namespace Database\Seeders;

use App\Models\PenelitianMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenelitianMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenelitianMahasiswa::create([
            'nim_mahasiswa' => 1202210481,
            'id_penelitian' => 1,
            'flag' => 2,
        ]);
    }
}
