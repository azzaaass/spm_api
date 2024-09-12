<?php

namespace Database\Seeders;

use App\Models\PengabdianMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengabdianMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengabdianMahasiswa::create([
            'nim_mahasiswa' => 1202210481,
            'id_pengabdian' => 1,
            'flag' => 2,
        ]);
    }
}
