@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Kategori</h1>
                    <p class="text-gray-600">Perbarui informasi kategori "{{ $kategori->nama }}"</p>
                </div>
                <a href="{{ route('kategori.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Edit Informasi Kategori</h2>
            </div>
            
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="p-6 space-y-6" id="editForm">
                @csrf
                @method('PUT')
                
                <!-- Nama Kategori Field -->
                <div class="space-y-2">
                    <label for="nama" class="block text-sm font-medium text-gray-700">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="nama"
                               name="nama" 
                               value="{{ old('nama', $kategori->nama) }}"
                               placeholder="Masukkan nama kategori"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('nama') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                               required>
                        
                        <!-- Icon -->
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Error Message -->
                    @error('nama')
                        <p class="text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                    
                    <!-- Original Value Display -->
                    @if(old('nama') && old('nama') != $kategori->nama)
                        <p class="text-sm text-gray-500">
                            Nilai asli: <span class="font-medium">{{ $kategori->nama }}</span>
                        </p>
                    @endif
                    
                    <!-- Help Text -->
                    <p class="text-sm text-gray-500">
                        Nama kategori harus unik dan mudah diingat
                    </p>
                </div>

                <!-- Change Detection Alert -->
                <div id="changeAlert" class="hidden bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-yellow-800 mb-1">Perubahan Terdeteksi</h3>
                            <p class="text-sm text-yellow-700">
                                Data telah dimodifikasi. Pastikan untuk menyimpan perubahan Anda.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('kategori.index') }}" 
                       class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200 shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update Kategori
                    </button>
                </div>
            </form>
        </div>

        <!-- Tips Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-blue-800 mb-1">Tips Mengedit Kategori</h3>
                    <p class="text-sm text-blue-700">
                        Pastikan nama kategori tetap unik dan mudah dipahami. Perubahan akan mempengaruhi semua data yang menggunakan kategori ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editForm');
        const namaInput = document.getElementById('nama');
        const changeAlert = document.getElementById('changeAlert');
        
        // Store original values
        const originalValues = {
            nama: '{{ $kategori->nama }}'
        };
        
        // Auto focus pada input nama
        namaInput.focus();
        namaInput.select();
        
        // Check for changes
        function checkForChanges() {
            const hasChanges = namaInput.value !== originalValues.nama;
            
            if (hasChanges) {
                changeAlert.classList.remove('hidden');
            } else {
                changeAlert.classList.add('hidden');
            }
        }
        
        // Add event listeners
        namaInput.addEventListener('input', checkForChanges);
        
        // Form validation
        form.addEventListener('submit', function(e) {
            if (namaInput.value.trim() === '') {
                e.preventDefault();
                namaInput.focus();
                namaInput.classList.add('border-red-500');
                return;
            }
            
            // Confirmation for significant changes
            if (namaInput.value !== originalValues.nama) {
                if (!confirm('Anda akan mengubah nama kategori dari "' + originalValues.nama + '" menjadi "' + namaInput.value + '". Lanjutkan?')) {
                    e.preventDefault();
                    return;
                }
            }
        });
        
        // Remove error styling on input
        namaInput.addEventListener('input', function() {
            this.classList.remove('border-red-500');
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+S to save
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                form.submit();
            }
        });
    });
</script>
@endpush
@endsection