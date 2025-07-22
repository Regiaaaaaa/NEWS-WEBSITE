@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tulis Berita Baru</h1>
<form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label>Judul</label>
        <input type="text" name="judul" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Isi</label>
        <textarea name="isi" rows="5" class="w-full border p-2 rounded" required></textarea>
    </div>

    <div class="mb-4">
        <label>Gambar</label>
        <input type="file" name="gambar">
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Kirim</button>
</form>
@endsection