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
            'no_sk' => '123',
            'no_kontrak' => '123',
            'judul' => 'Cara Cepat Kaya Raya',
            'skema' => '123',
            'tahun' => 2022,
            'bidang' => '123',
            'dana' => 1000000,
            'sumber_dana' => 'Internal',
        ]);
    }
}
