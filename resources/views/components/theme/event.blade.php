  @props(['event'])
   @php
             #when there is no thumb media and has_thumb  = fasle loda thumb from origin croppped tumb conversion
              
                 $thumbnail = '' ;
                 #check for event thubmnail media collection 
                  if($event->getMedia('thumbnail')->isEmpty() && !$event->has_thumb) {
                    #which means we have to load thumb from origin image conversions
                    if(!$event->getMedia('posts')->isEmpty()) {
       
                         $thumb_url = $event->getMedia('posts')[0]->getUrl('thumb-cropped-original') ;

                         $thumbnail = $thumb_url ;
                    }
                  }elseif(!$event->getMedia('thumbnail')->isEmpty() && $event->has_thumb) {
                    #load thumb from thumbnail collection conerstion

                    $thumb_url = $event->getMedia('thumbnail')[0]->getUrl('thumb-cropped');
                    $thumbnail = $thumb_url ;
                  }else{
                    $thumbnail = $event->image();
                  }
              @endphp   
  <div class="col-lg-6">
      <div class="event-items">

          <div class="event-img">
              <a href="{{route('event.single' , ['slug' => $event->slug])}}"><img src="{{ $event->image()}}" alt="upcoming-events-img-1"
                      class="img-responsive" /></a>
              <div class="date-box">

                  <h3>{{ $event->published_at->locale(app()->getLocale())->day }}</h3>
                  <h5>{{ $event->published_at->locale(app()->getLocale())->monthName }}</h5>
              </div>
              <!-- .date-box -->
          </div>
          <!-- .event-img -->
          <div class="events-content">
              <h3 class="mb-2"><a href="{{route('event.single' , ['slug' => $event->slug])}}">{{ $event->title }}</a></h3>
              <ul class="meta-event">
                  @foreach ($event->post_meta as $meta)
                      <li class="d-flex justify-items-start">
                      @if(!is_null($meta->icon) and !empty($meta->icon))
                          <x-icon class="ps-2" width="20px" color="green" name="{{ $meta->icon }}" />
                          @endif

                          <span>{{ $meta->key }} : {{ $meta->value }} </span>
                      </li>
                  @endforeach
                  {{-- <li><i class="flaticon-placeholder"></i> Sahera Tropical Center Dhaka</li> --}}
              </ul>
              <p>{!! $event->description !!}</p>
              <a href="{{route('event.single' , ['slug' => $event->slug])}}" class="btn btn-default">{{ __('Details') }}</a>
          </div>
          <!-- .events-content -->
      </div>
      <!-- .events-items -->
  </div>
