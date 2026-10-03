<?php

// ====================================================================
// app/Http/Controllers/HomeController.php
// Dibuat dengan: php artisan make:controller HomeController
// REQUIREMENT 4 & 5: 3 route custom, masing-masing mengirim data
//                    dinamis (array) ke Blade view.
// ====================================================================

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Route "/" -> halaman beranda.
     * REQUIREMENT 5: data dinamis berupa array dikirim dari route/controller.
     */
    public function index(): View
    {
        $profil = [
            'nama'     => 'Hardiman G. Hutauruk',
            'panggilan'=> 'Hardiman / Hardi / Diman',
            'prodi'    => 'Ilmu Komputer · Semester 3',
            'kampus'   => 'Universitas Negeri Medan',
            'minat'    => 'Coding & Web Development',
            'matkul'   => 'Pemrograman Web',
            'tugas'    => 'Tugas Rutin 9 — Setup Laravel',
        ];

        $menu = [
            ['judul' => 'Beranda', 'url' => '/', 'deskripsi' => 'Halaman utama aplikasi'],
            ['judul' => 'Tentang', 'url' => '/about', 'deskripsi' => 'Profil, pendidikan, keahlian, proyek, dan prestasi'],
            ['judul' => 'Kontak', 'url' => '/contact', 'deskripsi' => 'Cara menghubungi saya'],
        ];

        return view('home', [
            'profil' => $profil,
            'menu'   => $menu,
        ]);
    }

    /**
     * Route "/about".
     * REQUIREMENT 5: array data ditampilkan secara dinamis di view (foreach),
     * sekaligus REQUIREMENT 6: memanfaatkan Model (Eloquent) hasil
     * `php artisan make:model Mahasiswa -m`.
     */
    public function about(): View
    {
        $tentang = [
            'judul' => 'Tentang Saya',
            'isi'   => 'Saya adalah mahasiswa Program Studi Ilmu Komputer Universitas Negeri Medan '
                . 'yang memiliki ketertarikan pada pemrograman dan pengembangan teknologi. '
                . 'Saya senang mempelajari HTML, CSS, C++, Java, dan JavaScript serta menerapkannya '
                . 'dalam berbagai proyek. Di luar kegiatan akademik, saya senang bermain sepak bola '
                . 'dan mengembangkan kemampuan melalui coding.',
        ];

        // Data dari Tugas Mandiri 1 (Web Portofolio), dikirim sebagai array ke view.
        $pendidikan = [
            ['label' => 'Saat ini',                    'nama' => 'Universitas Negeri Medan',          'ket' => 'Program Studi Ilmu Komputer · Semester 3'],
            ['label' => 'Pendidikan menengah',         'nama' => 'SMA Negeri 1 Sipoholon',            'ket' => 'Pendidikan Sekolah Menengah Atas'],
            ['label' => 'Pendidikan menengah pertama', 'nama' => 'SMP Negeri 1 Sipoholon',            'ket' => 'Pendidikan Sekolah Menengah Pertama'],
            ['label' => 'Pendidikan dasar',            'nama' => 'SD Negeri 177032 Hutauruk Parjulu', 'ket' => 'Pendidikan Sekolah Dasar'],
        ];

        $keahlian = ['HTML', 'CSS', 'C++', 'Java', 'JavaScript'];

        $proyek = [
            ['judul' => 'Web PageRank',                'tag' => 'Algorithm',       'isi' => 'Website untuk menerapkan dan menampilkan konsep algoritma PageRank dalam menganalisis tingkat kepentingan halaman.'],
            ['judul' => 'Web Prediksi Cryptocurrency', 'tag' => 'Web Development', 'isi' => 'Website yang berfokus pada data cryptocurrency dan analisis untuk memberi gambaran pergerakan aset digital.'],
            ['judul' => 'Prediksi Status Kesehatan',   'tag' => 'Technology',      'isi' => 'Proyek berbasis web yang mengolah input pengguna dan menghasilkan prediksi status berdasarkan data yang tersedia.'],
        ];

        $prestasi = [
            'Debater Terbaik',
            'Pradana — Organisasi Pramuka Sakawira Kartika',
            'Juara 1 Sepakbola Bupati Cup',
            'Juara 5 Lari Maraton Zetun Cup',
            'Juara 3 Lari Maraton Tiba Festival Run',
        ];

        // Ambil data dari tabel mahasiswas (hasil make:model -m + seeder).
        // Dibungkus try/catch supaya halaman tetap jalan sebelum migrate dijalankan,
        // dan menunjukkan data tetap "dinamis" (bisa kosong / bisa berisi dari DB).
        try {
            $mahasiswaList = Mahasiswa::orderBy('nama')->get();
        } catch (\Throwable $e) {
            $mahasiswaList = collect();
        }

        return view('about', [
            'tentang'       => $tentang,
            'pendidikan'    => $pendidikan,
            'keahlian'      => $keahlian,
            'proyek'        => $proyek,
            'prestasi'      => $prestasi,
            'mahasiswaList' => $mahasiswaList,
        ]);
    }

    /**
     * Route "/contact".
     * REQUIREMENT 5: array data dinamis.
     */
    public function contact(): View
    {
        $kontak = [
            'nama'   => 'Hardiman G. Hutauruk',
            'email'  => 'hardimanhutauruk42@gmail.com',
            'prodi'  => 'Ilmu Komputer · Universitas Negeri Medan',
            'sosial' => [
                ['label' => 'WhatsApp',  'nilai' => '081385992391',          'url' => 'https://wa.me/6281385992391'],
                ['label' => 'GitHub',    'nilai' => 'hutaurukmargana540-beep', 'url' => 'https://github.com/hutaurukmargana540-beep'],
                ['label' => 'Instagram', 'nilai' => '@hardimanhutauruk',     'url' => 'https://www.instagram.com/hardimanhutauruk'],
            ],
        ];

        return view('contact', [
            'kontak' => $kontak,
        ]);
    }

    /**
     * BONUS: route parameter -> /hello/{nama}
     */
    public function hello(string $nama): View
    {
        $sapaan = [
            'nama'  => ucwords($nama),
            'waktu' => now()->translatedFormat('l, d F Y H:i'),
        ];

        return view('hello', [
            'sapaan' => $sapaan,
        ]);
    }
}
