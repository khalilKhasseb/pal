


<div class="widget">
    <div class="widget-content">
        <form method="GET" class="sidebar-form">
            <div class="form-group">
                <input type="text" class="form-control" id="searchId" name="search"
                    placeholder="{{ __('Search') }}" value="{{ request()->get('search') }}">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
        </form>
    </div>
    <!-- .widget-content -->
</div>
<!-- .widget -->

{{-- <div class="my-4">
    <label for="search" class="mb-4 text-xl font-bold text-gray-700 dark:text-gray-200">{{ __('Search') }}</label>
    <div class="flex flex-col max-w-sm px-2 py-4 mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <form method="GET">
                <input class="w-full px-3 py-1.5 rounded" type="text" name="search" id="search" value="{{ request()->get('search') }}">
        </form>
    </div>
</div> --}}
