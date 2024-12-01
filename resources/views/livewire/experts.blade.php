  <x-slot name="header">
   <h2> {{__('Experts')}} </h2>
  </x-slot>

<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <section class="bg-team-section">
        <div class="container">
            <!-- Filters -->
            <div class="row">

                <div class="col-4 my-5">
                    <select wire.igoner class="select-2 select-2-gov" name="state" style="width:100%;margin-bottom:20px"
                        wire:model.live="selectedState">
                        @foreach ($governorates as $gov)
                            <option value="{{ $gov->slug }}">{{ $gov->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <!-- .row -->
            <!-- Experts List -->
            <div class="row">
                @foreach ($experts as $expert)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="volunteers-items">
                            <!-- Image -->
                            <div class="volunteers-img">
                                <img src="{{ $expert->getFirstMediaUrl('image') }}"
                                    alt="{{ $expert->{'sir_name_' . app()->getLocale()} }}" class="img-responsive" />
                            </div>
                            <!-- .volunteers-img -->

                            <!-- Content -->
                            <div class="volunteers-content">
                                <h4>
                                    <a href="{{ route('experts.view', $expert->id) }}">
                                        {{ $expert->{'sir_name_' . app()->getLocale()} }}
                                    </a>
                                </h4>
                                <p>{{ $expert->ba_major }}</p>
                                <p>{{ $expert->governorate->name }}</p>
                                <p>{{ $expert->city->name }}</p>
                            </div>
                            <!-- .volunteers-content -->
                        </div>
                        <!-- .volunteers-items -->
                    </div>
                    <!-- .col-lg-3 -->
                @endforeach
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>
    <!-- .bg-team-section -->
</div>
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
                    //$('select').select2()
                    //initializeSelect2();
                });
            });
        });
        // Function to initialize Select2
        function initializeSelect2() {
            $('.select-2').select2({
                theme: "bootstrap-5",
                width: 'resolve', // Optional for better width management
            }).on("change", function() {
                // Update Livewire property when Select2 changes
                @this.set("selectedState", $(this).val());
            });

            console.log("Select2 initialized or re-initialized.");
        }
    </script>
@endscript
