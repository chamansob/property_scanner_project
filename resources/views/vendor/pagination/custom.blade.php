@if ($paginator->hasPages())

    <ul class="pagination pagination-dotted-active justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="#" class="page-link">Previous Page</a>
            </li>
        @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev" aria-label="@lang('pagination.previous')">Previous Page</a>
            </li>
        @endif


        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a href="{{ $url }}" class="page-link current">{{ $page }}</a>
                        </li>
                    @else
                        <li><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next" aria-label="@lang('pagination.next')">Next Page</a>
            </li>
        @else
            <li class="page-item disabled"  aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="#" class="page-link">Next Page</a>
            </li>
        @endif
    </ul>
@endif
