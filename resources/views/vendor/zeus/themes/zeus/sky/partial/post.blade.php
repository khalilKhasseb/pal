@use(Illuminate\Support\Str)
<article class="col-12 col-sm-6 col-lg-4">

    <div class="blog-items">
        <div class="blog-img">
            <a href="{{ route('post', $post->slug) }}">

             <img src="{{ $post->image()}}" alt="blog-img-1" class="img-responsive" />

            </a>
        </div>
        <!-- .blog-img -->
        <div class="blog-content-box">
            <div class="blog-content h-content-fixed">
                <h4 class="h-6 fs-1"><a href="{{ route('post', $post->slug) }}">{!! $post->title !!}</a></h4>
                {{-- @if ($post->description !== null)
                    <p>
                        {!! Str::substr($post->description, 0, 15) !!}
                    </p>
                @endif --}}
            </div>
            <!-- .blog-content -->
            <div class="meta-box">
                <ul class="meta-post">
                    <li>
                        <i class="fa fa-calendar" aria-hidden="true">
                        </i> {{ optional($post->published_at)->format('Y-m-d') ?? '' }}
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
</article>
<!-- .col-md-4 -->

