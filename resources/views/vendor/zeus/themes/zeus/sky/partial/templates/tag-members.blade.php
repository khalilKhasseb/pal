@use(Illuminate\Pagination\Paginator)
@php
$current_page =  !isset(request()->query()['page']) || empty(request()->query()) ? 1 : (int) request()->query()['page'] ;
$per_page = 15;

$offset = ($current_page * $per_page) - $per_page ;

$totalPages = ceil($posts->count()/$per_page) ;

$paginiator = app(Paginator::class, ['items' => $posts->slice($offset,$per_page), 'perPage' =>$per_page]);
/** this to indicate all pages needed for all itesm in a paginaitor */
$hasMorePages = $totalPages > $current_page ;

// get Pages for a period of offsets
// for example if we have
$paginiator->hasMorePagesWhen($hasMorePages)->withPath(request()->path());
// $paginiator->path('blog') ;
@endphp


<x-slot name="header">
    <h2 class="capitalize">{{ $tag->name }}</h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="">
        @php
            $route = request()->is('content/category/*') ? 'blogs' : $tag->type;
            // dd($route);
        @endphp
        <a href="{{ route($route) }}">{{ __((string) str($tag->type)->plural()->ucfirst()) }}</a>
        {{-- @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3 rtl:rotate-180') --}}
    </li>
    <li class="">
        {{ $tag->name }}
    </li>
</x-slot>


<section class="bg-team-section">
    <div class="container">
        <div class="row">
            <div class="volunteers-option">
                <div class="row">
                    @foreach ($posts as $post)
                        <x-theme.team-member-card :member="$post" />
                    @endforeach
                    <!-- .col-lg-3 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .volume-option -->
        </div>
        <!-- .row -->
        <x-theme.paginiation.default :paginiator="$paginiator" :total-pages="$totalPages" />

    </div>
    <!-- .container -->
</section>
