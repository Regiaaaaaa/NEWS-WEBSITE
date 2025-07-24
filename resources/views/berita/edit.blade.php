@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Edit Berita</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Perbarui informasi berita Anda dengan mudah. Pastikan semua perubahan sesuai dengan yang diinginkan.</p>
        </div>

        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('berita.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 border border-blue-200 rounded-lg hover:bg-blue-200 hover:text-blue-800 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali Ke Berita Saya
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-600 px-8 py-6">
                <h2 class="text-2xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Edit Formulir Berita
                </h2>
                <p class="text-blue-100 mt-2">Lakukan perubahan yang diperlukan pada berita Anda</p>
            </div>

            <!-- Form Body -->
            <form method="POST" action="{{ route('berita.update', $berita) }}" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Title Field -->
                <div class="group">
                    <label for="judul" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 011 1v1a1 1 0 01-1 1h-1v11a3 3 0 01-3 3H7a3 3 0 01-3-3V7H3a1 1 0 01-1-1V5a1 1 0 011-1h4z"></path>
                        </svg>
                        Judul Berita
                    </label>
                    <input 
                        type="text" 
                        id="judul"
                        name="judul" 
                        value="{{ $berita->judul }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white" 
                        placeholder="Masukkan judul berita yang menarik..."
                        required
                    >
                    <div class="mt-2 text-sm text-gray-500">Perbarui judul agar lebih menarik dan informatif</div>
                </div>

                <!-- Content Field -->
                <div class="group">
                    <label for="isi" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Isi Berita
                    </label>
                    <textarea 
                        name="isi" 
                        id="isi"
                        rows="8" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white resize-none" 
                        placeholder="Edit isi berita secara lengkap dan detail..."
                        required
                    >{{ $berita->isi }}</textarea>
                    <div class="mt-2 flex justify-between text-sm text-gray-500">
                        <span>Perbaiki atau tambahkan informasi yang diperlukan</span>
                        <span id="charCount" class="text-blue-600 font-medium">{{ strlen($berita->isi) }} karakter</span>
                    </div>
                </div>

                <!-- Current Image Display -->
                <div class="group">
                    <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Gambar Saat Ini
                    </label>
                    <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200">
                        @if($berita->gambar)
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                     class="max-w-sm h-auto rounded-lg shadow-lg border-2 border-white" 
                                     alt="Current news image">
                                <div class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full shadow-lg">
                                    <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Ada
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-gray-500 italic">Tidak ada gambar saat ini</p>
                                <p class="text-sm text-gray-400 mt-1">Upload gambar baru di bawah</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- New Image Upload Field -->
                <div class="group">
                    <label for="gambar" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        Ganti Gambar Berita
                        <span class="ml-2 text-xs text-gray-500 font-normal">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            name="gambar"
                            id="gambar"
                            class="hidden"
                            accept="image/*"
                            onchange="updateFileName(this)"
                        >
                        <label 
                            for="gambar" 
                            class="flex items-center justify-center w-full px-4 py-6 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 bg-gray-50"
                        >
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="text-sm text-gray-600 font-medium" id="fileText">
                                    Klik untuk upload gambar baru atau drag & drop
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG hingga 10MB</p>
                                @if($berita->gambar)
                                    <p class="text-xs text-blue-600 mt-2 font-medium">Akan mengganti gambar yang ada</p>
                                @endif
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Periksa kembali semua perubahan sebelum menyimpan
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('berita.index') }}" 
                           class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 transition-all duration-200">
                            Batal
                        </a>
                        <button 
                            type="submit" 
                            class="group relative px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl"
                        >
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tips Card -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-800 mb-2">Tips Edit Berita</h3>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li>• Periksa ejaan dan tata bahasa sebelum menyimpan</li>
                        <li>• Pastikan informasi yang diperbarui akurat dan terkini</li>
                        <li>• Jika mengganti gambar, pilih yang berkualitas baik dan relevan</li>
                        <li>• Simpan perubahan secara berkala untuk menghindari kehilangan data</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Character counter for textarea with initial count
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('isi');
    const charCount = document.getElementById('charCount');
    
    // Update character count on input
    textarea.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count + ' karakter';
    });
});

// File name display
function updateFileName(input) {
    const fileText = document.getElementById('fileText');
    if (input.files && input.files[0]) {
        fileText.textContent = 'Gambar baru terpilih: ' + input.files[0].name;
        fileText.parentElement.parentElement.classList.add('border-blue-400', 'bg-blue-50');
        fileText.parentElement.parentElement.classList.remove('border-gray-300', 'bg-gray-50');
    } else {
        fileText.textContent = 'Klik untuk upload gambar baru atau drag & drop';
        fileText.parentElement.parentElement.classList.remove('border-blue-400', 'bg-blue-50');
        fileText.parentElement.parentElement.classList.add('border-gray-300', 'bg-gray-50');
    }
}

// Form submission with loading state
document.querySelector('form').addEventListener('submit', function(e) {
    const submitBtn = document.querySelector('button[type="submit"]');
    submitBtn.innerHTML = `
        <span class="flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        </span>
    `;
    submitBtn.disabled = true;
});
</script>
@endsection