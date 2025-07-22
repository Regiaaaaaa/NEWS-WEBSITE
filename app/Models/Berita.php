<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Berita extends Model
{
    use HasFactory;

    /**
     * Atribut yang bisa diisi saat create/update.
     */
    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'gambar',
    ];

    /**
     * Relasi: Berita dimiliki oleh 1 user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentars()
{
    return $this->hasMany(Komentar::class);
}

public function likes()
{
    return $this->hasMany(Like::class);
}

}
