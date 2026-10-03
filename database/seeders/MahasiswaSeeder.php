<?php

// ====================================================================
// database/seeders/MahasiswaSeeder.php
// Seed data contoh untuk tabel mahasiswas (dipakai di halaman /about).
// Jalankan lewat: php artisan db:seed
// ====================================================================

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Hardiman G. Hutauruk', 'program_studi' => 'Ilmu Komputer', 'semester' => 3],
        ];

        foreach ($data as $row) {
            Mahasiswa::updateOrCreate(['nama' => $row['nama']], $row);
        }
    }
}
