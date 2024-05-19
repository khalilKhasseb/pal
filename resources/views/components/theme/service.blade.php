<!-- Start Service Style2 Section -->
@props(['serviceBlocks' => null])
@if ($serviceBlocks !== null)
    <section class="bg-servicesstyle2-section" id="services">
        <div class="container">
            <div class="row">
                <div class="our-services-option">
                    <div class="section-header">
                        <h2>{{__('what we do')}}</h2>
                        <p>{{__('rofessionally mesh enterprise wide imperatives without world class paradigms.Dynamically deliver ubiquitous leadership awesome skills.')}}</p>
                    </div>
                    <!-- .section-header -->
                    <div class="row">
                        @foreach ($serviceBlocks as $service)
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="our-services-box">
                                    <div class="our-services-items">
                                        @if (!is_null($service->icon))
                                            <x-icon width="100px"  name="{{ $service->icon }}" />
                                        @elseif($service->image() !== null)
                                            {{ $service->image() }}
                                        @endif
                                        <div class="our-services-content">
                                            <h4>{{ $service->title }}</h4>
                                            {!! $service->content !!}
                                            {{-- <a href="service_single.html">read more<i class="fa fa-angle-double-right" aria-hidden="true"></i></a> --}}
                                        </div>
                                        <!-- .our-services-content -->
                                    </div>
                                    <!-- .our-services-items -->
                                </div>
                                <!-- .our-services-box -->
                            </div>
                        @endforeach

                        <!-- .col-md-4 -->
                        <!-- .col-md-4 -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .our-services-option -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>
    <!-- End Service Style2 Section -->
@endif
