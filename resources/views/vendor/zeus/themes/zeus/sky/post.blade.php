@use(Illuminate\Support\Str)

@if (!is_null($post->cover()))
    <x-slot name="headerbg">
        {{$post->cover()}}
    </x-slot>
@endif
<x-slot name="header">
    <h3 class="capitalize">{{ $post->title }}</h3>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="">
        @php
            #generate dynmic breadcrumbs based on post type
            $collection = ucfirst($post->post_type);
            #plural collection
            $plural = Str::plural($collection);
            $route = $post->post_type === 'post' ? 'blogs' : $post->post_type;
        @endphp
        <a href="{{ route($route) }}">{{ __($plural) }}</a>
        {{-- @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3 rtl:rotate-180') --}}
    </li>
    <li class="">
        {{ $post->title }}
    </li>
</x-slot>
@push('th3_scripts')
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=664c7db51783940019670c0e&product=inline-share-buttons&source=platform"
        async="async"></script>
@endpush


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
                                        
                                                        if (r.data) this.likes = r.data.likes
                                        
                                                    })
                                                    .catch(e => console.log(e))
                                            },
                                            diss_like() {
                                                if (this.liked) {
                                                    axios.get('{{ route('ajax.like_post', $post->slug) }}')
                                                        .then(r => {
                                        
                                                            if (r.data) {
                                                                this.likes = r.data.likes
                                                                this.liked = r.data.liked
                                                            }
                                        
                                                        })
                                                        .catch(e => console.log(e))
                                                }
                                            }
                                        
                                        }">
                                            <button style="background:transparent" x-on:click="like_post"
                                                class="btn-transperent">
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

                                        <div style="float:none !important" class="mt-2 single-date-option">
                                            <ul class="single-date">
                                                @foreach ($post->post_meta as $meta)
                                                    <li class="d-flex justify-items-start">
                                                        @if ($meta->icon !== null || !empty($meta->icon))
                                                            <x-icon class="ps-2" width="20px" color="green"
                                                                name="{{ $meta->icon }}" />
                                                        @endif

                                                        <span>{{ $meta->key }} : {{ $meta->value }} </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (!is_null($post->gallary))
                                        <x-theme.gallary :gallary="$post->gallary->getMedia('gallary')" />
                                    @endif

                                    @if (!$post->getMedia('attachments')->isEmpty())
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('Attachment') }}</th>
                                                    <th scope="col">{{ __('Download') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($post->getMedia('attachments') as $media)
                                                    <tr>
                                                        <th>{{ $media->getDownloadFilename() }}</th>
                                                        <td><a class="rounded btn-success btn"
                                                                href="{{ route('downloadAttachment', $media) }}">{{ __('Download') }}</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                </div>
                                <!-- .blog-content -->
                                <div class="single-blog-bottom">
                                    <ul class="tags">
                                        <li><i class="fa fa-tags" aria-hidden="true"></i> {{ __('Tags') }} :</li>
                                        @unless ($post->tags->isEmpty())
                                            @foreach ($post->tags as $tag)
                                                @include($skyTheme . '.partial.tag')
                                            @endforeach
                                        @endunless
                                    </ul>
                                    <!-- .author-option -->
                                    <div class="event-share-option d-flex justify-items-start align-items-center">


                                        <span> {{ __('share') }} </span>
                                        <div class="sharethis-inline-share-buttons"></div>
                                    </div>
                                    <!-- .share-option -->
                                </div>
                                <!-- .single-blog-bottom -->
                            </div>
                            <!-- .blog-content-box -->
                        </div>

                        @if ($settings->comments_enabled)

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
                        @endif
                    </div>

                    <div class="col-lg-4">

                        @include($skyTheme . '.partial.sidebar')

                        <!-- .sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
