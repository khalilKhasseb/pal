 <!-- Start Contact us Section -->
 @props([
    'subHeading'
 ])
 <section class="bg-contact-home" id="contact">
    <div class="container">
        @if(session()->has('message'))
         <h3 class="text-center text-dark">{{session()->get('message')}}</h3>
        @endif
        <div class="row">
            <div class="contact-us">
                <div class="section-header">
                    <h2>{{__('Get in Touch')}}</h2>
                    {{-- <p>{{$subHeading}}</p> --}}
                </div>
                <!-- .section-header -->
                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{route('contact')}}" method="POST" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="{{old('name')}}" required class="form-control" id="nameId" name="name" placeholder="{{__('Name')}}">
                                    </div>
                                    <!-- .form-group -->
                                </div>
                                <!-- .col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" value="{{old('email')}}" required class="form-control" id="emailId" name="email" placeholder="{{__('Email')}}">
                                    </div>
                                </div>
                                <!-- .col-md-6 -->
                            </div>
                            <!-- .row -->
                            <div class="form-group">
                                <input type="text" value="{{old('subject')}}" required  class="form-control" id="subjectId" name="subject" placeholder="{{__('Subject')}}">
                            </div>
                            <textarea name="message" value="{{old('message')}}" required class="form-control text-area" rows="3" placeholder="{{__('Message')}}"></textarea>
                            <button type="submit" class="btn btn-default">{{__('Send Email')}}</button>
                        </form>
                    </div>
                    <!-- .col-md-6 -->
                    <div class="col-lg-6">

                        <div id="mapframe" class="w-full d-block w-100 h-100">
                            <iframe class="d-block w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1693.5130704629737!2d35.212099665081794!3d31.90588710408815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe4b933cc0c04b2fe!2zMzHCsDU0JzIxLjgiTiAzNcKwMTInNDIuNCJF!5e0!3m2!1sar!2sae!4v1673350698182!5m2!1sar!2sae" frameborder="0"></iframe>
                        </div>

                    </div>
                    <!-- .col-md-6 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .contact-us -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Contact us Section -->
