<!-- .comments-option -->

<div class="comments-form mb-5">
    <h4 class="comments-title">{{__('Leave A Reply')}}</h4>
    <form wire:submit='store'>
        {{-- <input hidden type="text" value="{{$post_id}}"> --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" wire:model="name" class="form-control" id="nameId" placeholder="{{__('Name')}}">
                </div>
            </div>
            <!-- .col-md-4 -->
            <div class="col-md-4">
                <div class="form-group">
                    <input type="email" wire:model="email" class="form-control" id="emailId" placeholder="{{__('Email')}}">
                </div>
            </div>
            <!-- .col-md-4 -->
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" wire:model="website" class="form-control" id="websiteId" placeholder="{{__('Website')}}">
                </div>
            </div>
            <!-- .col-md-4 -->
        </div>
        <!-- .row -->
        <textarea wire:model='comment' class="form-control comments-textarea" placeholder="{{__('Comment')}}"></textarea>

        <button type="submit" class="btn btn-default mb-4"> {{__('Submit a comment')}}</button>
    </form>
</div>
<!-- .comments-form -->
