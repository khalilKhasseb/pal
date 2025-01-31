<x-slot name="header">
    <h2> {{ __('Experts') }} </h2>
</x-slot>

<div class="experts-wrapper bg-light py-5">
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold">{{ __('Experts') }}</h2>
            <p class="lead text-muted">{{ __('Meet our team of experts from various fields.') }}</p>
        </div>

        <!-- Filters -->
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-6">
                <label for="governorate" class="form-label">{{ __('Governorate') }}</label>
                <select id="governorate" class="form-select form-select-lg shadow-sm" style="width:100%;"
                    wire:model.live="selectedState">
                    <option value="all">{{ __('All experts') }}</option>
                    @foreach ($governorates as $gov)
                        <option value="{{ $gov->slug }}">{{ $gov->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Experts List -->
        <div class="row g-4">
            @foreach ($experts as $expert)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                        <div class="position-relative">
                            <img src="{{ $expert->getFirstMediaUrl('image') ?: '' }}" class="card-img-top w-100"
                                alt="{{ $expert->{'sir_name_' . app()->getLocale()} }}"
                                onerror="this.onerror=null; this.outerHTML='<svg class=\'card-img-top w-100\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 100 100\'><rect width=\'100%\' height=\'100%\' fill=\'#28a745\'/><text x=\'50%\' y=\'50%\' dominant-baseline=\'middle\' text-anchor=\'middle\' fill=\'white\' font-size=\'40\' font-family=\'Arial, sans-serif\'>{{ strtoupper(substr($expert->{'sir_name_' . app()->getLocale()}, 0, 1)) }}</text></svg>'">
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title mb-2">
                                    <a href="{{ route('experts.view', $expert->id) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $expert->{'sir_name_' . app()->getLocale()} }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted mb-1">{{ $expert->ba_major }}</p>
                                <p class="card-text mb-1"><small
                                        class="text-muted">{{ $expert->governorate->name }}</small></p>
                                <p class="card-text"><small
                                        class="text-muted">{{ $expert->certificates->implode('certificate_name', ', ') }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($experts->isEmpty())
                @include($skyTheme . '.partial.empty')
            @endif
        </div>
    </div>
</div>

@push('styles')
    <style>
        .experts-wrapper {
            background-color: #f8f9fa;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15);
            transition: all 0.3s ease;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

@script
    <script>
        document.addEventListener("livewire:initialized", () => {

            // Initialize Select2 on the first load
            initializeSelect2();

            // Listen for Livewire DOM updates
            Livewire.hook("request", ({
                respond,
                succeed
            }) => {
                respond(() => {
                    //console.log("Response received, but not yet processed.");
                });

                succeed(({
                    snapshot,
                    effect
                }) => {
                    // console.log("Livewire response processed successfully.");

                    setTimeout(() => {
                        initializeSelect2();

                    })
                    // Reinitialize Select2 after DOM update
                    //console.log(window.select2);
                    //$('.select-2-gov').attr('data-select-test', 'red');
                });
            });
        });
    </script>
@endscript
