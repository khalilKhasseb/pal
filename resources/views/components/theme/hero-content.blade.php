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

<section class="about-section">
    <div class="container">
        <div class="about-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="about-content">
                        <h2 class="section-title">{{ $title }}</h2>
                        <div class="title-underline">
                            <span class="line"></span>
                            <span class="dot"></span>
                            <span class="line"></span>
                        </div>
                        <div class="about-text">
                            <p>{{ $content }}</p>
                        </div>
                        <div class="about-action">
                            <a href="{{ !empty($dest) ? route('page', ['slug' => $dest]) : '#' }}"
                                class="btn btn-primary">
                                <span>{{ __('Learn More') }}</span>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="about-image-container">
                        <div class="image-wrapper">
                            <img src="{{ preg_match('/(http?s)/', $aboutImg) ? $aboutImg : asset("storage/$aboutImg") }}"
                                alt="{{ $title }}" class="about-image" />
                        </div>
                        <div class="image-pattern top-pattern"></div>
                        <div class="image-pattern bottom-pattern"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('styles')
    <style>
        .about-section {
            padding: 80px 0;
            position: relative;
            background-color: var(--light-color, #f9fcf7);
            overflow: hidden;
        }

        .about-wrapper {
            position: relative;
        }

        /* Left Content Column */
        .about-content {
            padding-right: 40px;
        }

        .section-title {
            color: var(--dark-color, #2c3e2e);
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
        }

        .title-underline {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }

        .title-underline .line {
            height: 2px;
            width: 30px;
            background-color: var(--primary-color, #78b843);
        }

        .title-underline .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--primary-color, #78b843);
        }

        .about-text {
            margin-bottom: 30px;
            color: var(--secondary-color, #4a6741);
            font-size: 17px;
            line-height: 1.7;
        }

        .about-text p {
            margin-bottom: 15px;
        }

        .about-action {
            margin-top: 30px;
        }

        .btn-primary {
            background-color: var(--primary-color, #78b843);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(120, 184, 67, 0.25);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover, #68a336);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(120, 184, 67, 0.3);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        /* Right Image Column */
        .about-image-container {
            position: relative;
            padding: 20px;
        }

        .image-wrapper {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            z-index: 2;
        }

        .about-image {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px;
            transition: transform 0.7s ease;
        }

        .image-wrapper:hover .about-image {
            transform: scale(1.03);
        }

        .image-pattern {
            position: absolute;
            border-radius: 10px;
            z-index: 1;
        }

        .top-pattern {
            top: -15px;
            right: -15px;
            width: 60%;
            height: 40%;
            border: 3px solid var(--primary-color, #78b843);
            opacity: 0.4;
        }

        .bottom-pattern {
            bottom: -15px;
            left: -15px;
            width: 60%;
            height: 40%;
            border: 3px solid var(--primary-color, #78b843);
            opacity: 0.4;
        }

        /* RTL Support */
        [dir="rtl"] .about-content {
            padding-right: 0;
            padding-left: 40px;
        }

        [dir="rtl"] .btn-primary i {
            transform: rotate(180deg);
        }

        [dir="rtl"] .top-pattern {
            right: auto;
            left: -15px;
        }

        [dir="rtl"] .bottom-pattern {
            left: auto;
            right: -15px;
        }

        /* Responsive Styles */
        @media (max-width: 991px) {
            .about-section {
                padding: 60px 0;
            }

            .about-content {
                padding-right: 0;
                margin-bottom: 40px;
                text-align: center;
            }

            .title-underline {
                justify-content: center;
            }

            .section-title {
                font-size: 32px;
            }

            [dir="rtl"] .about-content {
                padding-left: 0;
            }
        }

        @media (max-width: 767px) {
            .about-section {
                padding: 50px 0;
            }

            .section-title {
                font-size: 28px;
            }

            .about-text {
                font-size: 16px;
            }

            .about-image-container {
                padding: 10px;
            }
        }
    </style>
@endpush
