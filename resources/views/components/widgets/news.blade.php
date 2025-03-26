@use(Illuminate\Support\Str)
@props(['title', 'content'])
<div class="footer-widgets">
    <div class="widgets-title">
        <h3>{{$title}}</h3>
    </div>
    <!-- .widgets-title -->
    <ul class="latest-news">
        @if($content === true)
        @php
        $posts = App\Models\Post::limit(3)
        ->orderBy('published_at', 'desc')
        ->get();
        @endphp
        @if(!is_null($posts) && !empty($posts))
        @foreach ($posts as $post)
        <li>
            <span class="thumbnail-img">
                <img src="{{$post->image()}}" alt="small-bog-img-1" class="img-responsive" />
            </span>
            <div class="thumbnail-content">
                <h5><a href="{{route('post' , $post->slug)}}">
                        {{$post->title}}</a></h5>
                <span class="post-date">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            </div>
            <!-- .thumbnail-content -->
        </li>
        @endforeach

        @endif

        @endif

    </ul>
</div>