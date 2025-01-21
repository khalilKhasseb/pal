@php
    $start_date = isset($start_date) ? $start_date : null;
    $end_date = isset($end_date) ? $end_date : null;
@endphp
@push('scripts_comp')
    <script src="{{ asset('js/blocks/libs/countdown.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const start_date = @js($start_date);
            const end_date = @js($end_date);

            const count_from_current_date =
                @js($count_from_current_date); // if true which means start date is the end date unless its false so each date will be availbe to count from. 


            // elements 
            const mo = document.querySelector('#months');
            const d = document.querySelector('#days');
            const h = document.querySelector('#hours');
            const m = document.querySelector('#minutes');
            const s = document.querySelector('#seconds');
            if (count_from_current_date) {
                const _countdown = countdown(new Date(end_date), function(ts) {

                    mo.innerHTML = ts.months;
                    d.innerHTML = ts.days;
                    h.innerHTML = ts.hours;
                    m.innerHTML = ts.minutes;
                    s.innerHTML = ts.seconds;
                });

            } else {
                const _countdown = countdown(new Date(start_date), new Date(end_date));

                document.querySelector('#appc').innerHTML = _countdown.toString();

            }
        })
    </script>
@endpush


<div>

    <style>
        .countdown-container {
            background-color: #e8f5e9;
            /* Light green background */
            border-radius: 15px;
            padding: 20px;
        }

        .countdown-box {
            background-color: #2e7d32;
            /* Dark green */
            color: #ffffff;
            /* White text */
            border-radius: 10px;
        }
    </style>

    <div id="appc"></div>
    <div class="container text-center mt-5 countdown-container">
        @isset($title)
            <h1 class="mb-4 text-success">{{ $title }}</h1>
        @endisset
        <div class="row justify-content-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
           <div class="col-auto">
                <div class="countdown-box p-4">
                    <h2 id="months" class="display-4 text-light">00</h2>
                    <p class="text-light">{{__('Months')}}</p>
                </div>
            </div>
            <div class="col-auto">
                <div class="countdown-box p-4">
                    <h2 id="days" class="display-4 text-light">00</h2>
                    <p class="text-light">{{__('Days')}}</p>
                </div>
            </div>
            <div class="col-auto">
                <div class="countdown-box p-4">
                    <h2 id="hours" class="display-4 text-light">00</h2>
                    <p class="text-light">{{__('Hours')}}</p>
                </div>
            </div>
            <div class="col-auto">
                <div class="countdown-box p-4">
                    <h2 id="minutes" class="display-4 text-light">00</h2>
                    <p class="text-light">{{__('Minutes')}}</p>
                </div>
            </div>
            <div class="col-auto">
                <div class="countdown-box p-4">
                    <h2 id="seconds" class="display-4 text-light">00</h2>
                    <p class="text-light">{{__('Seconds')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
