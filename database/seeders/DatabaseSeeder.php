<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(DosenSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(JabatanSeeder::class);
        
        $this->call(HistoryJabatanSeeder::class);

        $this->call(PenelitianSeeder::class);
        $this->call(PenelitianDosenSeeder::class);
        $this->call(PenelitianMahasiswaSeeder::class);

    }
}
