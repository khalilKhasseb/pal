@props([
'title',
'content'
])

@php
foreach ($content as $key => $value) {
$content[$value['type']] = $value['data'][$value['type']] ;
unset($content[$key]);
}
@endphp


<div class="footer-widgets">

    <div class="widgets-title">
        <h3>{{$title}}</h3>
    </div>
    <!-- .widgets-title -->


    <div class="widgets-content">
        {{-- <p>Distily enable team driven services through extensive is a relatonships platforms
            with interactive content. Enthusiastically scale effective.</p> --}}
        {!! $content['richText'] !!}
    </div>
    <!-- .widgets-content -->
    @if(!empty($content['icons']))
    <div class="address-box">
        <ul class="address">
            @foreach ($content['icons'] as $icon )
            <li @style([ 'display:flex' , 'justify-items:center' , 'align-items:center' ])>
                {{-- <i class="fa fa-home" aria-hidden="true"></i> --}}
                {{-- <span>New Chokoya Road, USA.</span> --}}
                <x-icon :name="$icon['icon']" @style(['color:'.$icon['color']]) @class(['p-2']) />
                <span> {{$icon['title']}}</span>
            </li>
            @endforeach


        </ul>
    </div>
    @endif
    <!-- .address -->
</div>