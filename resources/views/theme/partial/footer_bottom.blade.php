<div class="bg-footer-bottom">
    <div class="container">
        <div class="row">
            <div class="footer-bottom">
                <div class="copyright-txt">
                    <p>&copy; {{date('Y')}}. <span>{{config('app.name')}}</span></p>

                </div>
                <!-- .copyright-txt -->
                <div class="social-box">
                    <ul class="social-icon-rounded">
                        @php
                        $links = App\Models\Widget::location('footer')->type('link')->get();
                        @endphp
                        @if(!is_null($links) && $links->count() > 0)

                        @foreach ($links[0]->content as $link )

                        <li>
                            <x-widgets.link :target="$link['target']" :icon-only="$link['icon_only']"
                                :icon="$link['icon']" />
                        </li>


                        @endforeach

                        @endif

                    </ul>
                </div>
                <!-- .social-box -->

            </div>
            <!-- .footer-bottom -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</div>
<!-- .bg-footer-bottom -->
