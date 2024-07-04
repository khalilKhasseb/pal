<x-theme-layout>
      <!-- Start 404 page Section -->
      <div class="container">
        <div class="row">
            <div class="page-error-option">
                <img src="/images/home01/Greenforest-404-page-img.png" alt="Greenforest-404-page-img" class="img-responsive" />
                <h2><span>Oops,</span> {{__('This Page Not Be Found!')}}</h2>
                <p>{{__('We are really sorry but the page you requested is missing')}} :(</p>
                <a href="{{route('theme.home')}}" class="btn btn-default">{{__('go back home')}}</a>
            </div>
            <!-- .page-error-option -->
        </div>
        <!-- .row -->
    </div>
    <!-- Start 404 page Section -->

</x-theme-layout>
