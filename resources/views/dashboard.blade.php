@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard</h1>

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
                <a href="{{ route('dashboard.berita.show', $berita->id) }}"
                   class="text-blue-600 hover:underline font-semibold text-sm line-clamp-2">
                    {{ $berita->judul }}
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-600">Belum ada berita tersedia.</p>
    @endforelse
</div>
@endsection
