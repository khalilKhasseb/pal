 <!-- Start Recent Project Section -->
 <x-slot name="header">
 <h3>{{__('Gallary')}}</h3>
</x-slot>
 <section class="bg-gallery-style2">
     <div class="container">
         <div class="row">

             @if (is_null($galleris) || $galleris->isEmpty())
             @include($skyTheme.'.partial.empty')
             @endif
             <div class="recent-project gallery2-items">
                 <div id="filters" class="button-group ">
                     <button class="button is-checked" data-filter="*">{{__('show all')}}</button>

                     @foreach ($galleris as $gallary)
                         <button class="button" data-filter=".gallary-{{ $gallary->id }}">{{ $gallary->title }}</button>
                     @endforeach
                 </div>
                 <div class="portfolio-items">
                     @foreach ($galleris as $gallary)
                         @foreach ($gallary->getMedia('gallary') as $media)
                             <div class="item gallary-{{ $gallary->id }}" data-category="transition">
                                 <div class="item-inner">
                                     <div class="portfolio-img">
                                         <div class="overlay-project"></div>
                                         <!-- .overlay-project -->
                                         <img src="{{ $media->getUrl() }}" alt="gallery-img-1">
                                         <div class="project-plus">
                                             <a href="{{ $media->getUrl() }}" data-rel="lightcase:myCollection"><i
                                                     class="fa fa-search" aria-hidden="true"></i></a>
                                         </div>
                                         <div class="recent-project-content">
                                             <p><a href="#">{{$gallary->title}}</a></p>
                                         </div>
                                         <!-- .latest-port-content -->
                                     </div>
                                     <!-- /.portfolio-img -->
                                 </div>
                                 <!-- .item-inner -->
                             </div>
                         @endforeach
                     @endforeach
                     <!-- .items -->
                 </div>
                 <!-- .isotope-items -->
                 {{-- <div class="load-more-option">
                     <a href="#" class="btn btn-default">load more photos</a>
                 </div> --}}
                 <!-- .load-more-option -->
             </div>
             <!-- .recent-project -->
         </div>
         <!-- .row -->
     </div>
     <!-- .container -->
     @push('scripts_comp')
         <script data-layout="front" type="text/javascript" src="{{ asset('js/template/plugins.isotope.js') }}"></script>
         <script data-layout="front" type="text/javascript" src="{{ asset('js/template/isotope.pkgd.min.js') }}"></script>
         <script data-layout="front" type="text/javascript" src="{{ asset('js/template/custom.isotope.js') }}"></script>
     @endpush
 </section>
 <!-- End Recent Project Section -->
