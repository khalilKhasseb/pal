@use(Illuminate\Support\Str)
<x-slot name="header">
    <h2 class="capitalize">{{ $post->title }}</h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="">
    @php
        #generate dynmic breadcrumbs based on post type 
        $collection = ucfirst($post->post_type) ;
        #plural collection 
        $plural = Str::plural($collection) ;
        $route = $post->post_type === 'post' ? 'blogs' : $post->post_type
    @endphp
        <a href="{{ route($route) }}">{{ __($plural) }}</a>
        {{-- @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3 rtl:rotate-180') --}}
    </li>
    <li class="">
        {{ $post->title }}
    </li>
</x-slot>


<section class="bg-single-blog">

    <div class="container">
        <div class="row">
            <div class="single-blog">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-items">
                            @if ($post->image() !== null)
                                <div class="blog-img position-relative">

                                    {{-- <img src="{{$post->image()}}" alt="{{$post->title}}" class="img-responsive" /> --}}
                                    {{ $post->getFirstMedia('posts') }}
                                    @if ($post->post_type === 'event')
                                        <div class="date-box">
                                            <h3>{{ $post->published_at->locale(app()->getLocale())->day }}</h3>
                                            <h5>{{ $post->published_at->locale(app()->getLocale())->monthName }}</h5>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <!-- .blog-img -->
                            <div class="blog-content-box">
                                <div class="meta-box">
                                    <div class="event-author-option">
                                        <div class="event-author-img">
                                            <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}"
                                                alt="avatar" />
                                        </div>
                                        <!-- .author-img -->
                                        <div class="event-author-name">
                                            <p>{{ __('Posted by') }} : <a
                                                    href="#">{{ $post->author->name ?? '' }}</a></p>
                                        </div>
                                        <!-- .author-name -->
                                    </div>
                                    <!-- .author-option -->
                                    <ul class="meta-post">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ optional($post->published_at)->diffForHumans() ?? '' }}
                                            <!-- 22.04.2017 -->
                                        </li>
                                        <li x-data="{
                                            likes: @js($post->likes),
                                            post_id: @js($post->id),
                                            liked: @js($post->checkIfHasLikeForThisIp(request()->getClientIp())),
                                            like_post() {
                                                axios.get('{{ route('ajax.like_post', $post->slug) }}')
                                                    .then(r => {
                                                        console.log(r)
                                                        if (r.data) this.likes = r.data.likes
                                                    })
                                                    .catch(e => console.log(e))
                                            }
                                        
                                        }">
                                            <button x-on:click="console.log(1)" class="btn-transperent">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i> <span
                                                    x-text="likes === null ? 0 : likes"></span>
                                            </button>

                                        </li>
                                        {{-- <li><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i> 24
                                                Comment</a></li> --}}
                                    </ul>
                                </div>
                                <!-- .meta-box -->
                                <div class="blog-content">
                                    <h4>{{ $post->title }}</h4>

                                    {!! $post->getContent() !!}

                                    @if (!is_null($post->post_meta))

                                        <div style="float:none !important" class="single-date-option mt-2">
                                            <ul class="single-date">
                                                @foreach ($post->post_meta as $meta)
                                                    <li class="d-flex justify-items-start">
                                                    @if($meta->icon !== null || !empty($meta->icon))
                                                        <x-icon class="ps-2" width="20px" color="green"
                                                            name="{{ $meta->icon }}" />
                                                            @endif

                                                        <span>{{ $meta->key }} : {{ $meta->value }} </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <!-- .blog-content -->
                                <div class="single-blog-bottom">
                                    <ul class="tags">
                                        <li><i class="fa fa-tags" aria-hidden="true"></i> {{ __('Tags') }} :</li>
                                        @unless ($post->tags->isEmpty())
                                            @foreach ($post->tags->where('type', 'tag') as $tag)
                                                @include($skyTheme . '.partial.tag')
                                            @endforeach
                                        @endunless
                                    </ul>
                                    <!-- .author-option -->
                                    <div class="event-share-option">
                                        <ul class="social-icon share-icon">
                                            <li><i class="fa fa-share-alt"
                                                    aria-hidden="true"></i><span>{{ __('share') }}
                                                    :</span></li>
                                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-google-plus"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-pinterest-p"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- .share-option -->
                                </div>
                                <!-- .single-blog-bottom -->
                            </div>
                            <!-- .blog-content-box -->
                        </div>

                        <div class="comments-option" x-data="{
                            comments: @js($post->comments)
                        }">
                            <h4 class="comments-title"> {{ strtoupper(__('comments')) }}
                                {{ $post->comments->count() !== 0 ? '-' . $post->comments->count() : '' }}</h4>

                            @foreach ($post->comments as $comment)
                                @if (!empty($comment->comment) && !empty($comment->comment))
                                    <div class="comments-items">
                                        <div class="comments-image">
                                            <img src="{{ config('theme.defaultCommentAuthorImage') }}"
                                                alt="comments-author-img" />
                                        </div>
                                        <!-- .comments-image -->
                                        <div class="comments-content">
                                            <div class="comments-author-title">
                                                <div class="comments-author-name">
                                                    <h4><a href="#">{{ $comment->name }}</a> -
                                                        <small>{{ optional($comment->created_at)->diffForHumans() }}</small>
                                                    </h4>
                                                </div>
                                                {{-- <div class="reply-icon">
                                            <h6><i class="fa fa-reply-all"></i><a href="#"> Reply</a></h6>
                                        </div> --}}
                                            </div>
                                            <!-- .comments-author-title -->
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                        <!-- .comments-content -->
                                    </div>
                                    <!-- .comments-items -->
                                @endif
                            @endforeach

                        </div>
                        <!-- .comments-option -->

                        @livewire('comment', ['post' => $post])
                    </div>

                    <div class="col-lg-4">

                        @include($skyTheme . '.partial.sidebar')
                        {{-- <div class="sidebar">



                            <div class="widget">
                                <h4 class="sidebar-widget-title">All Categores</h4>
                                <div class="widget-content">
                                    <ul class="catagories">
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Brand Creation <span>05</span></a></li>
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Company Analysis <span>06</span></a></li>
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Corporate Identity<span>07</span></a></li>
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Funding<span>08</span></a></li>
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Medical<span>15</span></a></li>
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Strategy Planning<span>20</span></a></li>
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Uncategorized<span>25</span></a></li>
                                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                Video Production<span>30</span></a></li>

                                    </ul>
                                </div>
                                <!-- .widget-content -->
                            </div>
                            <!-- .widget -->
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Popular News</h4>
                                <div class="widget-content">
                                    <ul class="popular-news-option">
                                        <li>
                                            <div class="popular-news-img">
                                                <a href="#"><img src="images/event/popular-news-img-1.jpg"
                                                        alt="popular-news-img-1" /></a>
                                            </div>
                                            <!-- .popular-news-img -->
                                            <div class="popular-news-contant">
                                                <h5><a href="#">Foulate revlunry a mihare awesome the theme.</a>
                                                </h5>
                                                <p>04 February 2016</p>
                                            </div>
                                            <!-- .popular-news-img -->
                                        </li>
                                        <li>
                                            <div class="popular-news-img">
                                                <a href="#"><img src="images/event/popular-news-img-2.jpg"
                                                        alt="popular-news-img-2" /></a>
                                            </div>
                                            <!-- .popular-news-img -->
                                            <div class="popular-news-contant">
                                                <h5><a href="#">Foulate revlunry a mihare awesome the theme.</a>
                                                </h5>
                                                <p>04 February 2016</p>
                                            </div>
                                            <!-- .popular-news-img -->
                                        </li>
                                        <li>
                                            <div class="popular-news-img">
                                                <a href="#"><img src="images/event/popular-news-img-3.jpg"
                                                        alt="popular-news-img-3" /></a>
                                            </div>
                                            <!-- .popular-news-img -->
                                            <div class="popular-news-contant">
                                                <h5><a href="#">Foulate revlunry a mihare awesome the theme.</a>
                                                </h5>
                                                <p>04 February 2016</p>
                                            </div>
                                            <!-- .popular-news-img -->
                                        </li>
                                    </ul>

                                </div>
                                <!-- .widget-content -->
                            </div>
                            <!-- .widget -->
                            <div class="widget">
                                <h4 class="sidebar-widget-title">photo gallery</h4>
                                <div class="widget-content">
                                    <div class="gallery-instagram">
                                        <a href="#"><img src="images/event/photo-gallery-small-img-1.jpg"
                                                alt="photo-gallery-small-img-1"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-2.jpg"
                                                alt="footer-instagram-img-2"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-3.jpg"
                                                alt="footer-instagram-img-3"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-4.jpg"
                                                alt="footer-instagram-img-4"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-5.jpg"
                                                alt="footer-instagram-img-5"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-6.jpg"
                                                alt="footer-instagram-img-6"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-7.jpg"
                                                alt="footer-instagram-img-7"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-8.jpg"
                                                alt="footer-instagram-img-8"></a>
                                        <a href="#"><img src="images/event/photo-gallery-small-img-9.jpg"
                                                alt="footer-instagram-img-9"></a>

                                    </div>
                                    <!-- .gallery-instagram -->
                                </div>
                                <!-- .widget-content -->
                            </div>
                            <!-- .widget -->
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Popular Tags</h4>
                                <div class="widget-content">
                                    <div class="tag-cloud">
                                        <a href="#" class="btn">children</a>
                                        <a href="#" class="btn">school</a>
                                        <a href="#" class="btn">shop</a>
                                        <a href="#" class="btn">water</a>
                                        <a href="#" class="btn">charity</a>
                                        <a href="#" class="btn">heaven</a>
                                        <a href="#" class="btn">Blog</a>
                                        <a href="#" class="btn">Contant</a>
                                        <a href="#" class="btn">Design</a>
                                    </div>
                                    <!-- .tag-cloud -->
                                </div>
                                <!-- .widget-content -->
                            </div>
                            <!-- .widget -->
                        </div> --}}
                        <!-- .sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- @if ($post->image() !== null)
    <img alt="{{ $post->title }}" src="{{ $post->image() }}"
        class="my-10 w-full h-full shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover" />
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-[2rem] rounded-tl-none shadow-md px-10 pb-6">
        <div class="flex items-center justify-between">
            <span class="font-light text-gray-600 dark:text-gray-200">{{
                optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @unless ($post->tags->isEmpty())
                @each($skyTheme.'.partial.category', $post->tags->where('type','category'), 'category')
                @endunless
            </div>
        </div>

        <div class="flex flex-col items-start justify-start gap-4">
            <div>
                <a href="#" class="text-2xl font-bold text-gray-700 dark:text-gray-100 hover:underline">
                    {{ $post->title ?? '' }}
                </a>
                <p class="mt-2 text-gray-600 dark:text-gray-200">
                    {{ $post->description ?? '' }}
                </p>
                <div>
                    @unless ($post->tags->isEmpty())
                    @foreach ($post->tags->where('type', 'tag') as $tag)
                    @include($skyTheme.'.partial.tag')
                    @endforeach
                    @endunless
                </div>
            </div>
            <a href="#" class="flex items-center gap-2">
                <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar"
                    class="object-cover w-10 h-10 rounded-full sm:block">
                <h1 class="font-bold text-gray-700 dark:text-gray-100 hover:underline">{{ $post->author->name ?? ''
                    }}</h1>
            </a>
        </div>

        <div class="mt-6 lg:mt-12 prose dark:prose-invert max-w-none">
            {!! $post->getContent() !!}
        </div>
    </div>

    @if ($related->isNotEmpty())
    <div class="py-6 flex flex-col mt-4 gap-4">
        <h1 class="text-xl font-bold text-gray-700 dark:text-gray-100 md:text-2xl">{{ __('Related Posts') }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($related as $post)
            @include($skyTheme.'.partial.related')
            @endforeach
        </div>
    </div>
    @endif
    </div> --}}
