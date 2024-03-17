<div class="header-top">
    <ul class="flex justify-between">
        @foreach ($header_settings->top_header_items as $item )


        <li class="flex items-center justify-between top_header_item" style="--color:{{$item['color']}}">
            <x-icon name="{{$item['icon']}}" />
            <span>{{$item['item']}}</span>
        </li>
        {{--
        <li><i class="flaticon-vibrating-phone"></i> Phone : +88017 923 970 659</li> --}}
        {{-- <li><i class="flaticon-placeholder"></i> Address : Sute 07 Sahara Center</li> --}}
        @endforeach
    </ul>
    <div class="donate-option">
        <a href="#"><i class="fa fa-heart" aria-hidden="true"></i> {{__('Subscribe')}}</a>
    </div>
    <!-- .donate-option -->
</div>
<!-- .header-top -->