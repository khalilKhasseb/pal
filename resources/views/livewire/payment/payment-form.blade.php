@php
    $rtl = app()->getLocale() === 'ar';
@endphp



<x-slot name="header">
    <h2 class="header-title">
        {{ __('Payment Form') }}
    </h2>
</x-slot>
<div>
    {!! NoCaptcha::renderJs() !!}

    <div class="payment-form-wrapper">
        <div class="container">
            <div class="form-header">
                <h2 class="form-title">{{ __('Sponsorship & Donation') }}</h2>
                <p class="form-subtitle">
                    {{ __('For those interested in supporting the council’s activities through sponsorship and/or donation') }}
                </p>
                <div class="contact-info">
                    <i class="fa fa-envelope"></i>
                    {{ __('Contact us at:') }} admin@palgbc.org
                </div>
            </div>

            @if ($checkout_enabled)
                <div class="payment-form-container">
                    @error('payment')
                        <div class="form-error-alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>
                                <strong>{{ $message }}</strong>
                                @if ($errors->hasAny(array_keys($errors->get('payment.*'))))
                                    <ul class="error-list">
                                        @foreach ($errors->get('payment.*') as $field => $messages)
                                            @foreach ($messages as $message)
                                                <li>{{ $message }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @enderror

                    <form wire:submit.prevent="submit" class="classic-form">
                        <div class="form-section">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">{{ __('Payment purpose') }}</label>
                                    <select wire:model="purpose" required class="form-control">
                                        <option value="">{{ __('Select purpose') }}</option>
                                        <option value="donate">{{ __('Donate') }}</option>
                                        <option value="membership_cost">{{ __('Membership cost') }}</option>
                                        <option value="cource_cost">{{ __('Course cost') }}</option>
                                        <option value="adv_cost">{{ __('Ads cost') }}</option>
                                        <option value="sponser">{{ __('Sponsor') }}</option>
                                        <option value="other">{{ __('Others') }}</option>
                                    </select>
                                    @error('purpose')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="required">{{ __('Payment type') }}</label>
                                    <select wire:model="classification" required class="form-control">
                                        <option value="">{{ __('Select type') }}</option>
                                        <option value="individual">{{ __('Individuals') }}</option>
                                        <option value="company">{{ __('Companies') }}</option>
                                        <option value="organization">{{ __('Organizations') }}</option>
                                    </select>
                                    @error('classification')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">{{ __('Full Name') }}</label>
                                    <input type="text" wire:model="full_name" required class="form-control">
                                    @error('full_name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="required">{{ __('Email') }}</label>
                                    <input type="email" wire:model="email" required class="form-control">
                                    @error('email')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="required">{{ __('Mobile') }}</label>
                                    <input type="tel" wire:model="mobile" required class="form-control">
                                    @error('mobile')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required">{{ __('Address') }}</label>
                                    <input type="text" wire:model="address" required class="form-control">
                                    @error('address')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="required">{{ __('Amount') }}</label>
                                    <input type="number" wire:model="amount" required class="form-control">
                                    @error('amount')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>{{ __('Payment Details') }}</label>
                                    <textarea wire:model="payment_details" class="form-control" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="form-checkbox-group">
                                <label>
                                    <input type="checkbox" wire:model="contact_before_payment">
                                    {{ __('Did you contact us before payment?') }}
                                </label>


                                
                                @error('contact_before_payment')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                        <div class="form-row">
                            <div class="form-group">
                                {!! NoCaptcha::display() !!}
                            </div>
                        </div>


                            <button type="submit" class="submit-btn" wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="fa fa-credit-card"></i> {{ __('Pay Now') }}
                                </span>
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-spin"></i> {{ __('Processing...') }}
                                </span>
                            </button>
                        </div>

                        

                    </form>
                </div>
            @else
                <div class="checkout-disabled">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ __('Online payments are currently unavailable. Please contact us directly.') }}
                </div>
            @endif
        </div>
    </div>
    @push('styles')
        <style>
            .payment-form-wrapper {
                padding: 2rem 0;
                /* font-family: Arial, sans-serif; */
            }

            .form-header {
                text-align: center;
                margin-bottom: 2rem;
            }

            .form-title {
                color: #2c3e50;
                font-size: 2rem;
                margin-bottom: 0.5rem;
            }

            .form-subtitle {
                color: #7f8c8d;
                margin-bottom: 1rem;
            }

            .contact-info {
                background: #f8f9fa;
                padding: 1rem;
                border-radius: 4px;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .payment-form-container {
                max-width: 800px;
                margin: 0 auto;
                background: #fff;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .classic-form .form-control {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #ced4da;
                border-radius: 4px;
                margin-bottom: 0.5rem;
            }

            .classic-form select.form-control {
                appearance: none;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 0.75rem center;
                background-size: 1em;
            }

            .form-row {
                display: flex;
                gap: 1rem;
                margin-bottom: 1rem;
            }

            .form-group {
                flex: 1;
            }

            .required::after {
                content: "*";
                color: #e74c3c;
                margin-left: 0.25rem;
            }

            .error-message {
                color: #e74c3c;
                font-size: 0.875rem;
                display: block;
                margin-top: 0.25rem;
            }

            .form-error-alert {
                background: #f8d7da;
                color: #721c24;
                padding: 1rem;
                border-radius: 4px;
                margin-bottom: 1.5rem;
                display: flex;
                gap: 0.75rem;
            }

            .submit-btn {
                background: #27ae60;
                color: white;
                padding: 1rem 2rem;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                width: 100%;
                font-size: 1rem;
                transition: background 0.3s ease;
            }

            .submit-btn:hover {
                background: #219a52;
            }

            .submit-btn i {
                margin-right: 0.5rem;
            }

            .form-checkbox-group {
                margin: 1rem 0;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .checkout-disabled {
                background: #fff3cd;
                color: #856404;
                padding: 1.5rem;
                border-radius: 4px;
                text-align: center;
                margin-top: 2rem;
            }

            .classic-form select.form-control {
                appearance: none;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 0.75rem center;
                background-size: 1em;
                padding-right: 2rem;
            }

            [dir='rtl'] .classic-form select.form-control {
                background-position: left 0.75rem center;
                padding-right: 0.75rem;
                padding-left: 2rem;
            }

            .form-row {
                display: flex;
                gap: 1rem;
                margin-bottom: 1rem;
                flex-wrap: wrap;
            }

            .form-group {
                flex: 1;
                min-width: 250px;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .form-row {
                    flex-direction: column;
                    gap: 0.5rem;
                    margin-bottom: 0.5rem;
                }

                .form-group {
                    width: 100%;
                    flex: none;
                    min-width: auto;
                    margin-bottom: 0.5rem;
                }

                .form-group:last-child {
                    margin-bottom: 0;
                }

                .payment-form-container {
                    padding: 1rem;
                }

                .form-title {
                    font-size: 1.5rem;
                }
            }
        </style>
    @endpush
</div>
