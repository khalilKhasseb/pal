@push('scripts_comp')
    <script>
        new $('#envDaysTable').DataTable({
            language: {
                decimal: "",
                emptyTable: "{{ __('No data available in table') }}",
                info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
                infoFiltered: "{{ __('(filtered from _MAX_ total entries') }}",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "{{ __('Show _MENU_ entries') }}",
                loadingRecords: "{{ __('Loading...') }}",
                processing: "",
                search: "{{ __('Search:') }}",
                zeroRecords: "{{ __('No matching records found') }}",
                paginate: {
                    first: "{{ __('First') }}",
                    last: "{{ __('Last') }}",
                    next: "{{ __('Next') }}",
                    previous: "{{ __('Previous') }}"
                },
                aria: {
                    orderable: "{{ __('Order by this column') }}",
                    orderableReverse: "{{ __('Reverse order this column') }}"
                }
            }
        });
    </script>
@endpush
<div class="container mb-5" dir="rtl">

<div class="section-header">

 <h2>{{__('Enviromental Days')}}</h2>
 <hr />
</div>
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <table id="envDaysTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Month') }}</th>
                        <th>{{ __('Day') }}</th>
                        <th>{{__('This Year')}}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($envDays as $day) 
               

                        <tr class="{{$day->isThisYear() ? 'this-year' : ''}}">
                            <td>{{ $day->title }}</td>
                            <td>{{ __($day->month) }}</td>
                            <td>{{ $day->day }}</td>
                            <td>{{$day->completeDate}}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
