@php
    $rtl = app()->getLocale() === 'ar';
@endphp

<x-slot name="header">
    <h2 class="header-title">
        {{ __('Payment Form') }}
    </h2>
</x-slot>

<div>
    <div class="payment-form-wrapper">
        <div class="container">
            <div class="form-header">
                <img src="/logo1.png" alt="Palestine Green Building Council" class="brand-logo">
                <h2 class="form-title">{{ __('Sponsorship & Donation') }}</h2>
                <p class="form-subtitle">
                    {{ __('For those interested in supporting the council\'s activities through sponsorship and/or donation') }}
                </p>
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    {{ __('Contact us at:') }} <a href="mailto:admin@palgbc.org">admin@palgbc.org</a>
                </div>
            </div>

            @if ($checkout_enabled)
                <div class="payment-form-container">
                    @error('payment')
                        <div class="form-error-alert">
                            <div class="error-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="error-content">
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

                    <form wire:submit.prevent="submit" class="modern-form">
                        <div class="form-section">
                            <div class="form-row">
                                <div class="form-group @error('purpose') has-error @enderror">
                                    <label class="required">{{ __('Payment purpose') }}</label>
                                    <div class="input-wrapper">
                                        <select wire:model="purpose" required class="form-control">
                                            <option value="">{{ __('Select purpose') }}</option>
                                            <option value="donate">{{ __('Donate') }}</option>
                                            <option value="membership_cost">{{ __('Membership cost') }}</option>
                                            <option value="cource_cost">{{ __('Course cost') }}</option>
                                            <option value="adv_cost">{{ __('Ads cost') }}</option>
                                            <option value="sponser">{{ __('Sponsor') }}</option>
                                            <option value="other">{{ __('Others') }}</option>
                                        </select>
                                        <div class="input-icon">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                    </div>
                                    @error('purpose')
                                        <span class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('classification') has-error @enderror">
                                    <label class="required">{{ __('Payment type') }}</label>
                                    <div class="input-wrapper">
                                        <select wire:model="classification" required class="form-control">
                                            <option value="">{{ __('Select type') }}</option>
                                            <option value="individual">{{ __('Individuals') }}</option>
                                            <option value="company">{{ __('Companies') }}</option>
                                            <option value="organization">{{ __('Organizations') }}</option>
                                        </select>
                                        <div class="input-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    @error('classification')
                                        <span class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group @error('full_name') has-error @enderror">
                                    <label class="required">{{ __('Full Name') }}</label>
                                    <div class="input-wrapper">
                                        <input type="text" wire:model="full_name" required class="form-control">
                                        <div class="input-icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    @error('full_name')
                                        <span class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group @error('email') has-error @enderror">
                                    <label class="required">{{ __('Email') }}</label>
                                    <div class="input-wrapper">
                                        <input type="email" wire:model="email" required class="form-control">
                                        <div class="input-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('mobile') has-error @enderror">
                                    <label class="required">{{ __('Mobile') }}</label>
                                    <div class="input-wrapper">
                                        <input type="tel" wire:model="mobile" required class="form-control">
                                        <div class="input-icon">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                    </div>
                                    @error('mobile')
                                        <span class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group @error('address') has-error @enderror">
                                    <label class="required">{{ __('Address') }}</label>
                                    <div class="input-wrapper">
                                        <input type="text" wire:model="address" required class="form-control">
                                        <div class="input-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    @error('address')
                                        <span class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('amount') has-error @enderror">
                                    <label class="required">{{ __('Amount') }}</label>
                                    <div class="input-wrapper">
                                        <input type="number" wire:model="amount" required class="form-control">
                                        <div class="input-icon">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    @error('amount')
                                        <span class="error-message">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>{{ __('Payment Details') }}</label>
                                    <div class="input-wrapper textarea-wrapper">
                                        <textarea wire:model="payment_details" class="form-control" rows="4"></textarea>
                                        <div class="input-icon textarea-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-checkbox-group">
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="contact_before_payment" wire:model="contact_before_payment">
                                    <label for="contact_before_payment">
                                        <span class="checkbox-icon"></span>
                                        {{ __('Did you contact us before payment?') }}
                                    </label>
                                </div>
                                @error('contact_before_payment')
                                    <span class="error-message">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-row captcha-row">
                                <div wire:ignore class="captcha-container">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display(['data-callback' => 'captchaCompleted']) !!}
                                </div>
                                @error('recaptcha')
                                    <span class="error-message">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </span>
                                @enderror
                                <input type="hidden" wire:model="recaptcha">
                            </div>

                            <div class="form-row button-row">
                                <button type="submit" class="submit-btn" wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        <i class="fa fa-credit-card"></i> {{ __('Pay Now') }}
                                    </span>
                                    <span wire:loading>
                                        <i class="fa fa-spinner fa-spin"></i> {{ __('Processing...') }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="checkout-disabled">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>{{ __('Online payments are currently unavailable. Please contact us directly.') }}</p>
                    <a href="mailto:admin@palgbc.org" class="contact-btn">
                        <i class="fas fa-envelope"></i> {{ __('Contact Us') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    @push('styles')
        <style>
            /* Base Styles - PALGBC Brand Colors */
            :root {
                --primary-color: #78b843;      /* Brand green from logo */
                --primary-hover: #68a336;      /* Darker green for hover states */
                --secondary-color: #4a6741;    /* Dark green for secondary elements */
                --success-color: #5cb85c;      /* Success green */
                --danger-color: #d9534f;       /* Softer red for errors */
                --warning-color: #f0ad4e;      /* Warning color */
                --info-color: #5bc0de;         /* Info color */
                --light-color: #f9fcf7;        /* Very light green tint for backgrounds */
                --dark-color: #2c3e2e;         /* Very dark green for text */
                --border-color: #dbe9d3;       /* Light green for borders */
                --input-bg: #ffffff;           /* White for inputs */
                --card-bg: #ffffff;            /* White for cards */
                --body-bg: #f4f9f0;            /* Light green tint for body background */
                --shadow: 0 4px 10px -2px rgba(120, 184, 67, 0.15), 0 2px 4px -1px rgba(120, 184, 67, 0.08);
                --border-radius: 0.5rem;
                --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            .payment-form-wrapper {
                padding: 2rem 0;
                font-family: var(--font-family);
                background-color: var(--body-bg);
                min-height: 100vh;
            }

            .container {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
            }

            /* Form Header */
            .form-header {
                text-align: center;
                margin-bottom: 2.5rem;
            }
            
            /* Brand Logo */
            .brand-logo {
                max-width: 200px;
                margin: 0 auto 1.5rem;
                display: block;
            }

            .form-title {
                color: var(--dark-color);
                font-size: 2.25rem;
                font-weight: 700;
                margin-bottom: 0.75rem;
            }

            .form-subtitle {
                color: var(--secondary-color);
                font-size: 1.125rem;
                margin-bottom: 1.5rem;
                max-width: 700px;
                margin-left: auto;
                margin-right: auto;
            }

            .contact-info {
                background: var(--light-color);
                padding: 1rem 1.5rem;
                border-radius: var(--border-radius);
                display: inline-flex;
                align-items: center;
                gap: 0.75rem;
                box-shadow: var(--shadow);
                color: var(--secondary-color);
            }

            .contact-info a {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
            }

            .contact-info a:hover {
                text-decoration: underline;
            }

            /* Form Container */
            .payment-form-container {
                max-width: 900px;
                margin: 0 auto;
                background: var(--card-bg);
                padding: 2.5rem;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
                margin-bottom: 2rem;
            }

            /* Modern Form Styles */
            .modern-form .form-control {
                width: 100%;
                padding: 0.875rem 1rem 0.875rem 2.5rem;
                border: 1px solid var(--border-color);
                border-radius: var(--border-radius);
                font-size: 1rem;
                line-height: 1.5;
                color: var(--dark-color);
                background-color: var(--input-bg);
                transition: all 0.2s ease-in-out;
            }

            .modern-form .form-control:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
            }

            [dir='rtl'] .modern-form .form-control {
                padding: 0.875rem 2.5rem 0.875rem 1rem;
            }

            .modern-form select.form-control {
                appearance: none;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 0.75rem center;
                background-size: 1em;
                padding-right: 2.5rem;
            }

            [dir='rtl'] .modern-form select.form-control {
                background-position: left 0.75rem center;
                padding-right: 2.5rem;
                padding-left: 2.5rem;
            }

            .modern-form textarea.form-control {
                padding-left: 1rem;
                padding-top: 1rem;
                min-height: 120px;
            }

            [dir='rtl'] .modern-form textarea.form-control {
                padding-right: 1rem;
            }

            .form-row {
                display: flex;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
            }

            .form-group {
                flex: 1;
                min-width: 280px;
                position: relative;
            }

            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: var(--dark-color);
            }

            .required::after {
                content: "*";
                color: var(--danger-color);
                margin-left: 0.25rem;
            }

            /* Input Wrapper */
            .input-wrapper {
                position: relative;
            }

            .input-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--secondary-color);
            }

            [dir='rtl'] .input-icon {
                left: auto;
                right: 1rem;
            }

            .textarea-wrapper .textarea-icon {
                top: 1.25rem;
                transform: none;
            }

            /* Error Styles */
            .has-error .form-control {
                border-color: var(--danger-color);
            }

            .has-error .input-icon {
                color: var(--danger-color);
            }

            .error-message {
                color: var(--danger-color);
                font-size: 0.875rem;
                display: flex;
                align-items: center;
                gap: 0.375rem;
                margin-top: 0.5rem;
            }

            .form-error-alert {
                background: #fdf5f5;
                color: var(--danger-color);
                padding: 1.25rem;
                border-radius: var(--border-radius);
                margin-bottom: 2rem;
                display: flex;
                gap: 1rem;
                border-left: 4px solid var(--danger-color);
            }

            .error-icon {
                font-size: 1.5rem;
                line-height: 1;
            }

            .error-content {
                flex: 1;
            }

            .error-list {
                margin-top: 0.75rem;
                padding-left: 1.5rem;
            }

            .error-list li {
                margin-bottom: 0.375rem;
            }

            /* Custom Checkbox */
            .form-checkbox-group {
                margin: 1.5rem 0;
            }

            .custom-checkbox {
                display: flex;
                align-items: flex-start;
                cursor: pointer;
            }

            .custom-checkbox input[type="checkbox"] {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .checkbox-icon {
                position: relative;
                display: inline-block;
                min-width: 20px;
                height: 20px;
                background-color: var(--input-bg);
                border: 2px solid var(--border-color);
                border-radius: 4px;
                margin-right: 0.75rem;
                margin-top: 2px;
                transition: all 0.2s ease;
            }

            [dir='rtl'] .checkbox-icon {
                margin-right: 0;
                margin-left: 0.75rem;
            }

            .custom-checkbox input[type="checkbox"]:checked ~ .checkbox-icon {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            .custom-checkbox input[type="checkbox"]:checked ~ .checkbox-icon:after {
                content: '';
                position: absolute;
                left: 6px;
                top: 2px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }

            /* Submit Button */
            .button-row {
                margin-top: 2rem;
            }

            .submit-btn {
                background: var(--primary-color);
                color: white;
                padding: 1rem 2rem;
                border: none;
                border-radius: var(--border-radius);
                cursor: pointer;
                width: 100%;
                font-size: 1.125rem;
                font-weight: 600;
                transition: background 0.3s ease;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 0.75rem;
                box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
            }

            .submit-btn:hover {
                background: var(--primary-hover);
            }

            .submit-btn:disabled {
                opacity: 0.7;
                cursor: not-allowed;
            }

            /* Checkout Disabled */
            .checkout-disabled {
                max-width: 700px;
                background: #fff;
                color: var(--secondary-color);
                padding: 2.5rem;
                border-radius: var(--border-radius);
                text-align: center;
                margin: 2rem auto;
                box-shadow: var(--shadow);
                border-top: 4px solid var(--primary-color);
            }

            .checkout-disabled i {
                font-size: 3rem;
                margin-bottom: 1.5rem;
                display: block;
            }

            .checkout-disabled p {
                font-size: 1.25rem;
                margin-bottom: 1.5rem;
                color: var(--dark-color);
            }

            .contact-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: var(--primary-color);
                color: white;
                text-decoration: none;
                padding: 0.875rem 1.5rem;
                border-radius: var(--border-radius);
                font-weight: 500;
                transition: background 0.3s ease;
            }

            .contact-btn:hover {
                background: var(--primary-hover);
            }

            /* Captcha Container */
            .captcha-row {
                justify-content: center;
                margin-top: 1.5rem;
            }

            .captcha-container {
                transform: scale(1);
                transform-origin: left center;
                margin: 0 auto;
            }

            [dir='rtl'] .captcha-container {
                transform-origin: right center;
            }

            /* Responsive Adjustments */
            @media (max-width: 768px) {
                .payment-form-container {
                    padding: 1.5rem;
                }

                .form-title {
                    font-size: 1.75rem;
                }

                .form-row {
                    flex-direction: column;
                    gap: 1rem;
                }

                .form-group {
                    width: 100%;
                    min-width: auto;
                }

                .custom-checkbox label {
                    padding-top: 0;
                }

                .captcha-container {
                    transform: scale(0.9);
                    margin: 0;
                }
            }

            @media (max-width: 480px) {
                .payment-form-container {
                    padding: 1.25rem;
                }

                .form-header {
                    margin-bottom: 2rem;
                }

                .captcha-container {
                    transform: scale(0.85);
                    margin: 0;
                }

                .submit-btn {
                    padding: 0.875rem 1.5rem;
                }
            }
        </style>
    @endpush

    <script>
        function captchaCompleted(response) {
            @this.set('recaptcha', response);
        }
    </script>   
</div>