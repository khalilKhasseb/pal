@props(['gallaries' => null])
@use(App\Models\Scopes\ContentProviderScope)
<!-- Start Slider Section -->
@if ($gallaries !== null)
    @php
        #collect all gallary items togther
        $i = [];
        $collectItems = collect();
        $items = $gallaries->map(function ($gallary) {
            return $gallary->getMedia('gallary')->all();
        });

        foreach ($items as $_item) {
            foreach ($_item as $it) {
                $i[] = $it;
            }
        }

        $stickyPosts = \App\Models\Post::withoutGlobalScope(ContentProviderScope::class)
            ->sticky()
            ->get();
    @endphp
    <section class="bg-slider-option">
        <div class="container">

            <div class="slider-option slider-two">
                <div id="HeroContentSlider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @unless ($stickyPosts->isEmpty())
                        
                            @foreach ($stickyPosts as $post)
                                <div class="carousel-item     @if ($loop->first) active @endif" data-bs-interval="10000">
                                    <div class="slider-item">
                                    
                                   @php
                                     
                                   @endphp
                                      @if( $post->getMedia('posts')?->first()?->hasGeneratedConversion('fit-slider'))
                          
                                       <img src="{{$post->getFirstMediaUrl('posts' , 'fit-slider')}}" />
                                      @else
                                        <img src="{{ $post->image() }}" alt="{{ $post->title }}">
                                      @endif
                                        <div class="slider-content-area">
                                            <div class="container">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="text-right slider-content">
                                                            <h3>{{ $post->title }}</h3>
                                                            {{-- <h2>{{ $post->description }}</h2> --}}
                                                            {{-- <p>By Planting Tree Tomorrow!</p> --}}
                                                            <div class="slider-btn">
                                                                <a href="{{ route('post', ['slug' => $post->slug]) }}"
                                                                    class="btn btn-default">{{ __('Vist') }}</a>
                                                                {{-- <a href="donate.html" class="btn btn-default">donate now</a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @endunless
                        @foreach ($i as $item)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="10000">

                                <div class="slider-item">

                                    @if ($item->hasGeneratedConversion('fit-slider'))
                                        <img src="{{ $item->getUrl('fit-slider') }}" />
                                    @else
                                        <img src="{{ $item->getUrl() }}" alt="bg-slider-2">
                                    @endif

                                </div>

                            </div>
                        @endforeach



                    </div>
                    <button class="left carousel-control carousel-control-prev" type="button"
                        data-bs-target="#HeroContentSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="right carousel-control carousel-control-next" type="button"
                        data-bs-target="#HeroContentSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>


        </div>
    </section>
    <!-- End Slider Section -->
@endif
