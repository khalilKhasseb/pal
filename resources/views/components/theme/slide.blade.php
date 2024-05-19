@props(['gallaries' => null])
<!-- Start Slider Section -->
<section class="bg-slider-option">
    <div class="slider-option slider-two">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if ($gallaries !== null)
                    @foreach ($gallaries as $g)
                        @foreach ($g->getMedia('gallary') as $item)
                            <div class="carousel-item {{$loop->first ? 'active' : ''}}" data-bs-interval="10000">

                                <div class="slider-item">
                                    <img src="{{ $item->getUrl() }}" alt="bg-slider-2">
                                {{-- <div class="slider-content-area">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="slider-content">
                                                        <h3>welcome to green forest</h3>
                                                        <h2>save the world</h2>
                                                        <p>By Planting Tree Tomorrow!</p>
                                                        <div class="slider-btn">
                                                            <a href="#" class="btn btn-default">join now</a>
                                                            <a href="donate.html" class="btn btn-default">donate now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        @endforeach
                    @endforeach

                @endif

            </div>
            <button class="left carousel-control carousel-control-prev" type="button"
                data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="right carousel-control carousel-control-next" type="button"
                data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<!-- End Slider Section -->
