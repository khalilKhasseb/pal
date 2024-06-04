<div class="header-top d-flex align-items-center justify-content-between">
    <ul class="justify-content-between d-flex">
        @foreach ($items as $item)
            <li class="ms-2 justify-content-between align-items-center d-flex top_header_item"
                style="--color:{{ $item['color'] }}">
                <x-icon width="30px" style="fill:var(--color)" name="{{ $item['icon'] }}" />
                <span>{{ $item['item'] }}</span>
            </li>
        @endforeach
    </ul>

    <div class="donate-option" style="background: black">
        <a href="{{ route('login') }}"><i class="fa fa-heart" aria-hidden="true"></i> {{ __('Login') }}</a>
        @if ($settings->checkout_enabled)
            <a class="" href="{{ route('checkout') }}"><i class="fa fa-heart" aria-hidden="true"></i>
                {{ __('Payment') }}</a>
        @endif
    </div>
    <!-- .donate-option -->
</div>
<!-- .header-top -->
