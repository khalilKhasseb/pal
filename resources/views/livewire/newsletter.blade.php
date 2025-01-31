@php
    $bg =
        filled($settings->subscription_background) &&
        \Storage::disk('public')->exists($settings->subscription_background)
            ? asset('storage/' . $settings->subscription_background)
            : config('theme.newsletter.bg');
@endphp
<div class="newsletter-container">
    <div class="newsletter-inner" style="background-image: url('{{ $bg }}');">
        <div class="newsletter-content">
            <h2 class="newsletter-title">{{ __('Stay updated with our latest news') }}</h2>
            <p class="newsletter-description">{{ __('Get the latest news and updates from our community') }}</p>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <form wire:submit.prevent="subscribe">
                <div class="input-group">
                    <input type="email" wire:model="email" placeholder="{{ __('Enter your email') }}"
                        class="form-control input-lg">
                    <button type="submit" class="btn btn-success btn-lg">{{ __('Subscribe') }}</button>
                </div>
                <div wire:loading class="loading-overlay">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">{{ __('Sending') }}</span>
                    </div>
                </div>
                @if (session()->has('message'))
                    <p class="text-success">{{ session()->get('message') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>
@push('styles')
    <style>
        .newsletter-container {
            position: relative;
            /* padding: 100px 0; */
            background-color: #f7f7f7;
        }

        .newsletter-inner {
            background-size: cover;
            background-position: center;
            padding: 50px;
            /* border-radius: 10px; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .newsletter-content {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }

        .newsletter-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .newsletter-description {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .input-group input {
            padding: 10px;
            border: none;
            border-radius: 5px 0 0 5px;
            width: 70%;
        }

        .input-group button {
            padding: 10px;
            border: none;
            border-radius: 0 5px 5px 0
        }

        .input-group .form-control.input-lg {
            width: 80%;
            padding: 15px;
            font-size: 18px;
            border-radius: {{ app()->getLocale() === 'ar' ? '0 5px 5px 0' : '5px 0 0 5px' }};
        }

        .input-group .btn.btn-success.btn-lg {
            padding: 15px;
            font-size: 18px;
            border-radius: {{ app()->getLocale() === 'ar' ? '5px 0 0 5px' : '0 5px 5px 0' }};
        }

        .newsletter-content {
            color: #fff;
            /* white text color */
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* add a black text shadow */
        }
    </style>
@endpush
