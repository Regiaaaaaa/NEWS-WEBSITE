<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
class KomentarController extends Controller
{
   public function store(Request $request, Berita $berita)
{
    $request->validate([
        'isi' => 'required|string|max:1000',
    ]);

    $berita->komentars()->create([
        'user_id' => auth()->id(),
        'isi' => $request->isi,
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan.');
}


}
