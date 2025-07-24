@props(['komentar', 'berita', 'level' => 0])

@php
    $jumlahBalasan = $komentar->replies ? $komentar->replies->count() : 0;
    $jumlahLikes = $komentar->likes ? $komentar->likes->count() : 0;
    $isLiked = auth()->check() && $komentar->likes && $komentar->likes->where('user_id', auth()->id())->count() > 0;
@endphp

<div class="ml-{{ $level * 6 }} {{ $level > 0 ? 'mt-3' : 'mt-6' }}">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200 p-5">
        
        {{-- Header dengan Avatar dan Info User --}}
        <div class="flex items-start gap-3 mb-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-lg">
                    {{ strtoupper(substr($komentar->user->name, 0, 1)) }}
                </div>
            </div>
            
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 flex-wrap">
                    <h4 class="font-semibold text-gray-900 text-sm">{{ $komentar->user->name }}</h4>
                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded-full">
                        {{ $komentar->created_at->diffForHumans() }}
                    </span>
                    @if($level == 0)
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-600 text-xs rounded-full font-medium">
                            OP
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Konten Komentar --}}
        <div class="ml-13">
            <div class="prose prose-sm max-w-none mb-4">
                <p class="text-gray-800 leading-relaxed">{{ $komentar->isi }}</p>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 mb-4">
                {{-- Like Button --}}
                <button class="flex items-center gap-2 px-3 py-1.5 rounded-full transition-all duration-200 hover:bg-red-50 group {{ $isLiked ? 'text-red-500' : 'text-gray-500' }}">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="{{ $isLiked ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="text-sm font-medium">{{ $jumlahLikes }}</span>
                </button>

                {{-- Reply Button --}}
                @auth
                <button onclick="toggleReply('reply-{{ $komentar->id }}')" class="flex items-center gap-2 px-3 py-1.5 rounded-full text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                    <span class="text-sm font-medium">Balas</span>
                </button>
                @endauth

                {{-- Share Button --}}
                <button class="flex items-center gap-2 px-3 py-1.5 rounded-full text-gray-500 hover:bg-green-50 hover:text-green-600 transition-all duration-200 group">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                    </svg>
                    <span class="text-sm font-medium">Bagikan</span>
                </button>
            </div>

            {{-- Reply Form (Hidden by default) --}}
            @auth
            <div id="reply-{{ $komentar->id }}" class="hidden bg-gray-50 rounded-xl p-4 border-l-4 border-blue-400">
                <form action="{{ route('berita.komentar.store', $berita) }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                    
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-semibold text-xs flex-shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <textarea 
                                name="isi" 
                                rows="3" 
                                class="w-full border-0 bg-white rounded-xl p-3 text-sm resize-none focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm" 
                                placeholder="Tulis balasan yang membangun..."
                                required></textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-2 ml-11">
                        <button 
                            type="button" 
                            onclick="toggleReply('reply-{{ $komentar->id }}')"
                            class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors duration-200">
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium text-sm rounded-full hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>
            @endauth

            {{-- Replies Section --}}
            @if ($jumlahBalasan > 0)
            <div class="mt-4 pt-4 border-t border-gray-100">
                <button 
                    onclick="toggleReplies('replies-{{ $komentar->id }}')" 
                    class="flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors duration-200">
                    <svg class="w-4 h-4 transition-transform duration-200" id="arrow-{{ $komentar->id }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                    <span>Lihat {{ $jumlahBalasan }} {{ Str::plural('balasan', $jumlahBalasan) }}</span>
                </button>
                
                <div id="replies-{{ $komentar->id }}" class="hidden mt-4 space-y-1">
                    @foreach($komentar->replies as $reply)
                        <x-komentar :komentar="$reply" :berita="$berita" :level="$level + 1" />
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- JavaScript untuk interaktivitas --}}
@if($level == 0)
<script>
function toggleReply(elementId) {
    const element = document.getElementById(elementId);
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden');
        element.querySelector('textarea').focus();
    } else {
        element.classList.add('hidden');
    }
}

function toggleReplies(elementId) {
    const element = document.getElementById(elementId);
    const arrow = document.getElementById('arrow-' + elementId.split('-')[1]);
    
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden');
        arrow.style.transform = 'rotate(180deg)';
    } else {
        element.classList.add('hidden');
        arrow.style.transform = 'rotate(0deg)';
    }
}

// Auto-resize textarea
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea[name="isi"]');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});

// Like animation effect
document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('button[class*="hover:bg-red-50"]');
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const heart = this.querySelector('svg');
            heart.classList.add('animate-pulse');
            setTimeout(() => {
                heart.classList.remove('animate-pulse');
            }, 600);
        });
    });
});
</script>
@endif