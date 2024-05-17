  <!-- Start our Single Team Section -->
  <x-slot name="header">
  <h2>{{$member->title}} </h2>
  </x-slot>
  <section class="bg-single-team">
      <div class="container">
          <div class="row">
              <div class="single-team">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="single-team-img">
                              <img src="{{ $member->image() }}" alt="single-team-img-1" class="img-responsive" />
                          </div>
                          <!-- .single-team-img -->
                      </div>
                      <!-- .col-md-6 -->
                      <div class="col-md-6">
                          <div class="single-team-details">
                              <h3>{{ $member->title }}</h3>
                              {{-- @if (!is_null($member->post_meta) || !empty($member->meta))
                                  @foreach ($member->post_meta as $meta)
                                      <h5>{{ $meta->value }}</h5>
                                  @endforeach
                              @endif --}}
                              {!! $member->content !!}
                              @if (!is_null($member->links) || !empty($member->links))
                                  <ul class="social-icon-rounded">
                                      @foreach ($member->links as $link)
                                          <li>
                                              <a href="{{ $link->url }}">
                                                  <x-icon class="ps-2" width="25px" color="{{ $link->color }}"
                                                      name="{{ $link->icon }}" />
                                              </a>
                                          </li>
                                      @endforeach

                                  </ul>
                              @endif
                              <div class="team-address-box">
                                
                                 @if (!is_null($member->post_meta) || !empty($member->meta))
                                 
                                 
                                  <ul class="address">

                                   @foreach ($member->post_meta as $meta)
                                     
                                 
                                      <li class="d-flex justify-content-start">
                                      @if(!is_null($meta->icon) || !empty($meta->icon))
                                          <x-icon class="p-1" width="25px" color="{{ $meta->color }}"
                                                      name="{{ $meta->icon }}" />
                                          @endif
                                          <span class="iniline-block me-2">{{$meta->value}}</span>
                                  @endforeach   
                                  </ul>
                                  @endif
                              </div>
                              <!-- .team-address-box -->


                          </div>
                          <!-- .single-team-content -->
                      </div>
                      <!-- .col-md-6 -->
                  </div>
                  <!-- .row -->
                 @if(!is_null($member->description))
                  <div class="single-team-content">
                      <h3>{{__('personal statement')}}</h3>
                      {!! $member->description !!}
                  </div>
                  @endif
                  <!-- .single-team-content -->

              </div>
              <!-- .single-team -->
          </div>
          <!-- .row -->
      </div>
      <!-- .container -->
  </section>
  <!-- End our Single Team Section -->
