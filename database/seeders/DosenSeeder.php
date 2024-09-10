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
            'nip' => 18620029,
            'nidn' => '0728016901',
            'name' => 'Tri Agus Djoko Kuntjoro',
            'gelar_depan' => 'Ir.',
            'gelar_belakang' => 'M.T.',
            'pendidikan' => 'S2',
            'kode_dosen' => 'ORO',
            'id_prodi' => 6 // teknik telekomunikasi
        ]);
    }
}
