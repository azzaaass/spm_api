<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => 1202210481,
            'name' => 'Stephani Debora',
            'angkatan' => 2021,
            'id_prodi' => 1
        ]);
        Mahasiswa::create([
            'nim' => 1202210482,
            'name' => 'Leonna Zhen',
            'angkatan' => 2021,
            'id_prodi' => 1
        ]);
    }
}
