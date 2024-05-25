@use(App\Theme\ThemeRenderNaveItem)
@php
        #$sommodMenu = str_contains(str_replace('/', '', request()->getRequestUri()),'home-sommod' );
       # $handel = $sommodMenu ? 'main-sommod-header-menu'  : 'main-header-menu';
        # $menu = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle($handel);
@endphp
<header class="header-style-2 one-page">
    <div class="bg-header-top">
        <div class="container">
            <div class="row">
                @if (isset($settings) && $settings->top_header_enabled)

                    @include('theme.partial.top-header' , [
                        'items' => $settings->top_header_items
                    ])
                @endif
            </div>
            <!-- .header-top -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-header-top -->

    <!-- Start Menu -->
    <div class="bg-main-menu menu-scroll py-2">
        <div class="container">
            <div class="row">
                <div class="main-menu">
                    <div class="main-menu-bottom">
                        <div class="navbar-header">


                            <x-theme.logo :route="route('theme.home')" :url="$_logo"  />

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
                                                {!! ThemeRenderNaveItem::render($item , $sommod) !!}

                                                @if (count($item['children']) > 0)
                                                    <ul class="sub-menu">
                                                        @foreach ($item['children'] as $child_item)
                                                            <li>
                                                                {!! ThemeRenderNaveItem::render($child_item ,$sommod) !!}

                                                                @if (count($child_item['children']) > 0)
                                                                    <ul class="sub-sub-menu">
                                                                        @foreach ($child_item['children'] as $last_level_child)
                                                                            <li>
                                                                                {!! ThemeRenderNaveItem::render($last_level_child , $sommod) !!}

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
