<?php

namespace Database\Seeders;

use App\Models\Penelitian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenelitianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penelitian::create([
            'judul' => 'Cara Cepat Kaya Raya',
            'dana' => 1000000,
            'tahun' => 2022,
            'id_prodi' => 1,
            'publish' => 'Sinta',
            'kategori' => 'Jurnal Internasional',
        ]);
    }
}
