<!-- filepath: /Users/khalilkhasseb/Herd/dev.palgbc.org/resources/views/livewire/payment/payment-form.blade.php -->
@php
    $rtl = app()->getLocale() === 'ar';
@endphp

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Payment Form') }}
    </h2>
</x-slot>

<div>
    <div class="container py-5">
        <h2 class="mb-4 text-center display-2">{{ __('Sponsorship & Donation') }}</h2>

        <p class="mb-3 text-sm text-center text-muted lead h6 small lh-1">
            {{ __('For those interested in supporting the council’s activities through sponsorship and/or donation, please contact us through the e-mail: admin@palgbc.org') }}
        </p>
        <hr />

        @if (true)
            <div class="row align-items-center justify-content-center">
                @error('payment')
                    <div class="alert alert-danger mb-4">
                        <strong>{{ $message }}</strong>
                        @if ($errors->hasAny(array_keys($errors->get('payment.*'))))
                            <ul class="mt-2">
                                @foreach ($errors->get('payment.*') as $field => $messages)
                                    @foreach ($messages as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @enderror
                <div class="col-7">
                    <form
                        style="
                        background: #eee;
                        padding: 10px;
                        border-radius: 5px;
                        box-shadow: 0 0 5px 0 #eee;
                     "
                        class="needs-validation" wire:submit.prevent="submit">

                        <div class="row">
                            <div class="col-6 has-validation">
                                <label class="required mb-1" for="purpose">{{ __('Payment purpose') }}</label>
                                <select required wire:model="purpose" id="purpose" class="mb-3 form-select"
                                    aria-label=".form-select">
                                    <option selected>{{ __('Select value') }}</option>
                                    <option value="donate">{{ __('Donate') }}</option>
                                    <option value="membership_cost">{{ __('Membership cost') }}</option>
                                    <option value="cource_cost">{{ __('Course cost') }}</option>
                                    <option value="adv_cost">{{ __('Ads cost') }}</option>
                                    <option value="sponser">{{ __('Sponsor') }}</option>
                                    <option value="other">{{ __('Others') }}</option>
                                </select>
                                @error('purpose')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 has-validation">
                                <label class="required  mb-1" for="classification">{{ __('Payment type') }}</label>
                                <select required wire:model="classification" id="classification"
                                    class="mb-3 form-select" aria-label=".form-select">
                                    <option value="individual">{{ __('Individuals') }}</option>
                                    <option value="company">{{ __('Companies') }}</option>
                                    <option value="organization">{{ __('Organizations') }}</option>
                                </select>
                                @error('classification')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr />
                        <div class="mb-1 row">
                            <div class="col-4">
                                <label class="required  mb-1" for="full_name">{{ __('Full Name') }}</label>
                                <input required id="full_name" wire:model="full_name" type="text"
                                    class="p-2 rounded form-control">
                                @error('full_name')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="required  mb-1" for="email">{{ __('Email') }}</label>
                                <input required id="email" wire:model="email" type="text"
                                    class="p-2 rounded form-control">
                                @error('email')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="required  mb-1" for="mobile">{{ __('Mobile') }}</label>
                                <input required id="mobile" wire:model="mobile" type="text"
                                    class="p-2 rounded form-control">
                                @error('mobile')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-4">
                                <label class="required mb-1" for="address">{{ __('Address') }}</label>
                                <input required id="address" wire:model="address" type="text"
                                    class="p-2 rounded form-control">
                                @error('address')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label class="required mb-1" for="amount">{{ __('Amount') }}</label>
                                <input required id="amount" wire:model="amount" type="number"
                                    class="p-2 rounded form-control">
                                @error('amount')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-4">
                                <label class="required mb-1" for="currency">{{ __('Currency') }}</label>
                                <input required id="currency" wire:model="currency" type="text"
                                    class="p-2 rounded form-control">
                                @error('currency')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div> --}}
                        </div>


                        <div class="mb-1 row">
                            <div class="col-12">
                                <label class="mb-1" for="paymentDetails">{{ __('Payment Details') }}</label>
                                <textarea class="form-control" wire:model="payment_details" id="paymentDetails" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="my-2 form-check d-flex justify-content-start align-items-center">
                                    <label class="form-check-label" for="contactedBefore">
                                        {{ __('Did you contact us before payment?') }}
                                    </label>
                                    <input wire:model="contact_before_payment" class="form-check-input" type="checkbox"
                                        value="" id="contactedBefore">
                                    @error('contact_before_payment')
                                        <span class="is-invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button wire:click="submit" type="submit" class="btn btn-primary w-100"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>{{ __('Pay') }}</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                {{ __('Processing...') }}
                            </span>
                        </button>

                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
