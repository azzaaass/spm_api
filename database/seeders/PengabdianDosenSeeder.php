<?php

namespace Database\Seeders;

use App\Models\PengabdianDosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengabdianDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengabdianDosen::create([
            'nip_dosen' => 18620029,
            'id_pengabdian' => 1,
            'flag' => 1
        ]);
    }
}
