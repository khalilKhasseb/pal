<!-- Start Blog Section -->
@use(Illuminate\Pagination\Paginator)
@use(Illuminate\Support\Str)
@php

// santize request uri

#remove all conent after path uri
#take query paramer panel and store it in a variable to use later
#clear request uri

// $panel = isset(request()->query()['p']) ? request()->query()['p'] : null ;
// dd($posts);
#clear reqeust uri from
$page_title = preg_replace('([?].*)' , '',request()->getRequestUri() ) ;
$page_title = str_replace('/' , '' , $page_title);
#
$current_page = empty(request()->query()) || !isset(request()->query()['page']) ? 1 : (int) request()->query()['page'] ;

$per_page = 6;
$offset = ($current_page * $per_page) - $per_page ;

$totalPages = ceil($posts->count()/$per_page) ;

$paginiator = app(Paginator::class, ['items' => $posts->slice($offset,$per_page), 'perPage' =>$per_page]);
// dd($paginiator->items() , $posts);
/** this to indicate all pages needed for all itesm in a paginaitor */
$hasMorePages = $totalPages > $current_page ;

// get Pages for a period of offsets
// for example if we have
$paginiator->hasMorePagesWhen($hasMorePages)->withPath(request()->path());

@endphp

<x-slot name="header">
    <h2>{{$page_title == 'content' ?  __('All News') : __(ucfirst(Str::plural($page_title)))}}</h2>
</x-slot>
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
                <x-theme.paginiation.default :paginiator="$paginiator" :total-pages="$totalPages" />
            </div>
            <!-- .blog-section -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-blog-section -->
</section>
