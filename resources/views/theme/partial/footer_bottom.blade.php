@php
        
        $siteTitle =  app()->getLocale()  === 'ar' 
        ? $settings->ar_site_name  
        : (!is_null($settings->site_name) ? $settings->site_name : config('app.name', 'Palgpc'));
@endphp
<div class="bg-footer-bottom">
    <div class="container">
        <div class="row">
            <div class="footer-bottom d-flex justify-content-between">
                <div class="copyright-txt text-center" style="">
                    <p> <span>{{$siteTitle}}</span> <span>{{__('© all rights reserved')}} </span>{{date('Y')}}</p>

                </div>
                <!-- .copyright-txt -->

            @if($settings->checkout_enabled)
                <div class="payment-methods" style="width:200px">
                    <img src="{{ asset('images/payment_methods.png') }}" alt="mastercard" class="img-responsive">
                    {{-- <img src="{{ asset('images/payment/visa.png') }}" alt="visa" class="img-fluid"> --}}
                </div>
            @endif
                <div class="social-box">
                    <ul class="social-icon-rounded">
                        @php
                        $links = App\Models\Widget::location('footer')->type('link')->get();
                        @endphp
                        @if(!is_null($links) && $links->count() > 0)

                        @foreach ($links[0]->content as $link )

                        <li>
                            <x-widgets.link :target="$link['target']" :icon-only="$link['icon_only']"
                                :icon="$link['icon']" />
                        </li>


                        @endforeach

                        @endif

                    </ul>
                </div>
                <!-- .social-box -->

            </div>
            <!-- .footer-bottom -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</div>
<!-- .bg-footer-bottom -->
