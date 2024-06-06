<div class="header-top d-flex align-items-center justify-content-end">
    <ul style="margin-left: auto" class="justify-content-between d-flex">
        @foreach ($items as $item)
            <li class="ms-2 justify-content-between align-items-center d-flex top_header_item"
                style="--color:{{ $item['color'] }}">
                <x-icon width="30px" style="fill:var(--color)" name="{{ $item['icon'] }}" />
                <span>{{ $item['item'] }}</span>
            </li>
        @endforeach
    </ul>

    <div  class="donate-option d-flex justify-content-end" style="background: black">
        {{-- <a href="{{ route('login') }}"><i class="fa fa-heart" aria-hidden="true"></i> {{ __('Login') }}</a>
        @if ($settings->checkout_enabled)
            <a class="" href="{{ route('checkout') }}"><i class="fa fa-heart" aria-hidden="true"></i>
                {{ __('Payment') }}</a>
        @endif --}}
    </div>

    <div style="width:30px" class="py-1 align-seld-end">
        <a class="btn btn-default" href="{{ route('local', ['local' => app()->getLocale() === 'ar' ? 'en' : 'ar']) }}">
            {{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}
        </a>
    </div>
    <!-- .donate-option -->
</div>
<!-- .header-top -->
