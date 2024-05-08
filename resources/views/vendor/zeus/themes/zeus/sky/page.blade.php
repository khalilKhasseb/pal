<x-slot name="header">
    <h2 class="capitalize">{{ $post->title }}</h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="">
        <a href="{{ route('blogs') }}">{{ __('Posts') }}</a>
        {{-- @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3 rtl:rotate-180') --}}
    </li>
    <li class="">
        {{ $post->title }}
    </li>
</x-slot>


<section class="bg-single-blog">

    <div class="container mb-5">
        <div class="row">
            <div class="single-blog">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-items">
                            @if($post->image('pages') !== null)
                            {{-- @dd($post->image()) --}}
                            <div class="blog-img">
                                <a href="#">
                                    <img src="{{$post->image('pages')}}" alt="{{$post->title}}" class="img-responsive" />
                                </a>
                            </div>
                            @endif
                            <!-- .blog-img -->
                            <div class="blog-content-box">
                                <div class="meta-box">
                                    <div class="event-author-option">
                                        <div class="event-author-img">
                                            <img src="{{\Filament\Facades\Filament::getUserAvatarUrl($post->author) }}"
                                                alt="avatar" />
                                        </div>
                                        <!-- .author-img -->
                                        <div class="event-author-name">
                                            <p>{{__('Posted by')}} : <a href="#">{{$post->author->name ?? ""}}</a></p>
                                        </div>
                                        <!-- .author-name -->
                                    </div>
                                    <!-- .author-option -->
                                    <ul class="meta-post">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ optional($post->published_at)->diffForHumans() ?? '' }}
                                            <!-- 22.04.2017 -->
                                        </li>
                                        <li x-data="
                                        {
                                            likes:@js($post->likes),
                                            post_id:@js($post->id),
                                            liked : @js($post->checkIfHasLikeForThisIp(request()->getClientIp())),
                                            like_post(){
                                              axios.get('{{route('ajax.like_post',$post->slug)}}')
                                              .then(r => {
                                                console.log(r)
                                                if(r.data) this.likes = r.data.likes
                                              })
                                              .catch(e => console.log(e))
                                            }

                                        }
                                        ">
                                            <button x-on:click="console.log(1)" class="btn-transperent">
                                                <i   class="fa fa-heart-o" aria-hidden="true"></i> <span
                                                    x-text="likes === null ? 0 : likes"></span>
                                            </button>

                                        </li>
                                        {{-- <li><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i> 24
                                                Comment</a></li> --}}
                                    </ul>
                                </div>
                                <!-- .meta-box -->
                                <div class="blog-content">
                                    <h4>{{$post->title}}</h4>

                                    {!! $post->getContent() !!}

                                </div>
                                <!-- .blog-content -->
                                <div class="single-blog-bottom">
                                    <ul class="tags">
                                        <li><i class="fa fa-tags" aria-hidden="true"></i> Tags :</li>
                                        @unless ($post->tags->isEmpty())
                                        @foreach($post->tags->where('type','tag') as $tag)
                                        @include($skyTheme.'.partial.tag')
                                        @endforeach
                                        @endunless
                                    </ul>
                                    <!-- .author-option -->
                                    <div class="event-share-option">
                                        <ul class="social-icon share-icon">
                                            <li><i class="fa fa-share-alt" aria-hidden="true"></i><span>share
                                                    :</span></li>
                                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                                            <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
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
                            comments:@js($post->comments)
                        }">
                            <h4 class="comments-title">{{$post->comments->count()}} Comments</h4>

                            @foreach ($post->comments as $comment)

                            @if(!empty($comment->comment) && !empty($comment->comment))
                            <div class="comments-items">
                                <div class="comments-image">
                                    <img src="{{config('theme.defaultCommentAuthorImage')}}"
                                        alt="comments-author-img" />
                                </div>
                                <!-- .comments-image -->
                                <div class="comments-content">
                                    <div class="comments-author-title">
                                        <div class="comments-author-name">
                                            <h4><a href="#">{{$comment->name}}</a> -
                                                <small>{{optional($comment->created_at)->diffForHumans()}}</small>
                                            </h4>
                                        </div>
                                        {{-- <div class="reply-icon">
                                            <h6><i class="fa fa-reply-all"></i><a href="#"> Reply</a></h6>
                                        </div> --}}
                                    </div>
                                    <!-- .comments-author-title -->
                                    <p>{{$comment->comment}}</p>
                                </div>
                                <!-- .comments-content -->
                            </div>
                            <!-- .comments-items -->
                            @endif
                            @endforeach

                        </div>
                        <!-- .comments-option -->

                        @livewire('comment' , ['post' => $post])
                    </div>

                    <div class="col-lg-4">

                        @include($skyTheme.'.partial.sidebar')

                        <!-- .sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>


