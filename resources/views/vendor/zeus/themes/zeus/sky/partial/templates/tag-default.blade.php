

<!-- Start Blog Section -->

<section class="bg-blog-section">
    <div class="container">
        <div class="row">
            <div class="blog-section blog-page">

                <div class="row">

                    @unless ($posts->isEmpty())

                    @each($skyTheme.'.partial.post', $paginiator->items(), 'post')

                    @else


                    @include($skyTheme.'.partial.empty')


                    @endunless
                </div>
                <!-- .row -->
                <x-theme.paginiation.default :paginiator="$paginiator" :total-pages="$totalPages    " />
            </div>
            <!-- .blog-section -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-blog-section -->
</section>
