<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::query()->updateOrCreate([
            'email' => 'admin@siakad.test',
        ], [
            'name' => 'Admin SIAKAD',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
            'npm' => null,
            'email_verified_at' => now(),
        ]);

        Dosen::query()->updateOrCreate([
            'email' => 'dosen@siakad.test',
        ], [
            'nama' => 'Dosen Demo',
            'nidn' => 'DSN2026001',
        ]);

        User::query()->updateOrCreate([
            'email' => 'dosen@siakad.test',
        ], [
            'name' => 'Dosen Demo',
            'password' => Hash::make('password'),
            'role' => UserRole::Dosen,
            'npm' => null,
            'email_verified_at' => now(),
        ]);

        User::query()->updateOrCreate([
            'email' => 'mahasiswa@siakad.test',
        ], [
            'name' => 'Mahasiswa Demo',
            'password' => Hash::make('password'),
            'role' => UserRole::Mahasiswa,
            'npm' => 'TI20260001',
            'email_verified_at' => now(),
        ]);
    }
}
