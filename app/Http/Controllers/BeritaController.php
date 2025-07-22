<?php

namespace App\Http\Controllers;

use App\Models\Berita;
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

  public function index()
{
    // Ganti dari semua berita jadi cuma berita user yang login
    $semuaBerita = Berita::where('user_id', auth()->id())->latest()->get();
    return view('berita.index', compact('semuaBerita'));
}

   public function create()
   {
       return view('berita.create');
   }

   public function store(Request $request)
   {
       $validated = $request->validate([
           'judul' => 'required|max:255',
           'isi' => 'required',
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
       
       return view('berita.edit', compact('berita'));
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

   public function destroy($id)
   {
       $berita = Berita::findOrFail($id);
       
       // Manual check - hanya pemilik yang bisa hapus
       if (auth()->id() !== $berita->user_id) {
           abort(403, 'Anda tidak dapat menghapus berita ini.');
       }

       if ($berita->gambar) {
           Storage::disk('public')->delete($berita->gambar);
       }

       $berita->delete();

       return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
   }
}