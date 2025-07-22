<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'berita_id', 'isi'];

    // Relasi ke User (komentar dibuat oleh user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Berita (komentar milik berita tertentu)
    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
