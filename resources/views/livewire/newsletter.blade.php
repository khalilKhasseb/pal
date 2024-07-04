<div>
    {{-- Stop trying to control. --}}
      <h5 class="mb-3 text-light font-sm">{{__('Subscribe to our news letter')}}</h5>
    <div class="form-container news-letter d-flex align-items-center justify-content-start {{app()->getLocale() === 'en' ? 'flex-row-reverse' : ''}} ">
        <input class="form-control w-100" style="border:1px solid #53a92c;padding:9px 19px 7px 19px" wire:model="email"
            type="text" placeholder="{{ __('Email') }}">
        <button class="flex-grow-1 d-block btn btn-default me-1 w-100" type="button"
            wire:click="subscribe">{{ __('Subscribe') }}</button>

            <span wire:loading class="text-warning">laoding...</span>
    </div>
    @if (session()->has('message'))
        <p class="text-success">{{ session()->get('message') }}</p>
    @endif
</div>
