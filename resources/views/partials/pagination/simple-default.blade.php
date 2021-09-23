@if ($paginator->hasPages())
    <nav class="paginate-container" aria-label="Pagination">
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="previous_page" aria-disabled="true">Previous</span>
            @else
                <a class="previous_page" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="next_page">Next</a>
            @else
                <span class="next_page" aria-disabled="true"><span>@lang('pagination.next')</span></span>
            @endif
        </div>
    </nav>
@endif
