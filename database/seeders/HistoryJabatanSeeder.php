<?php

namespace Database\Seeders;

use App\Models\HistoryJabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoryJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoryJabatan::create([
            'nip_dosen' => 18620029,
            'id_jabatan' => 2,
        ]);
        HistoryJabatan::create([
            'nip_dosen' => 18620029,
            'id_jabatan' => 1,
        ]);
    }
}
