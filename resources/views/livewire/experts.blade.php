<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <section class="bg-team-section">
        <div class="container">
            <!-- Filters -->
            <div class="row">
                <div class="col-4">
                    <select class="select-2" name="state" style="width:100%;margin-bottom:20px">
                        @foreach ($governorates as $gov)
                            <option value="{{ $gov->slug }}">{{ $gov->name }}</option>
                        @endforeach
                    </select>

                    <select style="width:100%" class="select-2" name="state">
                        @foreach ($cities as $city)
                            <option value="{{ $city->slug }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- .row -->

            <!-- Experts List -->
            <div class="row">
                @foreach ($experts as $expert)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="volunteers-items">
                            <!-- Image -->
                            <div class="volunteers-img">
                                <img src="{{ $expert->getFirstMediaUrl('image') }}" 
                                     alt="{{ $expert->{'sir_name_' . app()->getLocale()} }}" 
                                     class="img-responsive" />
                            </div>
                            <!-- .volunteers-img -->

                            <!-- Content -->
                            <div class="volunteers-content">
                                <h4>
                                    <a href="{{ route('experts.view', $expert->id) }}">
                                        {{ $expert->{'sir_name_' . app()->getLocale()} }}
                                    </a>
                                </h4>
                                <p>{{ $expert->ba_major }}</p>
                            </div>
                            <!-- .volunteers-content -->
                        </div>
                        <!-- .volunteers-items -->
                    </div>
                    <!-- .col-lg-3 -->
                @endforeach
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </section>
    <!-- .bg-team-section -->
</div>
