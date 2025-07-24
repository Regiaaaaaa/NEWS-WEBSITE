@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Edit Profil</h2>

        @if (session('status') === 'profile-updated')
            <div class="mb-4 text-green-600">
                Profil berhasil diperbarui!
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between items-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-all">
                    Simpan
                </button>

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Yakin mau hapus akun?')"
                        class="text-red-600 hover:underline text-sm">
                        Hapus Akun
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection
