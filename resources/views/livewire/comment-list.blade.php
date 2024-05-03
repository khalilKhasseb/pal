@foreach ($post->comments as $comment)

@if(!empty($comment->comment) && !empty($comment->comment))
<div class="comments-items">
    <div class="comments-image">
        <img src="{{config('theme.defaultCommentAuthorImage')}}" alt="comments-author-img" />
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
