<!-- .comments-option -->
<div>

    <div class="comments-option">
        <h4 class="comments-title"> {{ strtoupper(__('comments')) }}
            {{ $post->comments->count() !== 0 ? '-' . $post->comments->count() : '' }}</h4>

        @foreach ($post->comments as $comment)
            @if (!empty($comment->comment) && !empty($comment->comment))
                <div class="comments-items">
                    <div class="comments-image">
                        <img src="{{ config('theme.defaultCommentAuthorImage') }}" alt="comments-author-img" />
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

    <div class="comments-form mb-5">
        <h4 class="comments-title">{{ __('Leave A Reply') }}</h4>
        <form wire:submit='store'>
            {{-- <input hidden type="text" value="{{$post_id}}"> --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" wire:model="name" class="form-control" id="nameId"
                            placeholder="{{ __('Name') }}">
                    </div>
                </div>
                <!-- .col-md-4 -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="email" wire:model="email" class="form-control" id="emailId"
                            placeholder="{{ __('Email') }}">
                    </div>
                </div>
                <!-- .col-md-4 -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" wire:model="website" class="form-control" id="websiteId"
                            placeholder="{{ __('Website') }}">
                    </div>
                </div>
                <!-- .col-md-4 -->
            </div>
            <!-- .row -->
            <textarea wire:model='comment' class="form-control comments-textarea" placeholder="{{ __('Comment') }}"></textarea>

            <button type="submit" class="btn btn-default mb-4"> {{ __('Submit a comment') }}</button>
        </form>
    </div>
</div>
<!-- .comments-form -->
