<!-- Start Blog Section -->
<section class="bg-blog-section">
    <div class="container">
        <div class="row">
            <div class="blog-section blog-page">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">

                        @unless ($posts->isEmpty())

                        @each($skyTheme.'.partial.post', $posts, 'post')
                        @else
                        @include($skyTheme.'.partial.empty')

                        @endunless
                        <!-- .blog-items -->
                    </div>
                    <!-- .col-md-4 -->
                </div>
                <!-- .row -->
                <div class="pagination-option">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- .pagination_option -->
            </div>
            <!-- .blog-section -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-blog-section -->
</section>
<!-- End Blog Section -->


{{-- <div>
    @unless($stickies->isEmpty())
    <section class="mt-10 grid @if($stickies->count() > 1) grid-cols-3 @endif gap-4">
        @foreach($stickies as $post)
        @include($skyTheme.'.partial.sticky')
        @endforeach
    </section>
    @endunless

    <main class="flex flex-col sm:flex-row justify-between mx-auto gap-3 md:gap-6 px-3 md:px-6 py-4 md:py-8">
        <section class="w-full sm:w-2/3 lg:w-3/4">
            @if(request()->filled('search'))
            <div class="py-4">
                {{ __('Showing Search result of') }}: <span class="highlight">{{ request('search') }}</span>
                <a title="{{ __('clear') }}" href="{{ route('blogs') }}">
                    @svg('heroicon-o-backspace','text-primary-500 dark:text-primary-100 w-4 h-4 inline-flex
                    align-middle')
                </a>
            </div>
            @endif

            @unless ($posts->isEmpty())
            <h1 class="text-xl font-bold text-gray-700 dark:text-gray-100 md:text-2xl">{{ __('Posts') }}</h1>
            @each($skyTheme.'.partial.post', $posts, 'post')
            @else
            @include($skyTheme.'.partial.empty')
            @endunless
        </section>
        <nav class="w-full sm:w-1/3 lg:w-1/4">
            @include($skyTheme.'.partial.sidebar')
        </nav>
    </main>
</div> --}}