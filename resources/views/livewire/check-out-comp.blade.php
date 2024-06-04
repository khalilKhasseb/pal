@php
    $rtl = app()->getLocale() === 'ar';
@endphp

<div>
    <div class="container py-5">
        <h2 class="mb-4 text-center display-2">{{ __('Sponsorship & Donation') }}</h2>

        <p class="mb-3 text-sm text-center text-muted lead h6 small lh-1">
            {{ __('For those interested in supporting the council’s activities through sponsorship and/or donation, please contact us through the e-mail: admin@palgbc.org') }}
        </p>
        <hr />

        @if ($this->checkoutEnabled())
            <div class="row align-items-center justify-content-center">
                <div class="col-7 ">
                    <form
                        style="
                        background: #eee;
                        padding: 10px;
                        border-radius: 5px;
                        box-shadow: 0 0 5px 0 #eee;
                     "
                        class="needs-validation" wire:submit="proccessPayment">
                        <div class="row">
                            <div class="col-6">
                                <div class="my-2 form-check d-flex justify-content-start align-items-center">
                                    <label class=" form-check-label" for="contactedBefore">
                                        {{ __('Did you contact us before payment?') }}
                                    </label>
                                    <input wire:model="form.contact_before" class="form-check-input" type="checkbox"
                                        value="" id="contactedBefore">
                                    @error('form.contact_before')
                                        <span class="is-invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 has-validation">
                                <label class="required" for="paymentPurpose">{{ __('Payment purpose') }}</label>
                                <select required wire:model="form.payment_purpose" id="paymentPurpose"
                                    class="mb-3 form-select" aria-label=".form-select">
                                    <option selected>{{ __('Select value') }}</option>
                                    <option value="donate">{{ __('Donate') }}</option>
                                    <option value="membership_cost">{{ __('Membership cost') }}</option>
                                    <option value="cource_cost">{{ __('Cource cost') }}</option>
                                    <option value="adv_cost">{{ __('Ads cost') }}</option>
                                    <option value="sponser">{{ __('Sponser') }}</option>
                                    <option value="other">{{ __('Others') }}</option>
                                </select>
                                @error('form.payment_purpose')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6 has-validation">

                                <label class="required" for="paymentType">{{ __('Payment type') }}</label>
                                <select required wire:model="form.payment_type" id="paymentType"
                                    class="mb-3 form-select" aria-label=".form-select ">
                                    <option value="indivisuial">{{ __('Indivusials') }}</option>
                                    <option value="company">{{ __('Companies') }}</option>
                                    <option value="orgnization">{{ __('Orginizations') }}</option>
                                </select>
                                @error('form.payment_type')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <hr />
                        <div class="mb-1 row">
                            <div class="col-4">
                                <label class="required" for="firstName">{{ __('First name') }}</label>
                                <input required id="firstName" wire:model="form.first_name" type="text"
                                    class="p-2 rounded form-control">
                                @error('form.first_name')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-4">
                                <label class="required" for="midName">{{ __('Middel name') }}</label>
                                <input required wire:model="form.mid_name" id="midName" type="text"
                                    class="p-2 rounded form-control">
                                @error('from.mid_name')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-4">
                                <label class="required" for="lastName">{{ __('Last name') }}</label>
                                <input required id="lastName" wire:model="form.last_name" type="text"
                                    class="p-2 rounded form-control">
                                @error('form.last_name')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                        <div class="mb-1 col-12">
                            <label class="required" for="amount">{{ __('Amount') }}</label>
                            <input required wire:model="form.amount" id="amount" type="number"
                                class="p-2 rounded form-control">
                            @error('form.amount')
                                <span class="is-invalid">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-1 row">
                            <div class="col-4">
                                <label class="required" for="phone">{{ __('Phone') }}</label>
                                <input required id="phone" wire:model="form.phone" type="text"
                                    class="p-2 rounded form-control">
                                @error('form.phone')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-4">
                                <label class="required" for="email">{{ __('Email') }}</label>
                                <input required id="email" wire:model='form.email' type="text"
                                    class="p-2 rounded form-control">
                                @error('form.email')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-4">
                                <label class="required" for="address">{{ __('Address') }}</label>
                                <input required id="address" wire:model='form.address' type="text"
                                    class="p-2 rounded form-control">
                                @error('form.address')
                                    <span class="is-invalid">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="mb-1 row">
                            <div class="col-12">
                                <label for="paymentDetails">{{ __('Payment Details') }}</label>
                                <textarea class="form-control" wire:model="form.payment_details" id="paymentDetails" cols="30" rows="10"></textarea>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-default w-25 d-flex justify-content-between"
                            style="margin-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}:auto">
                            <span>
                                {{ __('Pay') }}
                            </span>
                            <div wire:loading class="spinner-border text-primary"
                                style="width:15px;height:15px; margin-top:5px" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                        </button>
                    </form>
                </div>

            </div>
    </div>

    <div x-data="modal_data">

        <!-- Modal -->
        <div style="position: fixed; right:0;left:0" x-ref="modal"
            class="modal fade modal-dialog modal-lg modal-dialog-centered" id="staticBackdrop"
            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex jusitfy-content-between">
                        <span class="d-inline-block display-6">{{ __('Confirm Payment') }}</span>
                        <button
                            style="margin:-.5rem {{ $rtl ? 'auto' : '-.5rem' }} -.5rem {{ $rtl ? '-.5rem' : 'auto' }}"
                            type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="order">

                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Full name</th>
                                        <th scope="col">Order</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td x-text="payment.first_name+payment.mid_name+payment.last_name"></td>
                                        <td x-text="payment.order.title"></td>
                                        <td x-text="payment.amount"></td>
                                        <td x-text="payment.payment_purpose"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <p x-text="cap.message"></p>


                        <form x-ref="confirm_form" id="formHidden" action="{{ $auth_url }}">

                            @foreach ($form->inputParam as $key => $value)
                                <input hidden name="{{ $key }}" value="{{ $value }}">
                            @endforeach

                            {{-- <button id="cbutton" class="g-recaptcha">Submit</button> --}}
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button x-on:click="capClick"
                            class="g-recaptcha btn btn-primary d-flex justify-content-center">
                            <span>{{ __('Confirm') }}</span>
                            <div wire:loading class=" spinner-border text-secondary"
                                style="width:15px;height:15px; margin-top:5px" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                        </button>
                        <button x-on:click="closeModal" type="button"
                            class="btn btn-secondary">{{ __('Close') }}</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @assets
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('google.cap.site_key') }}" async></script>
    @endassets
    @script
        <script>
            Alpine.data('modal_data', () => {
                return {
                    modal: null,
                    cap: {},
                    payment: null,
                    init() {
                        this.modal = new bootstrap.Modal(this.$refs.modal, {
                            backdrop: 'static'
                        });
                        $wire.on('paymentCreated', (param) => {
                            this.modal.show();
                            [{
                                payment,
                                inputs
                            }] = param;
                            this.payment = payment
                            // this.payment = param[0];
                            console.log(param)
                        });
                        $wire.on('cap-confirmed', (reponse) => {
                            [{
                                message,
                                success
                            }] = reponse;

                            if (success) {
                                // submit form but befor give the message to user
                                this.cap.message = message;

                                const interval = setInterval(() => {
                                    this.$refs.confirm_form.submit();
                                }, 1000);
                            }
                        });

                    },
                    capClick() {
                        grecaptcha.ready(function() {
                            grecaptcha.execute("{{ config('google.cap.site_key') }}", {
                                action: 'submit'
                            }).then(function(token) {
                                // Add your logic to submit to your backend server here.
                                // console.log(token,$wire);
                                // $wire.set('cap', token);
                                $wire.virify(token);
                            });
                        });

                    },
                    closeModal() {
                        this.modal.hide();
                        $wire.deletePayment(this.payment.id)
                    }
                }
            })
        </script>
    @endscript
    @endif

</div>
