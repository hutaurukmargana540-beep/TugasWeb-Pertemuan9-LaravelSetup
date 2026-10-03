{{-- ==================================================================
     resources/views/about.blade.php
     REQUIREMENT 4 & 5: view untuk route "/about", data dinamis ($tentang)
     REQUIREMENT 6: menampilkan data dari Model Mahasiswa (Eloquent).
     ================================================================== --}}
@extends('layouts.app')

@section('title', 'Tentang - Tugas Rutin 9')

@section('content')
  <p class="text-pink-400 text-xs font-semibold tracking-widest uppercase mb-2">Tentang</p>
  <h1 class="text-3xl font-extrabold mb-4">{{ $tentang['judul'] }}</h1>
  <p class="text-slate-300 leading-relaxed mb-10">{{ $tentang['isi'] }}</p>

  {{-- Data dari Tugas Mandiri 1 (array dari controller, dirender dengan perulangan Blade) --}}
  <h2 class="text-lg font-bold mb-4">Pendidikan</h2>
  <div class="space-y-3 mb-10">
    @foreach ($pendidikan as $edu)
      <div class="rounded-xl border border-slate-800 bg-slate-900/60 p-4">
        <p class="text-pink-400 text-xs uppercase tracking-widest mb-1">{{ $edu['label'] }}</p>
        <p class="font-bold">{{ $edu['nama'] }}</p>
        <p class="text-sm text-slate-400">{{ $edu['ket'] }}</p>
      </div>
    @endforeach
  </div>

  <h2 class="text-lg font-bold mb-4">Keahlian</h2>
  <div class="flex flex-wrap gap-2 mb-10">
    @foreach ($keahlian as $skill)
      <span class="rounded-full border border-slate-700 bg-slate-900/60 px-4 py-1 text-sm">{{ $skill }}</span>
    @endforeach
  </div>

  <h2 class="text-lg font-bold mb-4">Proyek</h2>
  <div class="grid gap-4 sm:grid-cols-3 mb-10">
    @foreach ($proyek as $p)
      <div class="rounded-xl border border-slate-800 bg-slate-900/60 p-5">
        <p class="font-bold mb-2">{{ $p['judul'] }}</p>
        <p class="text-sm text-slate-400 mb-3">{{ $p['isi'] }}</p>
        <span class="text-xs text-lime-400">{{ $p['tag'] }}</span>
      </div>
    @endforeach
  </div>

  <h2 class="text-lg font-bold mb-4">Prestasi &amp; Pengalaman</h2>
  <ul class="list-disc list-inside space-y-1 text-slate-300 mb-10">
    @foreach ($prestasi as $item)
      <li>{{ $item }}</li>
    @endforeach
  </ul>

  <h2 class="text-lg font-bold mb-4">Data Mahasiswa (dari database, via Eloquent Model)</h2>

  <div class="rounded-xl border border-slate-800 overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-slate-900 text-slate-400 uppercase text-xs">
        <tr>
          <th class="text-left px-4 py-3">Nama</th>
          <th class="text-left px-4 py-3">Program Studi</th>
          <th class="text-left px-4 py-3">Semester</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($mahasiswaList as $mhs)
          <tr class="border-t border-slate-800">
            <td class="px-4 py-3 font-medium">{{ $mhs->nama }}</td>
            <td class="px-4 py-3 text-slate-400">{{ $mhs->program_studi }}</td>
            <td class="px-4 py-3 text-slate-400">{{ $mhs->semester }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="px-4 py-6 text-center text-slate-500">
              Belum ada data. Jalankan <code class="text-lime-400">php artisan migrate --seed</code> dulu.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
