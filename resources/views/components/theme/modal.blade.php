@props(['buttonTitle' => null])
@php
    $rtl = app()->getLocale() === 'ar';
@endphp
<div x-data="{
    modal: null,
}" x-init="this.modal = new bootstrap.Modal($refs.modal, {
    backdrop: 'static'
});

$wire.on('paymentCreated', (param) => {
    this.modal.show()
});

this.modal.show();">

    <!-- Modal -->
    <div x-ref="modal" class="modal fade modal-dialog modal-dialog-centered" id="staticBackdrop" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex jusitfy-content-between">
                    {{ $title }}
                    <button style="margin:-.5rem {{ $rtl ? 'auto' : '-.5rem' }} -.5rem {{ $rtl ? '-.5rem' : 'auto' }}"
                        type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    {{ $footer }}
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>

                </div>
            </div>
        </div>
    </div>
</div>
