<x-slot name="header">
    <div class="experts-header">
        <h2>{{ __('Experts') }}</h2>
    </div>
</x-slot>

<div class="experts-wrapper">
    <div class="container">
        <!-- Header -->
        <div class="section-header">
            <h2 class="section-title">{{ __('Our Experts Directory') }}</h2>
            <div class="title-underline">
                <span class="line"></span>
                <span class="dot"></span>
                <span class="line"></span>
            </div>
            <p class="section-subtitle">{{ __('Meet our team of experts from various fields.') }}</p>
        </div>

        <!-- Filters -->
        <div class="filter-section">
            <div class="filter-container">
                <div class="filter-group">
                    <label for="governorate" class="filter-label">{{ __('Governorate') }}</label>
                    <div class="select-wrapper">
                        <select id="governorate" class="filter-select" style="width:100%;"
                            wire:model.live="selectedState">
                            <option value="all">{{ __('All experts') }}</option>
                            @foreach ($governorates as $gov)
                                <option value="{{ $gov->slug }}">{{ $gov->name }}</option>
                            @endforeach
                        </select>
                        <div class="select-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Experts List -->
        <div class="experts-grid">
            @foreach ($experts as $expert)
                <div class="expert-item">
                    <div class="expert-card">
                        <div class="expert-image-container">
                            <img src="{{ $expert->getFirstMediaUrl('image') ?: '' }}" class="expert-image" 
                                alt="{{ $expert->first_name . ' ' . $expert->sir_name_ar }}"
                                onerror="this.onerror=null; this.outerHTML='<div class=\'expert-image-fallback\'><span>{{ strtoupper(substr($expert->{'sir_name_' . app()->getLocale()}, 0, 1)) }}</span></div>'">
                                
                            @if($expert->certificates && $expert->certificates->count() > 0)
                            <div class="expert-badge" title="{{ $expert->certificates->implode('certificate_name', ', ') }}">
                                <i class="fa fa-graduation-cap"></i>
                                <span>{{ $expert->certificates->count() }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="expert-content">
                            <h3 class="expert-name">
                                <a href="{{ route('experts.view', $expert->id) }}">
                                    {{ $expert->first_name . ' ' . $expert->sir_name_ar }}
                                </a>
                            </h3>
                            
                            <div class="expert-specialization">
                                {{ $expert->ba_major }}
                            </div>
                            
                            <div class="expert-meta">
                                <div class="expert-location">
                                    <i class="fa fa-map-marker"></i>
                                    <span>{{ $expert->governorate->name }}</span>
                                </div>
                                
                                <div class="expert-credentials">
                                    <span class="credential-tag">
                                        {{ Str::limit($expert->certificates->implode('certificate_name', ', '), 40) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="expert-action">
                                <a href="{{ route('experts.view', $expert->id) }}" class="view-profile-btn">
                                    {{ __('View Profile') }}
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($experts->isEmpty())
                <div class="experts-empty">
                    @include($skyTheme . '.partial.empty')
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
/* Experts Page Styling */
.expert-card,.filter-container{box-shadow:0 5px 15px rgba(0,0,0,.05)}:root{--primary-color:#78b843;--primary-hover:#68a336;--secondary-color:#4a6741;--dark-color:#2c3e2e;--light-color:#f9fcf7;--border-color:#dbe9d3;--text-color:#333;--meta-color:#666;--bg-light:#f4f9f0}.experts-header h2{color:var(--light-color);font-weight:600}.experts-wrapper{padding:60px 0;background-color:var(--light-color)}.section-header{text-align:center;margin-bottom:40px}.section-title{font-size:2.25rem;color:var(--dark-color);font-weight:700;margin-bottom:15px}.title-underline{display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:20px}.title-underline .line{height:2px;width:30px;background-color:var(--primary-color)}.title-underline .dot{width:8px;height:8px;border-radius:50%;background-color:var(--primary-color)}.section-subtitle{font-size:1.125rem;color:var(--secondary-color);max-width:700px;margin-left:auto;margin-right:auto}.filter-section{margin-bottom:40px}.filter-container{max-width:600px;margin:0 auto;padding:25px;background-color:#fff;border-radius:10px}.filter-group{margin-bottom:10px}.filter-label{display:block;font-weight:600;color:var(--dark-color);margin-bottom:8px}.select-wrapper{position:relative}.filter-select{width:100%;padding:12px 40px 12px 15px;border:1px solid var(--border-color);border-radius:8px;font-size:1rem;color:var(--text-color);background-color:var(--light-color);appearance:none;-webkit-appearance:none;-moz-appearance:none}.filter-select:focus{outline:0;border-color:var(--primary-color);box-shadow:0 0 0 3px rgba(120,184,67,.2)}.select-icon{position:absolute;right:15px;top:50%;transform:translateY(-50%);color:var(--primary-color);pointer-events:none}.experts-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:25px}.expert-item{height:100%}.expert-card{background-color:#fff;border-radius:10px;overflow:hidden;height:100%;display:flex;flex-direction:column;transition:transform .3s,box-shadow .3s}.expert-card:hover{transform:translateY(-5px);box-shadow:0 15px 25px rgba(0,0,0,.1)}.expert-image-container{position:relative;height:220px;overflow:hidden}.expert-image{width:100%;height:100%;object-fit:cover;transition:transform .5s}.expert-card:hover .expert-image{transform:scale(1.05)}.expert-image-fallback{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background-color:var(--primary-color)}.expert-image-fallback span{font-size:4rem;color:#fff;font-weight:600}.expert-badge{position:absolute;top:15px;right:15px;background-color:rgba(120,184,67,.9);color:#fff;border-radius:5px;padding:5px 10px;font-size:12px;display:flex;align-items:center;gap:5px;z-index:2}.expert-content{padding:20px;display:flex;flex-direction:column;flex-grow:1}.expert-name{font-size:1.25rem;margin-bottom:8px}.expert-name a{color:var(--dark-color);text-decoration:none;transition:color .2s}.expert-location i,.expert-name a:hover,.expert-specialization{color:var(--primary-color)}.expert-specialization{font-size:1rem;font-weight:500;margin-bottom:12px}.expert-meta{margin-top:auto;margin-bottom:15px}.expert-location{display:flex;align-items:center;gap:8px;color:var(--meta-color);font-size:.9rem;margin-bottom:8px}.expert-credentials{display:flex;flex-wrap:wrap;gap:6px}.credential-tag{color:var(--meta-color);font-size:.85rem;line-height:1.4}.expert-action{margin-top:auto;border-top:1px solid var(--border-color);padding-top:15px}.view-profile-btn{display:inline-flex;align-items:center;gap:8px;color:var(--primary-color);text-decoration:none;font-weight:600;transition:.2s}.view-profile-btn:hover{color:var(--primary-hover)}.view-profile-btn:hover i{transform:translateX(4px)}.view-profile-btn i{transition:transform .2s}.experts-empty{grid-column:1/-1;padding:40px;text-align:center}[dir=rtl] .filter-select{padding:12px 15px 12px 40px}[dir=rtl] .expert-badge,[dir=rtl] .select-icon{right:auto;left:15px}[dir=rtl] .view-profile-btn i{transform:rotate(180deg)}[dir=rtl] .view-profile-btn:hover i{transform:rotate(180deg) translateX(4px)}@media (max-width:991px){.experts-wrapper{padding:40px 0}.section-title{font-size:2rem}.experts-grid{grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px}}@media (max-width:767px){.experts-wrapper{padding:30px 0}.section-title{font-size:1.75rem}.section-subtitle{font-size:1rem}.experts-grid{grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:15px}.filter-container{padding:20px}}
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
                // Response received
            });

            succeed(({
                snapshot,
                effect
            }) => {
                // Wait for DOM to update before reinitializing
                setTimeout(() => {
                    initializeSelect2();
                });
            });
        });
    });

    function initializeSelect2() {
        // Check if Select2 is available
        if (typeof $.fn.select2 !== 'undefined') {
            // Get the select element
            const selectElement = $('#governorate');
            
            // Skip if already initialized with Select2
            if (selectElement.hasClass('select2-hidden-accessible')) {
                return;
            }
            
            selectElement.select2({
                theme: "classic",
                placeholder: "{{ __('Select a governorate') }}",
                allowClear: true
            }).on('change', function(e) {
                // Find the correct Livewire component that owns this select
                const wireId = $(this).closest('[wire\\:id]').attr('wire:id');
                
                if (wireId) {
                    // Get the Livewire component by wire:id
                    const component = window.Livewire.find(wireId);
                    
                    if (component) {
                        // Get the current value
                        const value = $(this).val();
                        
                        // Update the Livewire property
                        component.set('selectedState', value);
                    }
                }
            });
        }
    }
</script>
@endscript