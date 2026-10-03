{{-- ==================================================================
     resources/views/contact.blade.php
     REQUIREMENT 4 & 5: view untuk route "/contact", data dinamis ($kontak).
     ================================================================== --}}
@extends('layouts.app')

@section('title', 'Kontak - Tugas Rutin 9')

@section('content')
  <p class="text-pink-400 text-xs font-semibold tracking-widest uppercase mb-2">Kontak</p>
  <h1 class="text-3xl font-extrabold mb-6">Hubungi Saya</h1>

  <div class="rounded-xl border border-slate-800 bg-slate-900/60 p-6 mb-6">
    <p class="mb-2"><span class="text-slate-500">Nama:</span> {{ $kontak['nama'] }}</p>
    <p class="mb-2"><span class="text-slate-500">Email:</span>
      <a href="mailto:{{ $kontak['email'] }}" class="text-lime-400 underline">{{ $kontak['email'] }}</a>
    </p>
    <p><span class="text-slate-500">Program Studi:</span> {{ $kontak['prodi'] }}</p>
  </div>

  <h2 class="text-lg font-bold mb-3">Sosial Media</h2>
  {{-- REQUIREMENT 5: array bersarang ($kontak['sosial']) dirender dinamis --}}
  <ul class="space-y-2">
    @foreach ($kontak['sosial'] as $sosmed)
      <li class="flex gap-2 text-sm">
        <span class="text-slate-500 w-24">{{ $sosmed['label'] }}</span>
        <a href="{{ $sosmed['url'] }}" target="_blank" rel="noopener noreferrer" class="text-lime-400 underline">{{ $sosmed['nilai'] }}</a>
      </li>
    @endforeach
  </ul>
@endsection
