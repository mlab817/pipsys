<nav class="paginate-container" aria-label="Pagination">
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="previous_page" aria-disabled="true">Previous</span>
        @else
            <a class="previous_page" href="{{ $paginator->previousPageUrl() }}">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="gap">…</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <em aria-current="page">{{ $page }}</em>
                    @else
                        <a href="{{ $url }}" aria-label="Page {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="next_page" rel="next" href="{{ $paginator->nextPageUrl() }}" aria-label="Next Page">Next</a>
        @else
            <a class="next_page" aria-disabled="true">Next</a>
        @endif
    </div>
</nav>
