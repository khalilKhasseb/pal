@php
    $locale = app()->getLocale();
    $rtl = $locale === 'ar';
@endphp
<div class="header-top d-flex align-items-center justify-content-end">
    <ul style="margin-{{app()->getLocale() == 'ar' ? 'left' : 'right'}}: auto" class="justify-content-between d-flex">
        @foreach ($items as $item)
            <li class="m{{$rtl ? 'e' : 's'}}-5 justify-content-between align-items-center d-flex top_header_item"
                style="--color:{{ $item['color'] }}">
                <x-icon width="35px" style="fill:var(--color)" name="{{ $item['icon'] }}" />
                <span class="inline-block m{{$rtl ? 'e' : 's'}}-3">{{ $item['title_'.$locale] }}</span>
            </li>
        @endforeach
    </ul>

    <div class="donate-option d-flex justify-content-end" style="background: black">
        {{-- <a href="{{ route('login') }}"><i class="fa fa-heart" aria-hidden="true"></i> {{ __('Login') }}</a>
        @if ($settings->checkout_enabled)
            <a class="" href="{{ route('checkout') }}"><i class="fa fa-heart" aria-hidden="true"></i>
                {{ __('Payment') }}</a>
        @endif --}}
    </div>

    <div style="background-color:#53a92c" class="px-2 py-2 align-self-end">
        <a
            class="font-bold lang-switch d-flex align-items-center justify-content-start text-light"
            href="{{ route('local', ['local' => app()->getLocale() === 'ar' ? 'en' : 'ar']) }}">
            <span style="text-transform: uppercase" class="inline-block px-2">{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}

            </span>
            <i class="fa fa-language" aria-hidden="true"></i>

        </a>
    </div>
    <!-- .donate-option -->
</div>
<!-- .header-top -->
