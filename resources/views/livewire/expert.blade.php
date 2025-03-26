<x-slot name="header">
    <div class="expert-profile-header">
        <h2>{{ __('Expert Profile') }}</h2>
    </div>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="breadcrumb-item"><a href="{{ route('theme.home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('experts') }}">{{ __('Experts') }}</a></li>
    <li class="breadcrumb-item active">{{ $expert->{'sir_name_' . $local} }}</li>
</x-slot>

<div class="expert-profile-section">
    <div class="container">
        <!-- Expert Overview Card -->
        <div class="expert-overview">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4">
                    <div class="expert-avatar-container">
                        <div class="expert-avatar">
                            <img src="{{ !$expert->getMedia('image')->isEmpty() ? $expert->getMedia('image')->first()->getUrl() : asset('logo1.png') }}"
                                alt="{{ $expert->first_name }}" class="avatar-img">
                        </div>

                        <div class="verification-badge {{ $expert->is_verified ? 'verified' : 'unverified' }}">
                            <i class="fa fa-check-circle"></i>
                            <span>{{ $expert->is_verified ? __('Verified Expert') : __('Unverified') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-8">
                    <div class="expert-summary">
                        <h1 class="expert-name">
                            {{ $expert->first_name }} {{ $expert->{'sir_name_' . $local} }}
                        </h1>

                        <div class="expert-credentials">
                            <span class="expert-specialty">{{ $expert->ba_major }}</span>
                            <span class="credentials-divider">•</span>
                            <span class="expert-location">
                                <i class="fa fa-map-marker-alt"></i>
                                {{ $expert->governorate->name }}, {{ $expert->city->name }}
                            </span>
                        </div>

                        <div class="expert-qualifications">
                            @if ($expert->certificates && $expert->certificates->count() > 0)
                                <div class="qualification">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>{{ $expert->certificates->count() }} {{ __('Certificates') }}</span>
                                </div>
                            @endif

                            <div class="qualification">
                                <i class="fa fa-university"></i>
                                <span>{{ $expert->university }}</span>
                            </div>

                            <div class="contact-expert">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#requestClientEmail"
                                    data-bs-request-for-client-certifcate="0" class="contact-btn">
                                    <i class="fa fa-envelope"></i>
                                    <span>{{ __('Contact Expert') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Container -->
        <div class="expert-tabs-container">
            <ul class="nav expert-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="true">
                        <i class="fa fa-user"></i>
                        <span>{{ __('Profile Details') }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="certificates-tab" data-bs-toggle="tab" data-bs-target="#certificates"
                        type="button" role="tab" aria-controls="certificates" aria-selected="false">
                        <i class="fa fa-certificate"></i>
                        <span>{{ __('Certificates') }}</span>
                    </button>
                </li>
            </ul>

            <div class="tab-content expert-tabs-content">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="profile-info-grid">
                        <div class="info-group">
                            <div class="info-label">{{ __('Name In Arabic') }}</div>
                            <div class="info-value">{{ $expert->first_name }} {{ $expert->sir_name_ar }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">{{ __('Name In English') }}</div>
                            <div class="info-value">{{ $expert->first_name_en }} {{ $expert->sir_name_en }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">{{ __('Location') }}</div>
                            <div class="info-value">
                                <i class="fa fa-map-marker-alt location-icon"></i>
                                {{ $expert->governorate->name }}, {{ $expert->city->name }}
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">{{ __('Gender') }}</div>
                            <div class="info-value">{{ $expert->gender }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">{{ __('University') }}</div>
                            <div class="info-value">{{ $expert->university }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">{{ __('Graduation Year') }}</div>
                            <div class="info-value">{{ $expert->graduation_year }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">{{ __('Major') }}</div>
                            <div class="info-value">{{ $expert->ba_major }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">{{ __('Other Degrees') }}</div>
                            <div class="info-value">
                                @if ($expert->other_degrees)
                                    {{ $expert->other_degrees }}
                                @else
                                    <span class="text-muted">{{ __('No Other Degrees') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificates Tab -->
                <div class="tab-pane fade" id="certificates" role="tabpanel" aria-labelledby="certificates-tab">
                    @if ($expert->certificates && $expert->certificates->count() > 0)
                        <div class="certificates-list">
                            @foreach ($expert->certificates as $certificate)
                                <div class="certificate-card">
                                    <div class="certificate-header">
                                        <div class="certificate-icon">
                                            <i class="fa fa-award"></i>
                                        </div>
                                        <div class="certificate-title">
                                            <h3>{{ $certificate->certificate_name }}</h3>
                                            <div class="certificate-meta">
                                                <span class="issuer">{{ $certificate->certifying_authority }}</span>
                                                <span class="year">{{ $certificate->year_of_certification }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="certificate-details">
                                        <div class="detail-group">
                                            <div class="detail-label">{{ __('Certification Experience') }}</div>
                                            <div class="detail-value">{{ $certificate->certification_experience }}
                                            </div>
                                        </div>

                                        @if ($certificate->authenticate_certificate_url)
                                            <div class="certificate-actions">
                                                <a href="{{ $certificate->authenticate_certificate_url }}"
                                                    target="_blank" class="verify-link">
                                                    <i class="fa fa-external-link-alt"></i>
                                                    {{ __('Verify Certificate') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-certificates">
                            <div class="empty-icon">
                                <i class="fa fa-certificate"></i>
                            </div>
                            <h3>{{ __('No Certificates Available') }}</h3>
                            <p>{{ __('This expert has not added any certificates yet.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<!-- Contact Modal -->
<x-slot name="modal">
    <div class="modal fade" id="requestClientEmail" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="contactExpertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactExpertModalLabel">
                        <i class="fa fa-envelope"></i> {{ __('Contact Expert') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="success"></div>

                    <form class="requestForClentEmailForm contact-form">
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">{{ __('Your email') }}</label>
                            <div class="input-wrapper">
                                <input name="client_email" type="email" class="form-control" id="recipient-name"
                                    placeholder="{{ __('Enter your email address') }}">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                            <div class="errors_client_email d-none"></div>

                            <input type="hidden" name="expert_id" value="{{ $expert->id }}">
                            <input id="expert_certifcate_request" type="hidden" name="expert_certifcate_request"
                                value="0">
                        </div>

                        <div class="form-group mb-3">
                            <label for="message-text" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" class="form-control" id="message-text" rows="4"
                                placeholder="{{ __('Write your message to the expert here...') }}"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="button" class="btn btn-primary sendRequestForClientEmailBtn">
                        <span>{{ __('Send Message') }}</span>
                        <div id="expertSpiner" class="spinner-border spinner-border-sm text-light d-none"
                            role="status">
                            <span class="visually-hidden">{{ __('Loading...') }}</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-slot>

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
            --danger-color: #dc3545;
            --card-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Expert Profile Section */
        .expert-profile-section {
            padding: 40px 0 70px;
            background-color: var(--light-color);
        }

        /* Expert Overview Card */
        .expert-overview {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
        }

        /* Expert Avatar */
        .expert-avatar-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .expert-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--border-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .verification-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
        }

        .verification-badge.verified {
            background-color: rgba(120, 184, 67, 0.15);
            color: var(--primary-color);
        }

        .verification-badge.unverified {
            background-color: rgba(220, 53, 69, 0.15);
            color: var(--danger-color);
        }

        /* Expert Summary */
        .expert-summary {
            padding-left: 20px;
        }

        .expert-name {
            font-size: 32px;
            color: var(--dark-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .expert-credentials {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .expert-specialty {
            color: var(--primary-color);
            font-weight: 600;
        }

        .credentials-divider {
            color: #ccc;
        }

        .expert-location {
            color: var(--meta-color);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .expert-location i {
            color: var(--danger-color);
        }

        .expert-qualifications {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .qualification {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--meta-color);
            font-size: 15px;
        }

        .qualification i {
            color: var(--primary-color);
        }

        .contact-expert {
            margin-left: auto;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 3px 8px rgba(120, 184, 67, 0.2);
        }

        .contact-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(120, 184, 67, 0.3);
        }

        .contact-btn:active {
            transform: translateY(0);
        }

        /* Tabs Styling */
        .expert-tabs-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .expert-tabs {
            display: flex;
            padding: 0;
            margin: 0;
            list-style: none;
            background-color: var(--light-color);
            border-bottom: 1px solid var(--border-color);
        }

        .expert-tabs .nav-item {
            flex: 1;
        }

        .expert-tabs .nav-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 15px;
            color: var(--secondary-color);
            font-weight: 600;
            border: none;
            border-bottom: 3px solid transparent;
            border-radius: 0;
            background: transparent;
            transition: all 0.3s ease;
        }

        .expert-tabs .nav-link:hover {
            color: var(--primary-color);
        }

        .expert-tabs .nav-link.active {
            color: var(--primary-color);
            background-color: white;
            border-bottom-color: var(--primary-color);
        }

        .expert-tabs-content {
            padding: 30px;
        }

        /* Profile Info Styling */
        .profile-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 20px;
        }

        .info-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .info-label {
            color: var(--meta-color);
            font-size: 14px;
            font-weight: 500;
        }

        .info-value {
            color: var(--dark-color);
            font-size: 16px;
            font-weight: 600;
        }

        .location-icon {
            color: var(--danger-color);
            margin-right: 5px;
        }

        /* Certificates Styling */
        .certificates-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .certificate-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .certificate-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .certificate-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .certificate-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(120, 184, 67, 0.15);
            color: var(--primary-color);
            border-radius: 10px;
            font-size: 24px;
        }

        .certificate-title h3 {
            font-size: 18px;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .certificate-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--meta-color);
            font-size: 14px;
        }

        .certificate-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .detail-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            color: var(--meta-color);
            font-size: 14px;
            font-weight: 500;
        }

        .detail-value {
            color: var(--text-color);
            font-size: 15px;
            line-height: 1.5;
        }

        .certificate-actions {
            margin-top: 10px;
            display: flex;
            justify-content: flex-end;
        }

        .verify-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .verify-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        /* No Certificates */
        .no-certificates {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
            text-align: center;
        }

        .empty-icon {
            font-size: 48px;
            color: var(--border-color);
            margin-bottom: 20px;
        }

        .no-certificates h3 {
            color: var(--dark-color);
            font-size: 20px;
            margin-bottom: 10px;
        }

        .no-certificates p {
            color: var(--meta-color);
            max-width: 400px;
        }

        < !-- Contact Modal --><x-slot name="modal"><div class="modal fade" id="requestClientEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="contactExpertModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="contactExpertModalLabel"><i class="fa fa-envelope"></i>{{ __('Contact Expert') }} </h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><div id="success"></div><form class="requestForClentEmailForm contact-form"><div class="form-group mb-3"><label for="recipient-name" class="form-label">{{ __('Your email') }}</label><div class="input-wrapper"><input name="client_email" type="email" class="form-control" id="recipient-name" placeholder="{{ __('Enter your email address') }}"><div class="input-icon"><i class="fa fa-envelope"></i></div></div><div class="errors_client_email d-none"></div><input type="hidden" name="expert_id" value="{{ $expert->id }}"><input id="expert_certifcate_request" type="hidden" name="expert_certifcate_request" value="0"></div><div class="form-group mb-3"><label for="message-text" class="form-label">{{ __('Message') }}</label><textarea name="message" class="form-control" id="message-text" rows="4"
            placeholder="{{ __('Write your message to the expert here...') }}"></textarea></div></form></div><div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }} </button><button type="button" class="btn btn-primary sendRequestForClientEmailBtn"><span>{{ __('Send Message') }}</span><div id="expertSpiner" class="spinner-border spinner-border-sm text-light d-none" role="status"><span class="visually-hidden">{{ __('Loading...') }}</span></div></button></div></div></div></div></x-slot><style>

        /* Modal Styling */
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: var(--light-color, #f9fcf7);
            border-bottom: 1px solid var(--border-color, #dbe9d3);
            padding: 15px 20px;
        }

        .modal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--dark-color, #2c3e2e);
            font-weight: 600;
        }

        .modal-title i {
            color: var(--primary-color, #78b843);
        }

        .modal-body {
            padding: 20px;
        }

        /* Form elements */
        .form-label {
            font-weight: 500;
            color: var(--dark-color, #2c3e2e);
            margin-bottom: 8px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color, #78b843);
            width: 40px;
            display: flex;
            justify-content: center;
        }

        /* RTL support for input icon */
        [dir="rtl"] .input-icon {
            left: 0;
        }

        [dir="ltr"] .input-icon {
            right: 0;
        }

        [dir="rtl"] .form-control {
            padding-left: 40px;
            padding-right: 15px;
            text-align: right;
        }

        [dir="ltr"] .form-control {
            padding-right: 40px;
            padding-left: 15px;
            text-align: left;
        }

        .form-control {
            border-color: var(--border-color, #dbe9d3);
            padding-top: 10px;
            padding-bottom: 10px;
            width: 100%;
        }

        textarea.form-control {
            padding: 15px;
            min-height: 120px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(120, 184, 67, 0.15);
            border-color: var(--primary-color, #78b843);
        }

        .form-control::placeholder {
            color: #aaa;
            opacity: 0.8;
        }

        /* Alert Styling */
        .alert {
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-success {
            background-color: rgba(120, 184, 67, 0.1);
            color: var(--primary-color, #78b843);
            border-color: rgba(120, 184, 67, 0.3);
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-color: rgba(220, 53, 69, 0.3);
        }

        /* Modal footer */
        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid var(--border-color, #dbe9d3);
            justify-content: space-between;
        }

        [dir="rtl"] .modal-footer {
            flex-direction: row-reverse;
        }

        .btn-outline-secondary {
            color: var(--meta-color, #666);
            border-color: var(--border-color, #dbe9d3);
            background-color: transparent;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-outline-secondary:hover {
            background-color: var(--light-color, #f9fcf7);
            color: var(--dark-color, #2c3e2e);
        }

        .btn-primary {
            background-color: var(--primary-color, #78b843);
            border-color: var(--primary-color, #78b843);
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover, #68a336);
            border-color: var(--primary-hover, #68a336);
        }

        /* Fix for RTL language */
        [dir="rtl"] .btn-close {
            margin-left: 0;
            margin-right: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .modal-footer {
                flex-direction: column;
                gap: 10px;
            }

            .modal-footer .btn {
                width: 100%;
            }

            [dir="rtl"] .modal-footer {
                flex-direction: column;
            }
        }

        /* RTL Support */
        [dir="rtl"] .expert-summary {
            padding-left: 0;
            padding-right: 20px;
        }

        [dir="rtl"] .contact-expert {
            margin-left: 0;
            margin-right: auto;
        }

        [dir="rtl"] .location-icon {
            margin-right: 0;
            margin-left: 5px;
        }

        /* Responsive Styles */
        @media (max-width: 991px) {
            .expert-overview {
                padding: 20px;
            }

            .expert-avatar {
                width: 150px;
                height: 150px;
            }

            .expert-name {
                font-size: 28px;
            }

            .expert-summary {
                padding-left: 0;
                margin-top: 20px;
                text-align: center;
            }

            .expert-credentials {
                justify-content: center;
            }

            .expert-qualifications {
                justify-content: center;
            }

            .contact-expert {
                margin: 15px auto 0;
            }

            .profile-info-grid {
                grid-template-columns: 1fr;
            }

            [dir="rtl"] .expert-summary {
                padding-right: 0;
            }
        }

        @media (max-width: 767px) {
            .expert-tabs .nav-link {
                padding: 12px 10px;
                font-size: 14px;
            }

            .expert-tabs-content {
                padding: 20px 15px;
            }

            .certificate-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
@endpush
