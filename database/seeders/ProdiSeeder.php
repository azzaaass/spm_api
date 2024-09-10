<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create([
            'name' => 'Teknologi Informasi',
            'kode_prodi' => 'IT',
        ]);
        Prodi::create([
            'name' => 'Sistem Informasi',
            'kode_prodi' => 'SI',
        ]);
        Prodi::create([
            'name' => ' Informatika',
            'kode_prodi' => 'IF',
        ]);
        Prodi::create([
            'name' => 'Bisnis Digital',
            'kode_prodi' => 'Bisdig',
        ]);
        Prodi::create([
            'name' => 'Sais Data',
            'kode_prodi' => 'DS',
        ]);
        Prodi::create([
            'name' => 'Teknik Telekomunikasi',
            'kode_prodi' => 'TT',
        ]);
    }
}
