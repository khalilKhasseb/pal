   <!-- Start Sponsors Section -->
   @props(['partners' => null])
   @if($partners !== null)
   <section class="bg-sponsors-section">
    <div class="container">
        <div class="row">
            <div class="sponsors-option">
                <div class="section-header">
                    <h2>{{__('Partners')}}</h2>
                    <p>{{__('Professionally mesh enterprise wide imperatives without world class paradigms.Dynamically deliver ubiquitous leadership awesome skills.')}}</p>
                </div>
                <!-- .section-header -->
                <div class="sponsors-container">
                    <div class="swiper-wrapper">
                        @foreach ($partners as $p )
                        <div class="swiper-slide">
                            <div class="sopnsors-items">
                                <a href="{{route('partner.view' , ['slug' => $p->slug])}}"><img src="{{$p->getMedia('posts')[0]->getUrl()}}" alt="sponsors-img-1" class="img-responsive" /></a>
                            </div>
                            <!-- .sponsors-items -->
                        </div>

                        @endforeach
                        <!-- .swiper-slide -->

                    </div>
                    <!-- .swiper-wrapper -->
                </div>
                <!-- .sponsors-container -->
            </div>
            <!-- .sponsors-option -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
@endif
<!-- End Sponsors Section -->
