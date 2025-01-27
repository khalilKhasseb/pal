{{-- resources/views/payment-success.blade.php --}}
@php
    $rtl = app()->getLocale() === 'ar';
    $textAlign = $rtl ? 'right' : 'left';
    $flexDirection = 'row';
    $marginDirection = $rtl ? 'margin-right' : 'margin-left';
@endphp

<x-theme-layout :rtl="$rtl">
    <div
        style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; background: #f8fafc; direction: {{ $rtl ? 'rtl' : 'ltr' }};">
        <div
            style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 600px;">
            {{-- Header --}}
            <div
                style="padding: 24px; background: #53a92c; border-radius: 12px 12px 0 0; display: flex; align-items: center; gap: 16px; flex-direction: {{ $flexDirection }};">
                <svg style="width: 40px; height: 40px; color: white;" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
                <div style="text-align: {{ $textAlign }};">
                    <h1 style="margin: 0; color: white; font-size: 24px; font-weight: 600;">
                        {{ __('Payment Successful') }}</h1>
                    <p style="margin: 4px 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">
                        {{ __('Transaction Processed') }}</p>
                </div>
            </div>

            {{-- Body --}}
            <div style="padding: 32px;">
                {{-- Transaction Details --}}
                <div
                    style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 24px; direction: ltr;">
                    @foreach ([['label' => __('Reference Number'), 'value' => $payment->reference], ['label' => __('Date & Time'), 'value' => now()->format('d/m/Y H:i')], ['label' => __('Amount Paid'), 'value' => number_format($payment->amount, 2) . ' ' . __(config('lahza.default_currency'))], ['label' => __('Status'), 'value' => __('Completed'), 'status' => true]] as $item)
                        <div style="text-align: {{ $textAlign }};">
                            <p style="margin: 0 0 8px; color: #64748b; font-size: 14px;">{{ $item['label'] }}</p>
                            @if (isset($item['status']))
                                <div
                                    style="display: flex; align-items: center; gap: 8px; direction: {{ $rtl ? 'rtl' : 'ltr' }};">
                                    <div style="width: 10px; height: 10px; background: #53a92c; border-radius: 50%;">
                                    </div>
                                    <span style="color: #53a92c; font-weight: 500;">{{ $item['value'] }}</span>
                                </div>
                            @else
                                <p
                                    style="margin: 0; color: #1e293b; font-weight: 500; @if ($rtl) direction: rtl; @endif">
                                    {{ $item['value'] }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Next Steps --}}
                <div
                    style="border-top: 1px solid #e2e8f0; padding-top: 24px; margin-bottom: 24px; text-align: {{ $textAlign }};">
                    <h3 style="margin: 0 0 16px; color: #1e293b; font-size: 18px; font-weight: 600;">
                        {{ __('Next Steps') }}</h3>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach ([__('Confirmation email sent'), __('Processing within 24 hours')] as $step)
                            <div
                                style="display: flex; align-items: center; gap: 8px; flex-direction: {{ $flexDirection }};">
                                <svg style="width: 18px; height: 18px; color: #53a92c;" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                </svg>
                                <span style="color: #475569; font-size: 14px;">{{ $step }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Actions --}}
                <div
                    style="display: flex; gap: 16px; justify-content: space-between; margin-top: 32px; flex-direction: {{ $rtl ? 'row-reverse' : 'row' }};">
                    <a href="{{  route('payment.receipt', $payment) }}" target="_blank"
                        style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px; background: white; border: 1px solid #cbd5e1; border-radius: 8px; color: #334155; cursor: pointer; text-decoration: none; flex-direction: {{ $flexDirection }};">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        {{ __('Print Receipt') }}
                    </a>
                    <a href="{{ route('theme.home') }}"
                        style="flex: 1; text-align: center; padding: 12px; background: #53a92c; border-radius: 8px; color: white; text-decoration: none; font-weight: 500;">
                        {{ __('Return Home') }}
                    </a>
                </div>

                {{-- Support --}}
                <div style="margin-top: 24px; text-align: {{ $textAlign }};">
                    <p style="margin: 0; color: #64748b; font-size: 14px;">
                        {{ __('Need help?') }}
                        <a href="mailto:support@palgbc.org"
                            style="color: #53a92c; text-decoration: none;">{{ __('Contact support') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 640px) {
            div[style*="max-width: 600px"] {
                width: 95% !important;
            }

            div[style*="grid-template-columns: repeat(2, 1fr)"] {
                grid-template-columns: 1fr !important;
                gap: 20px !important;
            }

            div[style*="justify-content: space-between"] {
                flex-direction: column !important;
                gap: 12px !important;
            }
        }
    </style>
</x-theme-layout>
