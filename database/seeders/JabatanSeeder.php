<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::create([
            'jabatan' => 'Lektor',
            'sub_jabatan' => 'Dosen',
        ]);
        Jabatan::create([
            'jabatan' => 'Lektor Kepala',
            'sub_jabatan' => 'Dosen',
        ]);

        Jabatan::create([
            'jabatan' => 'Asisten Ahli',
            'sub_jabatan' => 'Dosen',
        ]);

        Jabatan::create([
            'jabatan' => 'Guru Besar',
            'sub_jabatan' => 'Dosen',
        ]);
    }
}
