@use(App\Theme\ThemeRenderNaveItem)

<footer>
    <div class="bg-footer-top">
        <div class="container">
            <div class="row">
                <div class="footer-top">
                    <div class="row">
                        @php
                            $contentbox = App\Models\Widget::location('bottom-footer')->get();

                        @endphp

                      

                        @foreach($footerMenus as $menu)
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widgets">
                                {{-- <div class="widgets-title">
                                    <h3>Recent Photos</h3>
                                </div> --}}
                                <!-- .widgets-title -->
                                <ul class="pages-menu">
                                    @foreach ($menu->items as $item)
                                    <li>
                                        {!! ThemeRenderNaveItem::render($item , false , 'text-white h5  ') !!}
                                    </li>
                                    @endforeach


                                </ul> <!-- .footer-instagram -->
                            </div>
                            <!-- .footer-widgets -->
                        </div>
                        @endforeach
                        @if (!empty($contentbox) || !is_null($contentbox))
                            @foreach ($contentbox as $box)
                                {{-- @dd($box->component) --}}
                                <div class="col-lg-3 col-sm-6 col-12">


                                    <x-dynamic-component :component="Str::of('widgets.' . $box->component)" :title="$box->title" :content="$box->content" />
                                    <!-- .footer-widgets -->
                                </div>
                            @endforeach

                        @endif

                        <!-- .col-lg-3 -->


                        <!-- .col-lg-3 -->

                        <!-- .col-lg-3 -->
                        {{--
                             --}}
                        <!-- .col-lg-3 -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .footer-top -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-footer-top -->

    @include('theme.partial.footer_bottom')

</footer>
