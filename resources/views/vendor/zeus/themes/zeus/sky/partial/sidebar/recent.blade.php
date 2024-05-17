<div class="widget">
    <h4 class="sidebar-widget-title">{{__('Popular News')}}</h4>
    <div class="widget-content">
        <ul class="popular-news-option">

            @foreach ($recent as $post )


            <li>
                @if($post->image() !== null)
                <div class="popular-news-img" style="width:100px;height:90px10">

                    <a href="{{route('post',$post->slug)}}">
                        <img alt="{{ $post->title }}"
                            src="{{ $post->image() }}" /></a>
                </div>
                <!-- .popular-news-img -->
                @endif
                <div class="popular-news-contant">
                    <h5><a href="{{route('post' , $post->slug)}}">{{$post->title}}</a></h5>
                    <p>{{optional($post->published_at)->diffForHumans()}}</p>
                </div>
                <!-- .popular-news-img -->
            </li>
            @endforeach
        </ul>

    </div>
    <!-- .widget-content -->
</div>
{{-- @unless($recent->isEmpty())
<div class="my-4">
    <h4 class="mb-4 text-xl font-bold text-gray-700 dark:text-gray-200">{{ __('Recent Post') }}</h4>
    <div
        class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white dark:bg-gray-800 rounded-[2rem] ltr:rounded-br-none rtl:rounded-bl-none shadow-md">
        @foreach($recent as $post)
        <a href="{{ route('post',$post->slug) }}"
            class="border-b border-t border-white hover:border-primary-600 transition duration-300 px-1 py-4">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                @if($post->image() !== null)
                <img alt="{{ $post->title }}" src="{{ $post->image() }}"
                    class="h-6 w-6 shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover" />
                @endif
                <div class="w-full text-lg">{{ $post->title ?? '' }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endunless --}}
