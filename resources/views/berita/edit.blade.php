@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Berita</h1>
<form method="POST" action="{{ route('berita.update', $berita) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Judul</label>
        <input type="text" name="judul" value="{{ $berita->judul }}" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Isi</label>
        <textarea name="isi" rows="5" class="w-full border p-2 rounded" required>{{ $berita->isi }}</textarea>
    </div>

    <div class="mb-4">
        <label>Gambar Saat Ini:</label><br>
        @if($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-48 my-2">
        @else
            <p>Tidak ada gambar</p>
        @endif
    </div>

    <div class="mb-4">
        <label>Ganti Gambar</label>
        <input type="file" name="gambar">
    </div>

    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
