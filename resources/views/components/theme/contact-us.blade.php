 <!-- Start Contact us Section -->
 <section class="bg-contact-home" id="contact">
    <div class="container">
        <div class="row">
            <div class="contact-us">
                <div class="section-header">
                    <h2>{{__('Get in Touch')}}</h2>
                    <p>{{__('rofessionally mesh enterprise wide imperatives without world class paradigms.Dynamically deliver ubiquitous leadership awesome skills.')}}</p>
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

                        <div id="map"></div>

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
