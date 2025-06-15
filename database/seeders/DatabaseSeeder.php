<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $this->call(CategorySeeder::class);
        User::firstOrCreate(
            ['email' => 'rizky230504@gmail.com'], // <-- cek kalau sudah ada
            [
                'name' => 'MUHAMMAD RIZKY',
                'password' => Hash::make('23050477'), // <-- ganti password sesuai kebutuhan
                'role' => 'admin',                    // <-- hanya kalau kamu pakai 'role' di tabel users
            ]
        );
    }
}
