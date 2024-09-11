<?php

namespace Database\Seeders;

use App\Models\Pengabdian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengabdianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengabdian::create([
            'no_sk' => '321',
            'no_kontrak' => '321',
            'judul' => 'Cara tidak kaya',
            'skema' => '321',
            'tahun' => 2022,
            'bidang' => '321',
            'dana' => 1000000,
            'sumber_dana' => 'Eksternal',
            'laporan_akhir' => 'https://example.com/penelitian.pdf',
        ]);
    }
}
