<div>
    <x-slot name="header">
        <h1>{{ __('Libraries') }}</h1>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            {{ __('libraries') }}
        </li>
    </x-slot>

    {{-- library categories loop --}}

    {{-- Each category will be rendered in a group list and catrogry title will be a header for group list --}}

    <div class="container py-5">

        <div class="row">


            @foreach($categories as $category )

            <div class="col-12 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{$category->name}}
                        <a class="badge bg-success fs-6" href="{{route('library.tag',['slug' => $category->slug])}}">
                            {{__('Vist')}}
                        </a>
                    </div>
                    <div class="list-group">

                        @foreach ($category->library as $library )
                        {{-- Categroy items --}}
                        <a href="{{route('library.item' ,['slug' => $library->slug])}}"
                            class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-iteme-center">
                                <span>{{$library->title ?? ''}}</span>
                                {{-- Add icon according to library type [image , video , file] --}}
                                @if($library->type === 'IMAGE')
                                <span style="width: 25px" x-tooltip.raw="{{ __('Image') }}">
                                    @svg('heroicon-o-photo')
                                </span>
                                @endif
                                @if($library->type === 'FILE')
                                <span class="d-inline-block" style="width: 25px" x-tooltip.raw="{{ __('FILE') }}">
                                    @svg('heroicon-o-document')
                                </span>
                                @endif
                                @if($library->type === 'VIDEO')
                                <span style="width:25px;" x-tooltip.raw="{{ __('VIDEO') }}">
                                    @svg('heroicon-o-film')
                                </span>
                                @endif

                            </div>

                        </a>
                        @endforeach
                    </div>


                </div>

                {{-- Category librarys --}}

            </div>
            @endforeach
        </div>
    </div>
</div>
