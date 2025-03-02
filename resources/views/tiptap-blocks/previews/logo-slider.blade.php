{{-- resources/views/blocks/previews/logo-slider.blade.php --}}

<div class="p-4 border border-gray-200 rounded">
    <div class="flex items-center gap-2 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-500">
            <rect width="18" height="10" x="3" y="7" rx="2" />
            <path d="M7 2v5" />
            <path d="M17 2v5" />
            <path d="M7 17v5" />
            <path d="M17 17v5" />
        </svg>
        <h3 class="text-lg font-medium">{{ $title ?? 'Logo Slider' }}</h3>
    </div>
    
    <div class="flex flex-wrap gap-4 p-3 bg-gray-100 rounded">
        @if(isset($logos) && count($logos) > 0)
            @foreach(array_slice((array)$logos, 0, 4) as $logo)
                <div class="w-16 h-16 bg-white rounded flex items-center justify-center shadow-sm">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="Logo" class="max-w-full max-h-full p-2 object-contain">
                </div>
            @endforeach
            
            @if(count($logos) > 4)
                <div class="w-16 h-16 bg-white rounded flex items-center justify-center shadow-sm">
                    <span class="text-sm text-gray-500">+{{ count($logos) - 4 }} more</span>
                </div>
            @endif
        @else
            <div class="w-16 h-16 bg-white rounded flex items-center justify-center shadow-sm">
                <span class="text-sm text-gray-400">Logo 1</span>
            </div>
            <div class="w-16 h-16 bg-white rounded flex items-center justify-center shadow-sm">
                <span class="text-sm text-gray-400">Logo 2</span>
            </div>
            <div class="w-16 h-16 bg-white rounded flex items-center justify-center shadow-sm">
                <span class="text-sm text-gray-400">Logo 3</span>
            </div>
            <div class="w-16 h-16 bg-white rounded flex items-center justify-center shadow-sm">
                <span class="text-sm text-gray-400">Logo 4</span>
            </div>
        @endif
    </div>
    
    <div class="mt-2 text-xs text-gray-500">
        <div class="flex flex-wrap gap-2">
            <span>{{ $slides_per_view ?? '4' }} per view</span>
            <span>|</span>
            <span>{{ isset($auto_play) && $auto_play ? 'Auto-play enabled' : 'Auto-play disabled' }}</span>
            <span>|</span>
            <span>{{ isset($show_navigation) && $show_navigation ? 'Navigation arrows' : 'No navigation' }}</span>
        </div>
    </div>
</div>