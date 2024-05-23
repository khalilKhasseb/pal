@use(Illuminate\Support\Str)
<div class="col-12 col-sm-6 col-lg-4">

    <div class="blog-items">
        <div class="blog-img">
            <a href="{{ route('post', $post->slug) }}">

             <img src="{{ $post->image()}}" alt="blog-img-1" class="img-responsive" />
                 
            </a>
        </div>
        <!-- .blog-img -->
        <div class="blog-content-box">
            <div class="blog-content">
                <h4><a href="{{ route('post', $post->slug) }}">{!! Str::substr($post->title, 0, 30) !!}</a></h4>
                @if ($post->description !== null)
                    <p>
                        {!! Str::substr($post->description, 0, 15) !!}
                    </p>
                @endif
            </div>
            <!-- .blog-content -->
            <div class="meta-box">
                <ul class="meta-post">
                    <li>
                        <i class="fa fa-calendar" aria-hidden="true">
                        </i> {{ optional($post->published_at)->diffForHumans() ?? '' }}
                    </li>
                    <li x-data="{
                        likes: @js($post->likes),
                        post_id: @js($post->id),
                        liked: @js($post->checkIfHasLikeForThisIp(request()->getClientIp())),
                        like_post() {
                            axios.get('{{ route('ajax.like_post', $post->slug) }}')
                                .then(r => {
                                    console.log(r)
                                    if (r.data) {
                                        this.likes = r.data.likes
                                        this.liked = r.data.liked
                                    }
                                })
                                .catch(e => console.log(e))
                        }
                    
                    }">
                        <button style="background:transparent" x-on:click="like_post" class="btn-transparent">
                            <i x-bind:style="liked && 'color:red'" x-bind:class="`fa fa-heart-o`"
                                aria-hidden="true"></i> <span x-text="likes === null ? 0 : likes"></span>
                        </button>

                    </li>
                    <li>
                        <a href="{{ ''}}"><i class="fa fa-user-o"
                                aria-hidden="true"></i>
                            {{ $post->author->name }}
                        </a>
                    </li>
                </ul>
            </div>
            <!-- .meta-box -->
        </div>
        <!-- .blog-content-box -->
    </div>
    <!-- .blog-items -->
</div>
<!-- .col-md-4 -->

{{-- <article class="mt-6" itemscope itemtype="https://schema.org/Movie">
    <div class="px-6 pb-6 mx-auto bg-white dark:bg-gray-800 rounded-[2rem] rounded-bl-none rounded-tr-none shadow-md">
        <div class="flex items-center justify-between">
            <span class="font-light text-sm text-gray-600 dark:text-gray-200 mt-2">{{
                optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @unless ($post->tags->isEmpty())
                @each($skyTheme.'.partial.category', $post->tags->where('type','category'), 'category')
                @endunless
            </div>
        </div>
        <aside class="mt-2">
            <a href="{{ route('post',$post->slug) }}"
                class="text-2xl md:text-3xl font-bold text-gray-700 dark:text-gray-200 hover:underline">
                {!! $post->title !!}
            </a>
            @if ($post->description !== null)
            <p class="mt-2 text-gray-600 dark:text-gray-200">
                {!! $post->description !!}
            </p>
            @endif
        </aside>
        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('post',$post->slug) }}" class="text-blue-500 dark:text-blue-200 hover:underline">Read
                more</a>
            <div>
                <a class="flex items-center gap-2">
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar"
                        class="hidden object-cover w-8 h-8 rounded-full sm:block">
                    <p class="text-gray-700 dark:text-gray-200 hover:underline">{{ $post->author->name ?? '' }}</p>
                </a>
            </div>
        </div>
    </div>
</article> --}}
