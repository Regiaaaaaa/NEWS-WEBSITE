<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;

class DashboardController extends Controller
{
 public function index(Request $request)
{
    $kategoriId = $request->query('kategori');

    // ✅ Tampilkan semua berita, bukan hanya berita milik user
    $beritas = Berita::query()
        ->when($kategoriId, fn($q) => $q->where('kategori_id', $kategoriId))
        ->latest()
        ->take(10)
        ->get();

    $kategoris = Kategori::all();
    $totalKategori = $kategoris->count();

    return view('dashboard', compact('beritas', 'totalKategori', 'kategoris', 'kategoriId'));
}


}
