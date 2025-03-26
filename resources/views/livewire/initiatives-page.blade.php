<x-slot name="header">
    <div class="page-header">
        <h2 class="capitalize">{{ $pageTitle }}</h2>
    </div>
</x-slot>

<div class="supporters-section">
    <div class="container">
        <div x-data="inititavis" class="supporters-container">
            <!-- Initiatives Tabs -->
            <div class="initiatives-tabs">
                @foreach ($initiatives as $initiative)
                    <button 
                        @if ($loop->first) x-init="supporters = @JS($initiative->supporters); supporter = @JS($initiative->supporters[0])" @endif
                        x-on:click="loadSupporters({{ $loop->index }})"
                        :class="{ 'active': activeInitiativeIndex === {{ $loop->index }} }"
                        class="initiative-tab">
                        {{ $initiative->title }}
                    </button>
                @endforeach
            </div>
            
            <div class="content-wrapper">
                <!-- Supporters Sidebar -->
                <div class="supporters-sidebar">
                    <div class="sidebar-header">
                        <h3>{{ __('Supporters') }}</h3>
                    </div>
                    <div class="supporters-list">
                        <template x-for="(sup, index) in supporters">
                            <div 
                                x-on:click="loadSupporter(sup, index)" 
                                :class="{ 'active': index === activeIndex }"
                                class="supporter-list-item">
                                <span x-text="sup.name.{{ app()->getLocale() }}"></span>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Supporter Details -->
                <div class="supporter-details">
                    <template x-if="supporter !== null">
                        <div class="supporter-content">
                            <!-- Supporter Header -->
                            <div class="supporter-header">
                                <div class="supporter-logo">
                                    <img :src="supporter.media[0].original_url" alt="Supporter logo" class="logo-img">
                                </div>
                                <div class="supporter-title">
                                    <h2 x-text="supporter.name && supporter.name.{{ app()->getLocale() }}"></h2>
                                </div>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="info-card">
                                <div class="card-header">
                                    <h3>{{ __('Contact Information') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="info-rows">
                                        <!-- Location -->
                                        <div class="info-row">
                                            <div class="info-label">
                                                <i class="fa fa-map-marker-alt"></i>
                                                <span>{{ __('Location') }}</span>
                                            </div>
                                            <div class="info-value" x-text="supporter.location.{{ app()->getLocale() }}"></div>
                                        </div>
                                        
                                        <!-- Website -->
                                        <div class="info-row">
                                            <div class="info-label">
                                                <i class="fa fa-globe"></i>
                                                <span>{{ __('Website') }}</span>
                                            </div>
                                            <div class="info-value">
                                                <a :href="supporter.website" target="_blank" class="website-link" 
                                                   x-text="supporter.website ? '{{ __('Visit') }}' : '{{ __('Unavailable') }}'"></a>
                                            </div>
                                        </div>
                                        
                                        <!-- Contact Info -->
                                        <div class="info-row">
                                            <div class="info-label">
                                                <i class="fa fa-envelope"></i>
                                                <span>{{ __('Contact info') }}</span>
                                            </div>
                                            <div class="info-value" x-text="supporter.contact_info || '{{ __('Unavailable') }}'"></div>
                                        </div>
                                        
                                        <!-- Phone -->
                                        <div class="info-row">
                                            <div class="info-label">
                                                <i class="fa fa-phone"></i>
                                                <span>{{ __('Phone') }}</span>
                                            </div>
                                            <div class="info-value" x-text="supporter.phone || '{{ __('Unavailable') }}'"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Support Details -->
                            <div class="info-card">
                                <div class="card-header">
                                    <h3>{{ __('Support Details') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="info-rows">
                                        <!-- Project Types -->
                                        <div class="info-row">
                                            <div class="info-label">
                                                <i class="fa fa-project-diagram"></i>
                                                <span>{{ __('Supported project types') }}</span>
                                            </div>
                                            <div class="info-value">
                                                <div class="tags-wrapper" x-show="supporter.supported_project_types && supporter.supported_project_types.length > 0">
                                                    <template x-for="type in supporter.supported_project_types">
                                                        <div class="tag-item" x-text="type.name.{{ app()->getLocale() }}"></div>
                                                    </template>
                                                </div>
                                                <span x-show="!supporter.supported_project_types || supporter.supported_project_types.length === 0">
                                                    {{ __('No supported project types') }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <!-- Supported Projects -->
                                        <div class="info-row">
                                            <div class="info-label">
                                                <i class="fa fa-tasks"></i>
                                                <span>{{ __('Supported projects') }}</span>
                                            </div>
                                            <div class="info-value">
                                                <div class="tags-wrapper" x-show="supporter.supported_projects && supporter.supported_projects.length > 0">
                                                    <template x-for="project in supporter.supported_projects">
                                                        <div class="tag-item" x-text="project.name.{{ app()->getLocale() }}"></div>
                                                    </template>
                                                </div>
                                                <span x-show="!supporter.supported_projects || supporter.supported_projects.length === 0">
                                                    {{ __('No supported projects') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- About Supporter -->
                            <div class="info-card">
                                <div class="card-header">
                                    <h3>{{ __('About') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="about-content" x-text="supporter.about.{{ app()->getLocale() }}"></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
    

<style>
:root {
    --primary-color: #78b843;
    --primary-hover: #68a336;
    --secondary-color: #4a6741;
    --dark-color: #2c3e2e;
    --light-color: #f9fcf7;
    --border-color: #dbe9d3;
    --text-color: #333;
    --meta-color: #666;
    --bg-light: #f4f9f0;
}

/* Page Header */
.page-header {
    margin-bottom: 20px;
}

.page-header h2 {
    color: var(--dark-color);
    font-weight: 600;
}

/* Supporters Section */
.supporters-section {
    padding: 30px 0 60px;
    background-color: var(--light-color);
}

.supporters-container {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

/* Initiative Tabs */
.initiatives-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 15px;
}

.initiative-tab {
    background-color: var(--dark-color);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.initiative-tab:hover {
    background-color: #3a4f3c;
}

.initiative-tab.active {
    background-color: var(--primary-color);
}

/* Content Wrapper - RTL Aware */
.content-wrapper {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 25px;
}

/* html[dir="rtl"] .content-wrapper {
    grid-template-columns: 1fr 300px;
} */

/* Supporters Sidebar */
.supporters-sidebar {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
    height: fit-content;
}

.sidebar-header {
    background-color: var(--primary-color);
    color: white;
    padding: 15px 20px;
}

.sidebar-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.supporters-list {
    padding: 10px 0;
}

.supporter-list-item {
    padding: 12px 20px;
    border-bottom: 1px solid var(--border-color);
    cursor: pointer;
    transition: all 0.2s ease;
}

.supporter-list-item:hover {
    background-color: var(--light-color);
}

.supporter-list-item.active {
    background-color: var(--primary-color);
    color: white;
}

/* Supporter Details */
.supporter-details {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
}

.supporter-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 20px;
}

/* Supporter Header */
.supporter-header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border-color);
}

html[dir="rtl"] .supporter-header {
    flex-direction: row-reverse;
}

.supporter-logo {
    width: 120px;
    height: 120px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.supporter-title h2 {
    margin: 0;
    color: var(--dark-color);
    font-size: 28px;
    font-weight: 600;
}

/* Info Card */
.info-card {
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid var(--border-color);
}

.card-header {
    background-color: var(--light-color);
    padding: 12px 20px;
    border-bottom: 1px solid var(--border-color);
}

.card-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: var(--dark-color);
}

.card-body {
    padding: 20px;
}

/* Info Rows - New Structure for RTL */
.info-rows {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-row {
    display: flex;
    gap: 20px;
}

html[dir="rtl"] .info-row {
    /* flex-direction: row-reverse; */
}

.info-label {
    flex: 0 0 200px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--meta-color);
    font-size: 14px;
    font-weight: 500;
}

html[dir="rtl"] .info-label {
    /* flex-direction: row-reverse; */
    text-align: right;
}

.info-label i {
    color: var(--primary-color);
    width: 16px;
    text-align: center;
}

.info-value {
    flex: 1;
    color: var(--text-color);
    font-size: 16px;
}

html[dir="rtl"] .info-value {
    text-align: right;
}

.website-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.website-link:hover {
    color: var(--primary-hover);
    text-decoration: underline;
}

/* Tags */
.tags-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag-item {
    display: inline-block;
    background-color: var(--bg-light);
    color: var(--secondary-color);
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 14px;
}

/* About Content */
.about-content {
    font-size: 16px;
    line-height: 1.6;
    color: var(--text-color);
}

html[dir="rtl"] .about-content {
    text-align: right;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .content-wrapper {
        grid-template-columns: 1fr;
    }
    
    html[dir="rtl"] .content-wrapper {
        grid-template-columns: 1fr;
    }
    
    .info-row {
        flex-direction: column;
        gap: 10px;
    }
    
    html[dir="rtl"] .info-row {
        flex-direction: column;
    }
    
    .info-label {
        flex: 0 0 auto;
    }
    
    .supporter-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    html[dir="rtl"] .supporter-header {
        flex-direction: column;
    }
    
    .supporter-title {
        text-align: center;
    }
}

@media (max-width: 767px) {
    .supporters-section {
        padding: 20px 0 40px;
    }
    
    .initiative-tab {
        flex: 1 0 calc(50% - 10px);
        text-align: center;
    }
    
    html[dir="rtl"] .initiative-tab {
        text-align: center;
    }
}
</style>
@endpush
@script
<script>
    Alpine.data('inititavis', () => ({
        init() {
            this.inititaives = @JS($initiatives);
        },
        active: false,
        activeIndex: 0,
        activeInitiativeIndex: 0,
        inititaives: null,
        supporters: [],
        supporter: null,
        
        loadSupporter(sup, index) {
            this.supporter = sup;
            this.activeIndex = index;
            
            // Scroll to top of supporter details on mobile
            if (window.innerWidth < 992) {
                document.querySelector('.supporter-details').scrollIntoView({ behavior: 'smooth' });
            }
        },
        
        loadSupporters(index) {
            this.supporters = this.inititaives[index].supporters;
            
            // Reset the active supporter to the first one in the list
            if (this.supporters && this.supporters.length > 0) {
                this.supporter = this.supporters[0];
                this.activeIndex = 0;
            } else {
                this.supporter = null;
            }
            
            this.activeInitiativeIndex = index;
        }
    }))
</script>
@endscript