@php 
 $bg = filled($settings->subscription_background) && \Storage::disk('public')->exists($settings->subscription_background) ? asset('storage/'.$settings->subscription_background) : config('theme.newsletter.bg');
@endphp
<div class="newsletter-wraaper" style="--bg-image: url('{{ $bg }}');">
    {{-- Stop trying to control. --}}

    {{-- @dd($settings->subscription_background) --}}
    <div class="container">
        <div class="newsletter py-5  ">

            <h2 class="mb-5  font-xl text-center text-light">{{ __('Subscribe to our news letter') }}</h2>
            <div
                class="form-container col-6 mx-auto news-letter d-flex align-items-center justify-content-start {{ app()->getLocale() === 'en' ? 'flex-row-reverse' : '' }} ">
                <input class="form-control block" wire:model="email" type="text" placeholder="{{ __('Email') }}">

                <button class="btn btn-success me-1 " type="button"
                    wire:click="subscribe">{{ __('Subscribe') }}</button>


            </div>
            <div wire:loading class="block col-8 mx-auto">
                <div class="alert alert-dark" role="alert">
                    {{__('Sending')}}
                </div>
            </div>
            @if (session()->has('message'))
                <p class="text-success">{{ session()->get('message') }}</p>
            @endif
        </div>

    </div>

</div>
