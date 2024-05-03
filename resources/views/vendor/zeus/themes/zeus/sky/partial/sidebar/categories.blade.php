{{--
@unless($categories->isEmpty())
<div class="my-4">
    <h4 class="mb-4 text-xl font-bold text-gray-700 dark:text-gray-200">Categories</h4>
    <div
        class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white dark:bg-gray-800 rounded-[2rem] ltr:rounded-br-none rtl:rounded-bl-none shadow-md">
        <ul>
            @foreach($categories as $cat)
            <li class="px-1 py-4 border-b border-t border-white hover:border-primary-600 transition duration-300">
                <a href="{{ route('tags',['category',$cat->slug]) }}"
                    class="flex items-center text-gray-600 cursor-pointer">
                    {{ $cat->name }}
                    <span class="text-gray-500 ltr:ml-auto rtl:mr-auto">{{ $cat->posts_published_count }} <span
                            class="text-xs">Post</span></span>
                    <i class='text-gray-500 bx bx-right-arrow-alt ltr:ml-1 rtl:mr-1'></i>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endunless --}}

@unless($categories->isEmpty())


<div class="widget">
    <h4 class="sidebar-widget-title">All Categores</h4>
    <div class="widget-content">
        <ul class="catagories">
            @foreach($categories as $cat)
            <li><a href="{{ route('tags',['category',$cat->slug]) }}"><i class="fa fa-angle-double-right"
                        aria-hidden="true"></i>
                    {{ $cat->name }}<span>{{ $cat->posts_published_count }}</span></a>

            </li>
            @endforeach
        </ul>
    </div>
    <!-- .widget-content -->
</div>
<!-- .widget -->


@endunless
