<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Baihaqi Ilmi',
            'email' => 'baihaqiilmi@gmail.com',
            'password' => '$2y$12$mhKvt35dqgUeJd/JhyoIouteZIV1xKZ.B06MhJOPNm2JoqCBcm/oa'
        ]);
    }
}
