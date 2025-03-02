<x-theme-layout>

<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-danger text-white">
            <h3 class="mb-0">{{ __('Payment Failed') }}</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-danger">
                <h4 class="alert-heading">{{ __('We encountered an issue with your payment') }}</h4>
                <p class="mb-0">{{ __('Transaction Reference') }}: <strong>{{ $payment->reference }}</strong></p>
                <p class="mb-0">{{ __('Status') }}: <strong>{{ ucfirst($payment->status) }}</strong></p>
                @if($payment->status === 'failed')
                <p class="mt-3">{{ __('Please try again or contact support') }}</p>
                @endif
            </div>
            
            <div class="d-flex gap-3">
                <a href="{{ route('payment.form') }}" class="btn btn-primary">
                    {{ __('Try Again') }}
                </a>
                <a href="{{ route('theme.home') }}" class="btn btn-secondary">
                    {{ __('Return to Homepage') }}
                </a>
            </div>
        </div>
    </div>
</div>
</x-theme-layout>