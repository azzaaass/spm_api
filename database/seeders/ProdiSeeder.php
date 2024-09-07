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
            'slug' => 'IT',
        ]);
        Prodi::create([
            'name' => 'Sistem Informasi',
            'slug' => 'SI',
        ]);
        Prodi::create([
            'name' => ' Informatika',
            'slug' => 'IF',
        ]);
        Prodi::create([
            'name' => 'Bisnis Digital',
            'slug' => 'Bisdig',
        ]);
        Prodi::create([
            'name' => 'Sais Data',
            'slug' => 'DS',
        ]);
    }
}
