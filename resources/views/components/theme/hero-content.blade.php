@props(['contentSettings'])
@php
    $sommod = session()->has('somoud_load');
    $s = 's';
    $c = 'c';
    $title = $sommod ? __('About Sommod Project') : __('About Council');
    $local = app()->getLocale();
    $content = $sommod ? $contentSettings[$s . '_about_' . $local] : $contentSettings[$c . '_about_' . $local];
    $aboutImg = $sommod 
    ? (filled($contentSettings[$s . '_about_img']) 
        ? $contentSettings[$s . '_about_img'] 
        : config('theme.cabout'))
    : (filled($contentSettings[$c . '_about_img']) 
        ? $contentSettings[$c . '_about_img'] 
        : config('theme.cabout'));


    $dest = $sommod ? $contentSettings['s_destintaion'] : $contentSettings['c_destintaion'];


@endphp
{{-- @dd($contentSettings) --}}
<section class="bg-about-greenforest">
    <div class="container">
        <div class="about-greenforest">
            <div class="row">
                <div class="col-lg-8">
                    <div class="about-greenforest-content">
                        <h2>{{ $title }}</h2>
                        <p>{{ $content }}</p>
                        <a href="{{ !empty($dest) ? route('page', ['slug' => $dest]) : '#' }}" class="btn btn-default">{{ __('More') }}</a>
                    </div>
                    <!-- .about-greenforest-content -->
                </div>
                <!-- .col-lg-8 -->
                <div class="col-lg-4">
                    <div class="about-greenforest-img">
                        <img src="{{ preg_match('/(http?s)/', $aboutImg) ? $aboutImg : asset("storage/$aboutImg") }}" alt="about-greenforest-img" class="img-fluid" />
                    </div>
                    <!-- .about-greenforest-img -->
                </div>
                <!-- .col-lg-4 -->
            </div>
            <!-- .row -->
        </div>
        <!-- .about-greenforest -->
    </div>
    <!-- .container -->
</section>