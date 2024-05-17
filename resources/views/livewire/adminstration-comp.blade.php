  <!-- Start our volunteers Section -->
  <x-slot name="header">
   <h2> {{__('Administration Members')}} </h2>
  </x-slot>
        <section class="bg-team-section">
            <div class="container">
                <div class="row">
                    <div class="volunteers-option">
                        <div class="row">
                        @foreach ($members as $member )
                           
                           <x-theme.team-member-card :member="$member" />  
                            
                        @endforeach
                            <!-- .col-lg-3 -->
                        </div>
                        <!-- .row -->
                    </div>
                    <!-- .volume-option -->
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </section>
        <!-- End our volunteers Section -->