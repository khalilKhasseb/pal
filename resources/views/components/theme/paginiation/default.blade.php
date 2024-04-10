@props(['paginiator' => null , 'totalPages'])

@if(!is_null($paginiator) && $paginiator->hasPages())
<div class="pagination-option">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- if paginiator in first page disaple previos links --}}
            @if($paginiator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span>
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>

                </span>
            </li>
            @else
            {{-- IF paginiator is not on first page --}}

            <li>
                <a href="{{$paginiator->previousPageUrl()}}" aria-label="Previous">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                </a>
            </li>

            @endif
            {{--
            @while ($totalPages >= )

            @endwhile --}}
            @for ($i = 1 ; $i <= $totalPages;$i++) <li @class(['active'=> $i === $paginiator->currentPage()])>
                <a href="{{$paginiator->url($i)}}">{{$i}}</a></li>

                @endfor
                {{-- <li><a href="#">1</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">5</a></li> --}}
                {{-- If paginiator has more pages show next links --}}
                @if($paginiator->hasMorePages())
                <li>
                    <a href="{{$paginiator->nextPageUrl()}}" aria-label="Next">
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    </a>
                </li>

                @else
                {{-- Paginiator has no more pages left and done next disbale --}}

                <li class="disbaled">
                    <span>
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    </span>
                </li>

                </li>
                @endif
        </ul>
    </nav>
</div>
@endif
