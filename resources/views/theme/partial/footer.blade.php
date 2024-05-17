<footer>
    <div class="bg-footer-top">
        <div class="container">
            <div class="row">
                <div class="footer-top">
                    <div class="row">
                        @php
                        $contentbox = App\Models\Widget::location('bottom-footer')->get();

                        @endphp
                        @if(!empty($contentbox) || !is_null($contentbox))
                        @foreach ($contentbox as $box )
                        {{-- @dd($box->component) --}}
                        <div class="col-lg-3 col-sm-6">


                            <x-dynamic-component :component="Str::of('widgets.'.$box->component)" :title="$box->title"
                                :content="$box->content" />
                            <!-- .footer-widgets -->
                        </div>
                        @endforeach

                        @endif
                        <!-- .col-lg-3 -->


                        <!-- .col-lg-3 -->
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widgets">
                                <div class="widgets-title">
                                    <h3>Twitter Widget</h3>
                                </div>
                                <!-- .widgets-title -->
                                <ul class="twitter-widget">
                                    <li>
                                        <div class="twitter-icon"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                                        <div class="twitter-content">
                                            <h5>Raritas etiam processus a theme dynamicus sequitur <a
                                                    href="#">http://admin@gmail.com</a></h5>
                                            <span class="post-date">03 January 2017</span>
                                        </div>
                                        <!-- .twitter-content -->
                                    </li>
                                    <li>
                                        <div class="twitter-icon"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                                        <div class="twitter-content">
                                            <h5>Duis autem vel eum <a href="#">#iriure</a>dolor in hendrerit in
                                                vulputate </h5>
                                            <span class="post-date">8 months ago</span>
                                        </div>
                                        <!-- .twitter-content -->
                                    </li>
                                    <li>
                                        <div class="twitter-icon"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                                        <div class="twitter-content">
                                            <h5><a href="#">@frankdoe</a> am liber tempor cum soluta nobis eleifend</h5>
                                            <span class="post-date">03 January 2017</span>
                                        </div>
                                        <!-- .twitter-content -->
                                    </li>
                                </ul>
                            </div>
                            <!-- .footer-widgets -->
                        </div>
                        <!-- .col-lg-3 -->
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widgets">
                                <div class="widgets-title">
                                    <h3>Recent Photos</h3>
                                </div>
                                <!-- .widgets-title -->
                                <div class="footer-instagram">
                                    <a href="#"><img src="/images/home01/footer-instagram-img-1.jpg"
                                            alt="footer-instagram-img-1" /></a>

                                    <a href="#"><img src="/images/home01/footer-instagram-img-2.jpg"
                                            alt="footer-instagram-img-2" /></a>
                                    <a href="#"><img src="/images/home01/footer-instagram-img-3.jpg"
                                            alt="footer-instagram-img-3" /></a>
                                    <a href="#"><img src="/images/home01/footer-instagram-img-4.jpg"
                                            alt="footer-instagram-img-4" /></a>
                                    <a href="#"><img src="/images/home01/footer-instagram-img-5.jpg"
                                            alt="footer-instagram-img-5" /></a>
                                    <a href="#"><img src="/images/home01/footer-instagram-img-6.jpg"
                                            alt="footer-instagram-img-6" /></a>
                                    <a href="#"><img src="/images/home01/footer-instagram-img-7.jpg"
                                            alt="footer-instagram-img-7" /></a>
                                    <a href="#"><img src="/images/home01/footer-instagram-img-8.jpg"
                                            alt="footer-instagram-img-8" /></a>
                                    <a href="#"><img src="/images/home01/footer-instagram-img-9.jpg"
                                            alt="footer-instagram-img-9" /></a>
                                </div>
                                <!-- .footer-instagram -->
                            </div>
                            <!-- .footer-widgets -->
                        </div>
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