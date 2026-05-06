<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin Nanta',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        // Admin Tambahan
        User::factory()->create([
            'name' => 'Admin Wibu',
            'email' => 'wibu@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        // 50 Data Pegawai
        $this->call([
            PegawaiSeeder::class,
        ]);
    }
}
