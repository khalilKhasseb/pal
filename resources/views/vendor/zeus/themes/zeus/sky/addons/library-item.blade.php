<div x-data class="space-y-4 my-6 mx-4 ">

    <x-slot name="header">
        <h2>{{ $item->title }}</h2>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            <a href="{{ route('library') }}">{{ __('libraries') }}</a>
            {{-- @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3') --}}
            -
            {{-- <a href="{{route('library.tag' , ['slug' => ''])}}"></a> --}}
        </li>

        <li class="flex items-center">
            {{ __('Viewing') }} {{ $item->title }}
        </li>
    </x-slot>

    <div class="card">

        <div class="card-header">
           {{$item->title}}
        </div>

        <div class="card-body">
            <h4 class="card-title">{{ $item->title }}</h1>
            <p class="card-text">
                {{ $item->description }}
            </p>


            <p class="card-text mb-4">
                <span>{{ __('created at') }}</span>:
                <span>{{ $item->created_at->format('Y.m/d') }}-{{ $item->created_at->format('h:i a') }}</span>
            </p>

            @if($item->file_path !== null)
            @include($skyTheme.'.addons.library-types.'.strtolower($item->type).'-url')
            @else
            <div class="row @if($item->getFiles()->count() > 1) @endif">
                @foreach($item->getFiles() as $file)
                <div class="col-12 col-md-4 mb-2">
                    @include($skyTheme.'.addons.library-types.'.strtolower($item->type))
                </div>

                @endforeach
            </div>
            @endif

        </div>


    </div>
</div>
