@props(['contentSettings'])
@php
    $sommod = session()->has('sommod_load');
    $s = 's';
    $c = 'c';
    $title = $sommod ? __('About Sommod Project') : __('About Council');
    $local = app()->getLocale();
    $content = $sommod ? $contentSettings[$s . '_about_' . $local] : $contentSettings[$c . '_about_' . $local];
    $aboutImg = $sommod ? $contentSettings[$s . '_about_img'] : $contentSettings[$c . '_about_img'];

    $dest = $sommod ? $contentSettings['s_destintaion'] : $contentSettings['c_destintaion'];

    dd($dest);
@endphp
{{-- @dd($contentSettings) --}}
<section class="bg-about-greenforest">
    <div class="container">
        <div class="row">
            <div class="about-greenforest">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="about-greenforest-content">

                            <h2>{{ $title }}
                            </h2>
                            <p>
                                {{ $content }}
                            </p>
                            <a href="{{route('post', ['slug' => $dest])}}" class="btn btn-default">{{ __('More') }}</a>
                            {{-- <a href="#" class="btn btn-default">{{ __('Join us') }}</a> --}}
                        </div>
                        <!-- .about-greenforest-content -->
                    </div>
                    <!-- .col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="about-greenforest-img">
                            <img src="{{ asset("storage/$aboutImg") }}" alt="about-greenforet-img"
                                class="img-responsive" />
                        </div>
                        <!-- .about-greenforest-img -->
                    </div>
                    <!-- .col-md-4 -->
                </div>
            </div>
            <!-- .about-greenforest -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
