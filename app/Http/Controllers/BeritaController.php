<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
   public function __construct()
   {
       // Pastikan user login untuk semua action kecuali show
       $this->middleware('auth')->except(['show']);
   }

public function index(Request $request)
{
    $query = Berita::query();

    // Kalau ada kategori diklik, filter berdasarkan kategori
    if ($request->has('kategori')) {
        $query->where('kategori_id', $request->kategori);
    }

    // Ambil semua berita terbaru
    $semuaBerita = $query->with('kategori', 'user')->latest()->get();

    // Ambil semua kategori untuk navbar filter
    $kategoris = Kategori::all();

    return view('berita.index', compact('semuaBerita', 'kategoris'));
}

   public function create()
   {
       // Add this line to fetch categories
       $kategoris = Kategori::all();
       return view('berita.create', compact('kategoris'));
   }

   public function store(Request $request)
   {
       $validated = $request->validate([
           'judul' => 'required|max:255',
           'isi' => 'required',
           'kategori_id' => 'required|exists:kategoris,id', // Add validation for kategori_id
           'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
       ]);

       if ($request->hasFile('gambar')) {
           $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
       }

       $validated['user_id'] = Auth::id();
       Berita::create($validated);

       return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
   }

   public function show(Berita $berita)
   {
    
       return view('berita.show', compact('berita'));
   }

   public function edit($id)
   {
       $berita = Berita::findOrFail($id);
       
       // Manual check - hanya pemilik yang bisa edit
       if (auth()->id() !== $berita->user_id) {
           abort(403, 'Anda tidak dapat mengedit berita ini.');
       }
       
       // Add categories for edit form
       $kategoris = Kategori::all();
       return view('berita.edit', compact('berita', 'kategoris'));
   }

   public function update(Request $request, $id)
   {
       $berita = Berita::findOrFail($id);
       
       // Manual check - hanya pemilik yang bisa update
       if (auth()->id() !== $berita->user_id) {
           abort(403, 'Anda tidak dapat mengupdate berita ini.');
       }

       $validated = $request->validate([
           'judul' => 'required|max:255',
           'isi' => 'required',
           'kategori_id' => 'required|exists:kategoris,id', // Add validation for kategori_id
           'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
       ]);

       if ($request->hasFile('gambar')) {
           if ($berita->gambar) {
               Storage::disk('public')->delete($berita->gambar);
           }

           $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
       }

       $berita->update($validated);

       return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate.');
   }

public function destroy(Request $request, $id)
{
    $berita = Berita::findOrFail($id);

    if (auth()->id() !== $berita->user_id) {
        abort(403, 'Anda tidak dapat menghapus berita ini.');
    }

    if ($berita->gambar) {
        Storage::disk('public')->delete($berita->gambar);
    }

    $berita->delete();

    // AJAX response
    if ($request->expectsJson()) {
        return response()->json(['message' => 'Berita berhasil dihapus']);
    }

    return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
}

}