@extends('layouts.app') {{-- Navbar dashboard --}}

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow relative">

    {{-- Tombol kembali --}}
    <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mb-4 inline-block">
        ← Kembali ke Dashboard
    </a>

    {{-- Judul --}}
    <h1 class="text-2xl font-bold mb-2">{{ $berita->judul }}</h1>

    {{-- Info penulis di pojok kanan atas --}}
    <div class="absolute top-4 right-6 text-sm text-gray-500 text-right bg-white bg-opacity-80 px-3 py-1 rounded">
        Ditulis oleh: {{ $berita->user->name }}<br>
        {{ $berita->created_at->format('d-m-Y H:i') }}
    </div>

    {{-- Gambar --}}
    @if($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="gambar"
             class="w-full h-auto rounded mb-4 max-h-[400px] object-cover">
    @endif

    {{-- Isi berita --}}
    <div class="text-gray-800 leading-relaxed">
        {!! nl2br(e($berita->isi)) !!}
    </div>
</div>
@endsection
