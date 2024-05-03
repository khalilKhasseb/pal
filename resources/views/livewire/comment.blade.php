<!-- .comments-option -->

<div class="comments-form">
    <h4 class="comments-title">Leave A Reply</h4>
    <form wire:submit='store'>
        {{-- <input hidden type="text" value="{{$post_id}}"> --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" wire:model="name" class="form-control" id="nameId" placeholder="Name*">
                </div>
            </div>
            <!-- .col-md-4 -->
            <div class="col-md-4">
                <div class="form-group">
                    <input type="email" wire:model="email" class="form-control" id="emailId" placeholder="Email*">
                </div>
            </div>
            <!-- .col-md-4 -->
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" wire:model="website" class="form-control" id="websiteId" placeholder="Website">
                </div>
            </div>
            <!-- .col-md-4 -->
        </div>
        <!-- .row -->
        <textarea wire:model='comment' class="form-control comments-textarea" placeholder="Comments*"></textarea>

        <button type="submit" class="btn btn-default">submit Comment</button>
    </form>
</div>
<!-- .comments-form -->
