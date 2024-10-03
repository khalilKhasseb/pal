@use(App\Theme\ThemeRenderNaveItem)
<header class="header-style-2 one-page">
    <div class="bg-header-top">
        <div class="container">
            <div class="row">
                @if (isset($header_settings) && $header_settings->top_header_enabled)
                    @include('theme.partial.top-header', [
                        'items' => $header_settings->top_header_items,
                    ])
                @endif
            </div>
            <!-- .header-top -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-header-top -->

    <!-- Start Menu -->
    <div class="py-2 bg-main-menu menu-scroll">
        <div class="container">
            <div class="row">
                <div class="main-menu">
                    <div class="main-menu-bottom">
                        <div class="navbar-header">

                            @if (session()->has('somoud_load'))
                                <x-theme.logo :route="route('front.somoud.home')" :url="$_logo" />
                            @else
                                <x-theme.logo :route="route('theme.home')" :url="$_logo" />
                            @endif
                            <button type="button" class="navbar-toggler collapsed d-lg-none" data-bs-toggle="collapse"
                                data-bs-target="#bs-example-navbar-collapse-1"
                                aria-controls="bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="navbar-toggler-icon">
                                    <i class="fa fa-bars"></i>
                                </span>
                            </button>
                        </div>
                        <div class="main-menu-area">

                            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                                <ul>

                                    @isset($menu)
                                        @foreach ($menu->items as $item)
                                            <li>
                                                {!! ThemeRenderNaveItem::render($item, $sommod) !!}

                                                @if (count($item['children']) > 0)
                                                    <ul class="sub-menu">
                                                        @foreach ($item['children'] as $child_item)
                                                            <li>
                                                                {!! ThemeRenderNaveItem::render($child_item, $sommod) !!}

                                                                @if (count($child_item['children']) > 0)
                                                                    <ul class="sub-sub-menu">
                                                                        @foreach ($child_item['children'] as $last_level_child)
                                                                            <li>
                                                                                {!! ThemeRenderNaveItem::render($last_level_child, $sommod) !!}

                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach

                                    @endisset

                                    @if ($settings->checkout_enabled)
                                        <li>
                                            <a href="{{ route('checkout') }}">{{ __('Payment') }}</a>
                                        </li>
                                    @endif

                                    @if (!$header_settings->top_header_enabled)
                                        <li><a
                                                href="{{ route('local', ['local' => app()->getLocale() === 'ar' ? 'en' : 'ar']) }}">
                                                {{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}
                                            </a></li>
                                    @endif
                                </ul>

                                <div class="menu-right-option pull-right">

                                    {{-- <div class="search-box">
                                        <i class="fa fa-search first_click" aria-hidden="true"
                                            style="display: block;"></i>
                                        <i class="fa fa-times second_click" aria-hidden="true"
                                            style="display: none;"></i>
                                    </div> --}}
                                    <div class="search-box-text">
                                        <form action="search">
                                            <input type="text" name="search" id="all-search"
                                                placeholder="Search Here">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .bg-main-menu -->
</header>
