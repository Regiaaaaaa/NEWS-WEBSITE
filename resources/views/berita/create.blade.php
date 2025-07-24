@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Tulis Berita Baru</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Bagikan informasi terbaru dengan komunitas. Lengkapi formulir di bawah untuk menerbitkan berita Anda.</p>
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
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h2 class="text-2xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Formulir Berita
                </h2>
                <p class="text-blue-100 mt-2">Isi semua informasi yang diperlukan dengan lengkap dan akurat</p>
            </div>

            <!-- Form Body -->
            <form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                
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
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white" 
                        placeholder="Masukkan judul berita yang menarik..."
                        required
                    >
                    <div class="mt-2 text-sm text-gray-500">Buatlah judul yang informatif dan menarik perhatian pembaca</div>
                </div>

                <!-- Category Field -->
                <div class="group">
                    <label for="kategori" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Kategori
                    </label>
                    <div class="relative">
                        <select 
                            name="kategori_id" 
                            id="kategori" 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-gray-800 bg-gray-50 focus:bg-white appearance-none cursor-pointer"
                        >
                            <option value="" disabled selected>Pilih kategori berita...</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $berita->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
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
                        placeholder="Tulis isi berita secara lengkap dan detail..."
                        required
                    ></textarea>
                    <div class="mt-2 flex justify-between text-sm text-gray-500">
                        <span>Jelaskan berita dengan detail dan objektif</span>
                        <span id="charCount" class="text-blue-600 font-medium">0 karakter</span>
                    </div>
                </div>

                <!-- Image Upload Field -->
                <div class="group">
                    <label for="gambar" class="flex items-center text-sm font-semibold text-gray-700 mb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Gambar Berita
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
                                    Klik untuk upload gambar atau drag & drop
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG hingga 10MB</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pastikan semua informasi sudah benar sebelum mengirim
                    </div>
                    <button 
                        type="submit" 
                        class="group relative px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl"
                    >
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Terbitkan Berita
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-800 mb-2">Tips Menulis Berita yang Baik</h3>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li>• Gunakan judul yang jelas dan menarik</li>
                        <li>• Pilih kategori yang sesuai dengan isi berita</li>
                        <li>• Tulis dengan bahasa yang mudah dipahami</li>
                        <li>• Sertakan gambar yang relevan untuk memperkuat berita</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Character counter for textarea
document.getElementById('isi').addEventListener('input', function() {
    const charCount = this.value.length;
    document.getElementById('charCount').textContent = charCount + ' karakter';
});

// File name display
function updateFileName(input) {
    const fileText = document.getElementById('fileText');
    if (input.files && input.files[0]) {
        fileText.textContent = 'File terpilih: ' + input.files[0].name;
        fileText.parentElement.parentElement.classList.add('border-blue-400', 'bg-blue-50');
        fileText.parentElement.parentElement.classList.remove('border-gray-300', 'bg-gray-50');
    } else {
        fileText.textContent = 'Klik untuk upload gambar atau drag & drop';
        fileText.parentElement.parentElement.classList.remove('border-blue-400', 'bg-blue-50');
        fileText.parentElement.parentElement.classList.add('border-gray-300', 'bg-gray-50');
    }
}

// Form validation enhancement
document.querySelector('form').addEventListener('submit', function(e) {
    const submitBtn = document.querySelector('button[type="submit"]');
    submitBtn.innerHTML = `
        <span class="flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menerbitkan...
        </span>
    `;
    submitBtn.disabled = true;
});
</script>
@endsection