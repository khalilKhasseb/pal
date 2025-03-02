{{-- resources/views/livewire/logo-slider-block.blade.php --}}

<div
    x-data="{
        swiper: null,
        init() {
            this.swiper = new Swiper($refs.container, {
                slidesPerView: {{ $slidesPerView }},
                spaceBetween: 30,
                loop: true,
                autoplay: {{ $autoPlay ? 'true' : 'false' }},
                ...({{ $autoPlay ? 'true' : 'false' }} && {
                    autoplay: {
                        delay: {{ $autoPlaySpeed }},
                        disableOnInteraction: false,
                    }
                }),
                navigation: {
                    enabled: {{ $showNavigation ? 'true' : 'false' }},
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    enabled: {{ $showPagination ? 'true' : 'false' }},
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: Math.min(2, {{ $slidesPerView }}),
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: Math.min(3, {{ $slidesPerView }}),
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: {{ $slidesPerView }},
                        spaceBetween: 30,
                    },
                },
            });
        }
    }"
    class="logo-slider-component relative mb-8"
    wire:ignore
>
    @if($title)
        <h3 class="text-xl font-medium text-center mb-6">{{ $title }}</h3>
    @endif
    
    <div class="swiper-container" x-ref="container">
        <div class="swiper-wrapper">
            @foreach($logos as $logo)
                <div class="swiper-slide">
                    <div class="h-24 flex items-center justify-center p-4 bg-white border border-gray-100 rounded shadow-sm">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="Partner Logo" class="max-h-full max-w-full object-contain">
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($showPagination)
            <div class="swiper-pagination mt-4"></div>
        @endif
        
        @if($showNavigation)
            <div class="swiper-button-prev absolute left-0 top-1/2 z-10 -ml-4 transform -translate-y-1/2"></div>
            <div class="swiper-button-next absolute right-0 top-1/2 z-10 -mr-4 transform -translate-y-1/2"></div>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
@endpush