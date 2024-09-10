<?php

namespace Database\Seeders;

use App\Models\PenelitianDosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenelitianDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenelitianDosen::create([
            'nip_dosen' => 18620029,
            'id_penelitian' => 1,
            'flag' => 1
        ]);
    }
}
