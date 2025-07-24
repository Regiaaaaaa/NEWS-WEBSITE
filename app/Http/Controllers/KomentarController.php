<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Komentar;

class KomentarController extends Controller
{
    public function store(Request $request, Berita $berita)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:komentars,id',
        ]);

        $berita->komentars()->create([
            'user_id' => auth()->id(),
            'isi' => $request->isi,
            'parent_id' => $request->parent_id, // Tambahkan parent_id
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
