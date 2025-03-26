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
                                            <i class="fa fa-tag"></i>
                                        </div>
                                    </div>
                                    @error('purpose')
                                        <span class="error-message">
                                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    @error('classification')
                                        <span class="error-message">
                                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    @error('full_name')
                                        <span class="error-message">
                                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="error-message">
                                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
                                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
                                            <i class="fa fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    @error('address')
                                        <span class="error-message">
                                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('amount') has-error @enderror">
                                    <label class="required">{{ __('Amount') }}</label>
                                    <div class="input-wrapper">
                                        <input type="number" wire:model="amount" required class="form-control">
                                        <div class="input-icon">
                                            <i class="fa fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    @error('amount')
                                        <span class="error-message">
                                            <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
                                            <i class="fa fa-file-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-checkbox-group">
                                <label class="custom-checkbox" for="contact_before_payment">
                                    <input type="checkbox" id="contact_before_payment"
                                        wire:model="contact_before_payment">
                                    <span class="checkbox-icon"></span>
                                    <span class="checkbox-text">{{ __('Did you contact us before payment?') }}</span>
                                </label>
                                @error('contact_before_payment')
                                    <span class="error-message">
                                        <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
                                        <i class="fa fa-exclamation-circle"></i> {{ $message }}
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
           .form-group,.input-wrapper{position:relative}:root{--primary-color:#78b843;--primary-hover:#68a336;--secondary-color:#4a6741;--success-color:#5cb85c;--danger-color:#d9534f;--warning-color:#f0ad4e;--info-color:#5bc0de;--light-color:#f9fcf7;--dark-color:#2c3e2e;--border-color:#dbe9d3;--input-bg:#ffffff;--card-bg:#ffffff;--body-bg:#f4f9f0;--shadow:0 4px 10px -2px rgba(120, 184, 67, 0.15),0 2px 4px -1px rgba(120, 184, 67, 0.08);--border-radius:0.5rem;--font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif}.contact-info,.payment-form-container{border-radius:var(--border-radius);box-shadow:var(--shadow)}.payment-form-wrapper{padding:2rem 0;font-family:var(--font-family);background-color:var(--body-bg);min-height:100vh}.container{width:100%;max-width:1200px;margin:0 auto;padding:0 1rem}.form-header{text-align:center;margin-bottom:2.5rem}.brand-logo{max-width:200px;margin:0 auto 1.5rem;display:block}.form-title{color:var(--dark-color);font-size:2.25rem;font-weight:700;margin-bottom:.75rem}.contact-info,.form-subtitle,.input-icon{color:var(--secondary-color)}.form-subtitle{font-size:1.125rem;margin-bottom:1.5rem;max-width:700px;margin-left:auto;margin-right:auto}.contact-info{background:var(--light-color);padding:1rem 1.5rem;display:inline-flex;align-items:center;gap:.75rem}.contact-info a{color:var(--primary-color);text-decoration:none;font-weight:500}.contact-info a:hover{text-decoration:underline}.payment-form-container{max-width:900px;margin:0 auto 2rem;background:var(--card-bg);padding:2.5rem}.modern-form .form-control{width:100%;padding:.875rem 1rem .875rem 2.5rem;border:1px solid var(--border-color);border-radius:var(--border-radius);font-size:1rem;line-height:1.5;color:var(--dark-color);background-color:var(--input-bg);transition:.2s ease-in-out}.modern-form .form-control:focus{outline:0;border-color:var(--primary-color);box-shadow:0 0 0 3px rgba(37,99,235,.2)}[dir=rtl] .modern-form .form-control{padding:.875rem 2.5rem .875rem 1rem}.modern-form select.form-control{appearance:none;background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");background-repeat:no-repeat;background-position:right .75rem center;background-size:1em;padding-right:2.5rem}[dir=rtl] .modern-form select.form-control{background-position:left .75rem center;padding-right:2.5rem;padding-left:2.5rem}.modern-form textarea.form-control{padding-left:1rem;padding-top:1rem;min-height:120px}[dir=rtl] .modern-form textarea.form-control{padding-right:1rem}.form-row{display:flex;gap:1.5rem;margin-bottom:1.5rem;flex-wrap:wrap}.form-group{flex:1;min-width:280px}.form-group label{display:block;margin-bottom:.5rem;font-weight:500;color:var(--dark-color)}.required::after{content:"*";color:var(--danger-color);margin-left:.25rem}.input-icon{position:absolute;left:1rem;top:50%;transform:translateY(-50%)}.error-message,.form-error-alert,.has-error .input-icon{color:var(--danger-color)}[dir=rtl] .input-icon{left:auto;right:1rem}.textarea-wrapper .textarea-icon{top:1.25rem;transform:none}.has-error .form-control{border-color:var(--danger-color)}.error-message{font-size:.875rem;display:flex;align-items:center;gap:.375rem;margin-top:.5rem}.form-error-alert{background:#fdf5f5;padding:1.25rem;border-radius:var(--border-radius);margin-bottom:2rem;display:flex;gap:1rem;border-left:4px solid var(--danger-color)}.error-icon{font-size:1.5rem;line-height:1}.checkbox-text,.error-content{flex:1}.error-list{margin-top:.75rem;padding-left:1.5rem}.error-list li{margin-bottom:.375rem}.form-checkbox-group{margin:1.5rem 0}.custom-checkbox{display:flex;align-items:flex-start;cursor:pointer;position:relative}.custom-checkbox input[type=checkbox]{position:absolute;opacity:0;cursor:pointer;height:0;width:0}.checkbox-icon{position:relative;display:inline-block;min-width:20px;height:20px;background-color:var(--input-bg);border:2px solid var(--border-color);border-radius:4px;margin-right:.75rem;margin-top:2px;transition:.2s}.contact-btn,.submit-btn{transition:background .3s}[dir=rtl] .checkbox-icon{margin-right:0;margin-left:.75rem}.custom-checkbox input[type=checkbox]:checked~.checkbox-icon{background-color:var(--primary-color);border-color:var(--primary-color)}.custom-checkbox input[type=checkbox]:checked~.checkbox-icon:after{content:'';position:absolute;left:6px;top:2px;width:5px;height:10px;border:solid #fff;border-width:0 2px 2px 0;transform:rotate(45deg)}.custom-checkbox input[type=checkbox]:focus~.checkbox-icon{box-shadow:0 0 0 3px rgba(var(--primary-rgb),.3)}.button-row{margin-top:2rem}.submit-btn{background:var(--primary-color);color:#fff;padding:1rem 2rem;border:none;border-radius:var(--border-radius);cursor:pointer;width:100%;font-size:1.125rem;font-weight:600;display:flex;justify-content:center;align-items:center;gap:.75rem;box-shadow:0 2px 4px rgba(37,99,235,.2)}.checkout-disabled,.contact-btn{border-radius:var(--border-radius)}.contact-btn:hover,.submit-btn:hover{background:var(--primary-hover)}.submit-btn:disabled{opacity:.7;cursor:not-allowed}.checkout-disabled{max-width:700px;background:#fff;color:var(--secondary-color);padding:2.5rem;text-align:center;margin:2rem auto;box-shadow:var(--shadow);border-top:4px solid var(--primary-color)}.checkout-disabled i{font-size:3rem;margin-bottom:1.5rem;display:block}.checkout-disabled p{font-size:1.25rem;margin-bottom:1.5rem;color:var(--dark-color)}.contact-btn{display:inline-flex;align-items:center;gap:.5rem;background:var(--primary-color);color:#fff;text-decoration:none;padding:.875rem 1.5rem;font-weight:500}.captcha-row{justify-content:center;margin-top:1.5rem}.captcha-container{transform:scale(1);transform-origin:left center;margin:0 auto}[dir=rtl] .captcha-container{transform-origin:right center}@media (max-width:768px){.payment-form-container{padding:1.5rem}.form-title{font-size:1.75rem}.form-row{flex-direction:column;gap:1rem}.form-group{width:100%;min-width:auto}.custom-checkbox label{padding-top:0}.captcha-container{transform:scale(.9);margin:0}}@media (max-width:480px){.payment-form-container{padding:1.25rem}.form-header{margin-bottom:2rem}.captcha-container{transform:scale(.85);margin:0}.submit-btn{padding:.875rem 1.5rem}}        </style>
    @endpush

    <script>
        function captchaCompleted(response) {
            @this.set('recaptcha', response);
        }
    </script>
</div>
