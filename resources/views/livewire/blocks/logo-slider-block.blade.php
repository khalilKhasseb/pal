{{-- resources/views/livewire/logo-slider-block.blade.php --}}

{{-- resources/views/livewire/logo-slider-block.blade.php --}}

<div class="logo-slider-component relative mb-8" wire:ignore>
    @if ($title)
        <h3 class="text-xl font-medium text-center mb-6">{{ $title }}</h3>
    @endif

    <div class="swiper-container logo-slider-container relative">
        <div class="swiper-wrapper">
            @foreach ($logos as $logo)
                <div class="swiper-slide">
                    <div
                        class="h-24 flex items-center justify-center p-4 bg-white border border-gray-100 rounded shadow-sm">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="Partner Logo"
                            class="max-h-full max-w-full object-contain">
                    </div>
                </div>
            @endforeach
        </div>

        @if ($showPagination)
            <div class="swiper-pagination logo-slider-pagination mt-4"></div>
        @endif

        @if ($showNavigation)
            <div class="swiper-button-prev logo-slider-prev"></div>
            <div class="swiper-button-next logo-slider-next"></div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Make sure Swiper is loaded
            if (typeof Swiper === 'undefined') {
                // Load Swiper if not available
                const swiperCss = document.createElement('link');
                swiperCss.rel = 'stylesheet';
                swiperCss.href = 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css';
                document.head.appendChild(swiperCss);

                const swiperScript = document.createElement('script');
                swiperScript.src = 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js';
                document.body.appendChild(swiperScript);

                swiperScript.onload = initSwiper;
            } else {
                initSwiper();
            }

            function initSwiper() {
                const swiperConfig = {
                    slidesPerView: {{ $slidesPerView }},
                    spaceBetween: 30,
                    loop: true,
                    speed: 800,

                    // Navigation
                    navigation: {
                        nextEl: '.logo-slider-next',
                        prevEl: '.logo-slider-prev',
                    },

                    // Pagination
                    pagination: {
                        el: '.logo-slider-pagination',
                        clickable: true,
                    },

                    // Responsive breakpoints
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
                    }
                };

                // Add autoplay config if enabled
                if ({{ $autoPlay ? 'true' : 'false' }}) {
                    swiperConfig.autoplay = {
                        delay: {{ $autoPlaySpeed }},
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true
                    };
                }

                // If navigation or pagination should be disabled
                if (!{{ $showNavigation ? 'true' : 'false' }}) {
                    swiperConfig.navigation = {
                        enabled: false
                    };
                }

                if (!{{ $showPagination ? 'true' : 'false' }}) {
                    swiperConfig.pagination = {
                        enabled: false
                    };
                }

                console.log('Initializing Swiper with config:', swiperConfig);

                // Initialize the swiper
                const swiper = new Swiper('.logo-slider-container', swiperConfig);

                console.log('Swiper instance created:', swiper);
            }
        });
    </script>
    <style>
        /* Fix navigation arrow positioning */
        .logo-slider-container .swiper-button-prev,
        .logo-slider-container .swiper-button-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
            color: #333;
        }

        .logo-slider-container .swiper-button-prev {
            left: -20px;
        }

        .logo-slider-container .swiper-button-next {
            right: -20px;
        }

        /* Fix pagination dot styling */
        .logo-slider-container .swiper-pagination {
            position: static;
            margin-top: 15px;
        }

        .logo-slider-container .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background-color: #ccc;
        }

        .logo-slider-container .swiper-pagination-bullet-active {
            background-color: #333;
        }
    </style>

</div>
@push('scripts_comp')
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
@endpush
