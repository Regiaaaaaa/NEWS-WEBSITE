<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
class LikeController extends Controller
{
    public function toggle(Berita $berita)
{
    $user = auth()->user();

    if ($berita->likes()->where('user_id', $user->id)->exists()) {
        $berita->likes()->where('user_id', $user->id)->delete();
    } else {
        $berita->likes()->create([
            'user_id' => $user->id,
        ]);
    }

    return back();
}

}
