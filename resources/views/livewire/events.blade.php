@use(Illuminate\Pagination\Paginator)
@php
    $panel = isset(request()->query()['p']) ? request()->query()['p'] : null;

    $current_page =
        empty(request()->query()) || !isset(request()->query()['page']) ? 1 : (int) request()->query()['page'];
    $per_page = 6;

    $offset = $current_page * $per_page - $per_page;

    $totalPages = ceil($events->count() / $per_page);

    $paginiator = app(Paginator::class, ['items' => $events->slice($offset, $per_page), 'perPage' => $per_page]);
    /** this to indicate all pages needed for all itesm in a paginaitor */
    $hasMorePages = $totalPages > $current_page;

    // get Pages for a period of offsets
    // for example if we have
    $paginiator->hasMorePagesWhen($hasMorePages)->withPath(request()->path());
    // dd($paginiator->items())
@endphp
<x-slot name="header">
    <h2>{{ __('Events') }}</h2>
</x-slot>

<div id="root-events-page-component">
    <!-- Start Upcoming Events Section -->
    <section class="bg-event-box">
        <div class="container">
            <div class="row">
                <div class="event-search-box-option">
                    <div class="row">
                        {{-- <div class="col-lg-3 col-sm-6">
                                <div class="event-box">
                                    <div class="form-group">
                                        <label for="date">{{__('events from')}}</label>
                                        <input type="text" class="px-4 form-control" id="date" name="date" placeholder="{{__('Date')}}">
                                    </div>
                                    <!-- .form-group -->
                                </div>
                                <!-- .search-box -->
                            </div> --}}
                        <!-- .col-lg-3 col-sm-6 -->
                        <div class="col-lg-9 col-sm-9">
                            <div class="event-box">
                                <div class="form-group">
                                    <label for="search">{{ __('Search') }}</label>
                                    <input wire:model="searchQuery" type="text" class="px-4 form-control"
                                        id="search" placeholder="{{ __('Keyword') }}">

                                </div>
                                <!-- .form-group -->
                            </div>
                            <!-- .search-box -->
                        </div>
                        <!-- .col-lg-3 col-sm-6 -->
                        {{-- <div class="col-lg-3 col-sm-6">
                                <div class="event-box">
                                    <div class="form-group">
                                        <label for="location">{{__('Location')}}</label>
                                        <input type="text" class="px-4 form-control" id="location" placeholder="{{__('Type to search')}}">
                                    </div>
                                    <!-- .form-group -->
                                </div>
                                <!-- .search-box -->
                            </div> --}}
                        <!-- .col-lg-3 col-sm-6 -->
                        <div class="col-lg-3 col-sm-6">
                            <div class="event-box">
                                <button wire:click="search" class="btn btn-default">{{ __('find events') }}</button>
                            </div>
                            <!-- .search-box -->
                        </div>
                        <!-- .col-lg-3 col-sm-6 -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .event-search-box-option -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>


    <section class="bg-upcoming-events">
        <div class="container">
            <div class="row">
                <div wire:transition class="upcoming-events">
                    <div class="row">
                        @if (count($paginiator->items()) > 0)
                            @foreach ($paginiator->items() as $event)
                                <x-theme.event :event="$event" />
                            @endforeach
                        @elseif(count($paginiator->items()) === 0)
                            @include($skyTheme . '.partial.empty')
                        @endif
                        <!-- .col-lg-6 -->

                        <!-- .col-lg-6 -->
                    </div>
                    <!-- .row -->
                    <x-theme.paginiation.default :paginiator="$paginiator" :total-pages="$totalPages" />
                    {{-- <div class="pagination-option">
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
                        </div> --}}
                    <!-- .pagination_option -->

                </div>
                <!-- .upcoming-events -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>
    <!-- End Upcoming Events Section -->
</div>
