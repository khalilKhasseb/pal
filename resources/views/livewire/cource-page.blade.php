<x-slot name="header">
    <div class="page-header">
        <h2 class="capitalize">{{ $pageTitle }}</h2>
    </div>
</x-slot>

<div class="courses-section">
    <div class="container">
        <div x-data="courcess_data" class="course-container">
            @unless ($courcess->isEmpty())
                <!-- Course Sidebar -->
                <div class="course-sidebar">
                    <div class="sidebar-header">
                        <h3>{{ __('Courses') }}</h3>
                    </div>
                    <div class="course-list">
                        <template x-for="(_cource, index) in courcess">
                            <div class="course-list-item" 
                                 x-init="if (index === 0) { cource = _cource }"
                                 x-on:click="loadCource(_cource, index)"
                                 :class="{ 'active': activeIndex === index }">
                                <span x-text="_cource.title.{{ app()->getLocale() }}"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Course Details -->
                <div class="course-details">
                    <template x-if="cource !== null">
                        <div class="course-content">
                            <!-- Course Header with Image -->
                            <div class="course-header">
                                <div class="course-image">
                                    <img :src="cource.image" alt="Course image" class="img-responsive">
                                </div>
                                <div class="course-title-container">
                                    <h2 class="course-title" x-text="cource.title.{{ app()->getLocale() }}"></h2>
                                    <div class="course-status" :class="cource.active ? 'active' : 'inactive'">
                                        <i class="fa fa-circle"></i>
                                        <span x-text="cource.active ? '{{ __('Active') }}' : '{{ __('Inactive') }}'"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Course Info Cards -->
                            <div class="course-info-grid">
                                <div class="info-card">
                                    <div class="info-icon">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </div>
                                    <div class="info-content">
                                        <h4>{{ __('Start date') }}</h4>
                                        <p x-text="new Date(cource.start_date).toDateString()"></p>
                                    </div>
                                </div>
                                
                                <div class="info-card">
                                    <div class="info-icon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="info-content">
                                        <h4>{{ __('End date') }}</h4>
                                        <p x-text="new Date(cource.end_date).toDateString()"></p>
                                    </div>
                                </div>
                                
                                <div class="info-card">
                                    <div class="info-icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="info-content">
                                        <h4>{{ __('Fees') }}</h4>
                                        <p x-text="cource.fees"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Description -->
                            <div class="course-detail-card">
                                <div class="card-header">
                                    <h3>{{ __('Description') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div x-html="cource.content.{{ app()->getLocale() }}"></div>
                                </div>
                            </div>

                            <!-- Course Objectives -->
                            <div class="course-detail-card">
                                <div class="card-header">
                                    <h3>{{ __('Objectives') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div x-html="cource.objective.{{ app()->getLocale() }}"></div>
                                </div>
                            </div>

                            <!-- Course Additional Info -->
                            <div class="course-detail-card">
                                <div class="card-header">
                                    <h3>{{ __('Additional Information') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="additional-info-grid">
                                        <div class="info-group">
                                            <div class="info-label">{{ __('Trainer') }}</div>
                                            <div class="info-value" x-text="cource.trainer.{{ app()->getLocale() }}"></div>
                                        </div>
                                        
                                        <div class="info-group">
                                            <div class="info-label">{{ __('Target audince') }}</div>
                                            <div class="info-value" x-text="cource.target_audince.{{ app()->getLocale() }}"></div>
                                        </div>
                                        
                                        <div class="info-group">
                                            <div class="info-label">{{ __('Partners') }}</div>
                                            <div class="info-value" x-text="cource.partners.{{ app()->getLocale() }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Registration Button -->
                            <div class="course-actions">
                                <a :href="cource.form_register" target="_blank"
                                   :class="!cource.form_register ? 'disabled' : ''" 
                                   class="register-btn">
                                    <i class="fa fa-user-plus"></i>
                                    {{ __('Sign up') }}
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            @else
                @include($skyTheme . '.partial.empty')
            @endunless
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
    --card-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    --danger-color: #dc3545;
}

/* Page Header */
.page-header {
    margin-bottom: 20px;
}

.page-header h2 {
    color: var(--dark-color);
    font-weight: 600;
}

/* Courses Section */
.courses-section {
    padding: 30px 0 60px;
    background-color: var(--light-color);
}

/* Main Container */
.course-container {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
}

/* Course Sidebar */
.course-sidebar {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
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

.course-list {
    padding: 10px 0;
}

.course-list-item {
    padding: 12px 20px;
    border-bottom: 1px solid var(--border-color);
    cursor: pointer;
    transition: all 0.2s ease;
}

.course-list-item:hover {
    background-color: var(--light-color);
}

.course-list-item.active {
    background-color: var(--bg-light);
    border-left: 4px solid var(--primary-color);
    font-weight: 500;
    color: var(--primary-color);
}

/* Course Details */
.course-details {
    background-color: white;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
}

.course-content {
    padding: 0;
}

/* Course Header */
.course-header {
    display: flex;
    flex-direction: column;
    background-color: var(--bg-light);
    border-bottom: 1px solid var(--border-color);
}

.course-image {
    width: 100%;
    height: 250px;
    overflow: hidden;
    position: relative;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-title-container {
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.course-title {
    margin: 0;
    font-size: 24px;
    font-weight: 600;
    color: var(--dark-color);
}

.course-status {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
}

.course-status.active {
    background-color: rgba(120, 184, 67, 0.1);
    color: var(--primary-color);
}

.course-status.inactive {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger-color);
}

/* Course Info Grid */
.course-info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 20px;
}

.info-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    border-radius: 8px;
    background-color: var(--light-color);
    border: 1px solid var(--border-color);
}

.info-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: white;
    border-radius: 50%;
    color: var(--primary-color);
    font-size: 22px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.info-content {
    flex: 1;
}

.info-content h4 {
    margin: 0 0 5px 0;
    font-size: 14px;
    color: var(--meta-color);
    font-weight: 500;
}

.info-content p {
    margin: 0;
    font-size: 16px;
    color: var(--dark-color);
    font-weight: 600;
}

/* Course Detail Cards */
.course-detail-card {
    margin: 0 20px 20px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid var(--border-color);
}

.card-header {
    background-color: var(--light-color);
    padding: 15px 20px;
    border-bottom: 1px solid var(--border-color);
}

.card-header h3 {
    margin: 0;
    font-size: 18px;
    color: var(--dark-color);
    font-weight: 600;
}

.card-body {
    padding: 20px;
}

/* Additional Info Grid */
.additional-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.info-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.info-label {
    font-size: 14px;
    color: var(--meta-color);
    font-weight: 500;
}

.info-value {
    font-size: 16px;
    color: var(--dark-color);
}

/* Course Actions */
.course-actions {
    display: flex;
    justify-content: center;
    padding: 0 20px 30px;
}

.register-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background-color: var(--primary-color);
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(120, 184, 67, 0.2);
}

.register-btn:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(120, 184, 67, 0.3);
    color: white;
    text-decoration: none;
}

.register-btn.disabled {
    background-color: #ccc;
    cursor: not-allowed;
    pointer-events: none;
    opacity: 0.7;
}

/* RTL Support */
[dir="rtl"] .course-list-item.active {
    border-left: none;
    border-right: 4px solid var(--primary-color);
}

/* Responsive Styles */
@media (max-width: 991px) {
    .course-container {
        grid-template-columns: 1fr;
    }
    
    .course-info-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    }
}

@media (max-width: 767px) {
    .courses-section {
        padding: 20px 0 40px;
    }
    
    .course-title {
        font-size: 20px;
    }
    
    .course-info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

    
@endpush

@script
<script>
    Alpine.data('courcess_data', () => ({
        init() {
            this.courcess = @JS($courcess);
        },
        courcess: null,
        cource: null,
        status: null,
        activeIndex: 0,
        currentIndex: 0,
        trans: {
            open: @JS(__('Open')),
            closed: @JS(__('Closed'))
        },
        loadCource($cource, index) {
            this.cource = $cource;
            this.activeIndex = index;
            
            // Scroll to top of course details on mobile
            if (window.innerWidth < 992) {
                document.querySelector('.course-details').scrollIntoView({ behavior: 'smooth' });
            }
        }
    }))
</script>
@endscript