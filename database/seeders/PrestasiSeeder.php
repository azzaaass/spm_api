<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prestasi::create([
            'nama_lomba' => 'Lomba makan krupuk',
            'juara' => 'Juara 1',
            'url_foto' => 'https://example.com/prestasi.jpg',
            'url_sertifikat' => 'https://example.com/sertifikat.pdf',
        ]);
    }
}
