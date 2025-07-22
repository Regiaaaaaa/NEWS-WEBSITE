<?php

namespace App\Policies;

use App\Models\Berita;
use App\Models\User;

class BeritaPolicy
{
    /**
     * Semua user yang login bisa melihat daftar berita.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Semua user bisa melihat berita milik siapa pun.
     */
    public function view(User $user, Berita $berita): bool
    {
        return true;
    }

    /**
     * Semua user yang login boleh membuat berita.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Hanya pemilik berita yang boleh mengedit.
     */
    public function update(User $user, Berita $berita): bool
    {
        return $user->id === $berita->user_id;
    }

    /**
     * Hanya pemilik berita yang boleh menghapus.
     */
    public function delete(User $user, Berita $berita): bool
    {
        return $user->id === $berita->user_id;
    }

    /**
     * Tidak ada user yang bisa restore (kamu bisa ubah nanti kalau pakai soft delete).
     */
    public function restore(User $user, Berita $berita): bool
    {
        return false;
    }

    /**
     * Tidak ada user yang bisa force delete (kamu bisa ubah nanti).
     */
    public function forceDelete(User $user, Berita $berita): bool
    {
        return false;
    }
}
