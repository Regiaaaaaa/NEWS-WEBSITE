<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'berita_id', 'isi', 'parent_id'];

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

    public function replies()
{
    return $this->hasMany(Komentar::class, 'parent_id');
}

public function parent()
{
    return $this->belongsTo(Komentar::class, 'parent_id');
}
}
