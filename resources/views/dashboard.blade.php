@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Official WEMINFO</h1>

{{-- Filter Kategori --}}

<div class="flex gap-2 overflow-x-auto mb-4">
    <a href="{{ route('dashboard') }}" 
       class="px-3 py-1 rounded-full text-sm {{ request('kategori') ? 'bg-gray-200' : 'bg-blue-500 text-white' }}">
        Semua
    </a>
    @foreach ($kategoris as $kategori)
        <a href="{{ route('dashboard', ['kategori' => $kategori->id]) }}" 
           class="px-3 py-1 rounded-full text-sm {{ $kategoriId == $kategori->id ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            {{ $kategori->nama }}
        </a>
    @endforeach
</div>

{{-- List Berita --}}
<div class="flex gap-4 overflow-x-auto pb-2">
    @forelse($beritas as $berita)
        <div class="min-w-[250px] w-[250px] bg-white rounded-lg shadow hover:shadow-md transition duration-300 flex-shrink-0">
            @if($berita->gambar)
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="gambar berita"
                     class="w-full h-36 object-cover rounded-t-lg">
            @else
                <div class="w-full h-36 bg-gray-200 flex items-center justify-center text-gray-500 rounded-t-lg">
                    Tidak ada gambar
                </div>
            @endif

            <div class="p-3">

                {{-- Link ke detail berita --}}
                <a href="{{ route('dashboard.berita.show', $berita->id) }}"
                   class="text-blue-600 hover:underline font-semibold text-sm line-clamp-2">
                    {{ $berita->judul }}
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-600">Belum ada berita dengan kategori tersebut</p>
    @endforelse
</div>
@endsection
