<x-slot name="header">
    <h2> {{ __('Experts') }} </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('experts.list') }}">{{ __('Experts') }}</a></li>

    <li><a href="#">{{ $expert->{'sir_name_' . $local} }}</a></li>
</x-slot>

<div class="container my-5">
    <div id="user-profile-2" class="user-profile">
        <div class="tabbable">
            <ul class="nav nav-tabs padding-18" role="tablist">
                <li>
                    <a class='active' data-bs-toggle="tab" href="#home">
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        {{ __('Profile') }}
                    </a>
                </li>

                <li>
                    <a data-bs-toggle="tab" href="#feed">
                        <i class="green ace-icon fa fa-certificate bigger-120"></i>
                        {{ __('Certificates') }}
                    </a>
                </li>
            </ul>

            <div class="tab-content no-border padding-24">
                <div id="home" class="tab-pane in active">
                    <div class="row">

                        <div class="col-xs-12 col-sm-3 center">
                            <span class="profile-picture">
                                <img class="editable img-responsive" alt=" Avatar" id="avatar2"
                                    src="{{ !$expert->getMedia('image')->isEmpty() ? $expert->getMedia('image')->first()->getUrl() : asset('logo1.png') }}">
                            </span>

                            <div class="space my-4"></div>

    

                            <button role="button" type="button" data-bs-toggle="modal"
                                data-bs-target="#requestClientEmail" data-bs-request-for-client-certifcate="0"
                                class="btn btn-sm btn-block btn-primary">
                                <i class="ace-icon fa fa-envelope-o bigger-110"></i>
                                <span class="bigger-110">{{ __('Send Email') }}</span>
                            </button>
                        </div><!-- /.col -->

                        <div class="col-xs-12 col-sm-9">
                            <h4 class="blue">
                                <span class="middle">{{ $expert->sir_name_ar }}</span>

                                <span class="label label-green arrowed-in-right green">
                                    <i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
                                    {{ __('Verified') }}
                                </span>
                            </h4>

                            <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Name In Arabic') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $expert->sir_name_ar }} {{$expert->first_name}}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Name In English') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{$expert->first_name}} {{ $expert->sir_name_en }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Location') }} </div>

                                    <div class="profile-info-value">
                                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                                        <span>{{ $expert->governorate->name }}</span>
                                        <span>{{ $expert->city->name }}</span>
                                    </div>
                                </div>



                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Gender') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $expert->gender }}</span>
                                    </div>
                                </div>



                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('University') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $expert->university }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Graduation Year') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $expert->graduation_year }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Major') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $expert->ba_major }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Other Degrees') }} </div>

                                    <div class="profile-info-value">
                                        @if ($expert->other_degrees)
                                            <span>{{ $expert->other_degrees }}</span>
                                        @else
                                            <span>{{ __('No Other Degrees') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="space-20"></div>


                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="space-20"></div>
                </div><!-- /#home -->

                <div id="feed" class="tab-pane in">
                    <div class="col-xs-12 col-sm-9">

                        @foreach ($expert->certificates as $certificate)
                            <hr style="border-color:#53a92c !important" class="border border-2 opacity-50">
                            <div class="profile-user-info my-2">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Certificate') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $certificate->certificate_name }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Certifying Authority') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $certificate->certifying_authority }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Authenticate Certificate URL') }} </div>

                                    <div class="profile-info-value">
                                        <a href="{{ $certificate->authenticate_certificate_url }}"
                                            target="_blank">{{__('Preview') }}</a>
                                    </div>
                                </div>

                                

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Certification Experience') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $certificate->certification_experience }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> {{ __('Year of Certification') }} </div>

                                    <div class="profile-info-value">
                                        <span>{{ $certificate->year_of_certification }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div><!-- /#feed -->

                <!-- /#friends -->
                <!-- /#pictures -->
            </div>
        </div>
    </div>
</div>
@assets
    <link rel="stylesheet" href="{{ asset('css/template/expert-profile.css') }}?212">
@endassets

<x-slot name="modal">
    <div class="modal fade" id="requestClientEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('Contact requests') }}</h5>
                    <button type="button"
                        style="{{ app()->getLocale() == 'ar' ? 'margin: -.5rem -.5rem auto -.5rem' : '' }}"
                        class="btn-close text-start" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="success"></div>
                    <form class="requestForClentEmailForm contact-form">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">{{ __('Your email') }}:</label>
                            <input name="client_email" type="text" class="form-control" id="recipient-name">
                            <input type="text" hidden name="expert_id" value="{{ $expert->id }}">
                            <input id="expert_certifcate_request" type="text" hidden
                                name="expert_certifcate_request" value="0">
                            <div class="errors_client_email d-none"></div>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label"> {{ __('Message') }}:</label>
                            <textarea rows="125" name="message" class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button"
                        class="btn btn-default  sendRequestForClientEmailBtn">{{ __('Send Email') }}
                        <div id="expertSpiner" class="spinner-border text-success d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                    </button>
                </div>
            </div>
        </div>
    </div>
</x-slot>
