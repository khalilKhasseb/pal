@use(App\Theme\ThemeRenderNaveItem)
@use(LaraZeus\Sky\SkyPlugin)
@php
    $footerMenus = SkyPlugin::get()->getModel('Navigation')::where('handle', 'like', '%footer-%')->get();
@endphp
<footer>
    <div class="bg-footer-top">
        <div class="container">
            <div class="row">
                <div class="footer-top">
                    <div class="row">
                        @php
                            $contentbox = App\Models\Widget::location('bottom-footer')
                            ->orderBy('order')
                            ->limit(4)
                            ->get();

                        @endphp
                       
                       
                        @if (!empty($contentbox) || !is_null($contentbox))
                            @foreach ($contentbox as $box)
                                {{-- @dd($box->component) --}}
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <x-dynamic-component :component="Str::of('widgets.' . $box->component)" :title="$box->title" :content="$box->content" />
                                    <!-- .footer-widgets -->
                                </div>
                            @endforeach

                        @endif


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
