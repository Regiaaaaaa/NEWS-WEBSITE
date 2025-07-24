@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

    {{-- Tombol Kembali --}}
    <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mb-4 inline-block">&larr; Kembali ke Dashboard</a>

    {{-- Judul --}}
    <h1 class="text-2xl font-bold mb-4">{{ $berita->judul }}</h1>

    {{-- Gambar --}}
    @if($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="gambar berita"
             class="w-full h-auto max-h-[400px] object-cover rounded mb-4">
    @endif

    {{-- Info penulis --}}
    <p class="text-sm text-gray-500 mb-2">
        Ditulis oleh: {{ $berita->user->name }} | {{ $berita->created_at->format('d-m-Y H:i') }}
    </p>

    {{-- Konten --}}
    <div class="text-gray-800 leading-relaxed mb-6">
        {!! nl2br(e($berita->isi)) !!}
    </div>

    {{-- Like --}}
    <form action="{{ route('berita.like', $berita) }}" method="POST" class="mb-6">
        @csrf
        <button type="submit" class="text-blue-500 hover:underline">
            👍 Suka ({{ $berita->likes->count() }})
        </button>
    </form>

    {{-- Komentar --}}
    <div class="border-t pt-4">
        <h2 class="text-xl font-bold mb-4">Komentar</h2>

        @auth
        {{-- Form komentar utama --}}
        <form action="{{ route('berita.komentar.store', $berita) }}" method="POST" class="mb-4">
            @csrf
            <textarea name="isi" rows="3" class="w-full border rounded p-2 mb-2" placeholder="Tulis komentar..."></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
        </form>
        @else
        <p class="text-sm text-gray-600 mb-4">
            Silakan <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> untuk menulis komentar.
        </p>
        @endauth

        {{-- Komentar & Balasan rekursif --}}
        @foreach($berita->komentars->where('parent_id', null) as $komentar)
            <x-komentar :komentar="$komentar" :berita="$berita" :level="0" />
        @endforeach

    </div>
</div>
@endsection
