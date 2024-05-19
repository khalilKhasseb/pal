   <!-- Start Recent Project Section -->
   @props(['posts'])
   <section class="bg-recent-project">
    <div class="container">
        <div class="row">
            <div class="recent-project">
                <div class="section-header">
                    <h2>{{__('Recent Post')}}</h2>
                    <p>مجلس الفلسطيني للأبنية الخضراء هو مؤسسة أهلية غير حكومية وغير ربحية تأسست منتصف العام 2011، وهو جزء من المجلس العالمي للأبنية الخضراء وشبكة مجالس الشرق الأوسط وشمال أفريقيا MENA.</p>
                </div>
                <!-- .section-header -->

                {{-- <div id="filters" class="button-group ">
                    <button class="button is-checked" data-filter="*">show all</button>
                    <button class="button" data-filter=".cat-1">environment</button>
                    <button class="button" data-filter=".cat-2">recycling</button>
                    <button class="button" data-filter=".cat-3">ecology</button>
                    <button class="button" data-filter=".cat-4">climate</button>
                </div> --}}
                <div class="portfolio-items">
                @if($posts !== null)
                @foreach ($posts as $post )
                    
                    <div class="item cat-1" data-category="transition">
                        <div class="item-inner">
                            <div class="portfolio-img">
                                <div class="overlay-project"></div>
                                <!-- .overlay-project -->
                                <img src="{{$post->image()}}" alt="recent-project-img-1">
                                <ul class="project-link-option">
                                    <li class="project-link"><a href="project_single.html"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    <li class="project-search"><a href="images/home02/recent-project-img-1.jpg" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!-- /.portfolio-img -->
                            <div class="recent-project-content">
                                <h4><a  href={{route('post' , ['slug' => $post->slug])}}>{!! Str::substr($post->title, 0, 30) !!}</a></h4>
                                <p>{{__('Posted by')}} : <span><a href="#">{{$post->author->name}}</a></span></p>
                            </div>
                            <!-- .latest-port-content -->
                        </div>
                        <!-- .item-inner -->
                    </div>
                    <!-- .items -->
                @endforeach
                    @endif

                    {{-- <div class="item cat-2 " data-category="metalloid">
                        <div class="item-inner">
                            <div class="portfolio-img">
                                <div class="overlay-project"></div>
                                <!-- .overlay-project -->
                                <img src="images/home02/recent-project-img-2.jpg" alt="recent-project-img-2">
                                <ul class="project-link-option">
                                    <li class="project-link"><a href="project_single.html"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    <li class="project-search"><a href="images/home02/recent-project-img-2.jpg" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!-- /.portfolio-img -->
                            <div class="recent-project-content">
                                <h4><a href="project_single.html">Helping Young Planting</a></h4>
                                <p>By : <span><a href="#">Green Forest</a></span></p>
                            </div>
                            <!-- .latest-port-content -->
                        </div>
                        <!-- .item-inner -->
                    </div>
                    <!-- .items -->

                    <div class="item cat-3 " data-category="post-transition">
                        <div class="item-inner">
                            <div class="portfolio-img">
                                <div class="overlay-project"></div>
                                <!-- .overlay-project -->
                                <img src="images/home02/recent-project-img-3.jpg" alt="recent-project-img-3">
                                <ul class="project-link-option">
                                    <li class="project-link"><a href="project_single.html"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    <li class="project-search"><a href="images/home02/recent-project-img-3.jpg" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!-- /.portfolio-img -->
                            <div class="recent-project-content">
                                <h4><a href="project_single.html">Need Solar Panels</a></h4>
                                <p>By : <span><a href="#">Green Forest</a></span></p>
                            </div>
                            <!-- .latest-port-content -->
                        </div>
                        <!-- .item-inner -->
                    </div>
                    <!-- .items -->

                    <div class="item cat-2" data-category="post-transition">
                        <div class="item-inner">
                            <div class="portfolio-img">
                                <div class="overlay-project"></div>
                                <!-- .overlay-project -->
                                <img src="images/home02/recent-project-img-4.jpg" alt="recent-project-img-4">
                                <ul class="project-link-option">
                                    <li class="project-link"><a href="project_single.html"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    <li class="project-search"><a href="images/home02/recent-project-img-4.jpg" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!-- /.portfolio-img -->
                            <div class="recent-project-content">
                                <h4><a href="project_single.html">Save The Ozone Layer</a></h4>
                                <p>By : <span><a href="#">Green Forest</a></span></p>
                            </div>
                            <!-- .latest-port-content -->
                        </div>
                        <!-- .item-inner -->
                    </div>
                    <!-- .items -->
                    <div class="item cat-4" data-category="transition">
                        <div class="item-inner">
                            <div class="portfolio-img">
                                <div class="overlay-project"></div>
                                <!-- .overlay-project -->
                                <img src="images/home02/recent-project-img-5.jpg" alt="recent-project-img-5">
                                <ul class="project-link-option">
                                    <li class="project-link"><a href="project_single.html"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    <li class="project-search"><a href="images/home02/recent-project-img-5.jpg" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!-- /.portfolio-img -->
                            <div class="recent-project-content">
                                <h4><a href="project_single.html">Save Water From Polution</a></h4>
                                <p>By : <span><a href="#">Green Forest</a></span></p>
                            </div>
                            <!-- .latest-port-content -->
                        </div>
                        <!-- .item-inner -->
                    </div>
                    <!-- .items -->
                    <div class="item cat-1" data-category="alkali">
                        <div class="item-inner">
                            <div class="portfolio-img">
                                <div class="overlay-project"></div>
                                <!-- .overlay-project -->
                                <img src="images/home02/recent-project-img-6.jpg" alt="recent-project-img-6">
                                <ul class="project-link-option">
                                    <li class="project-link"><a href="project_single.html"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                    <li class="project-search"><a href="images/home02/recent-project-img-6.jpg" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!-- /.portfolio-img -->
                            <div class="recent-project-content">
                                <h4><a href="project_single.html">Make Plants Alive</a></h4>
                                <p>By : <span><a href="#">Green Forest</a></span></p>
                            </div>
                            <!-- .latest-port-content -->
                        </div>
                        <!-- .item-inner -->
                    </div> --}}
                    <!-- .items -->
                </div>
                <!-- .isotope-items -->
            </div>
            <!-- .recent-project -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Recent Project Section -->
