<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'nip' => 123456789,
            'name' => 'Bernandus Aji Seno',
            'slug' => 'BOS',
            'id_prodi' => 1
        ]);
    }
}
