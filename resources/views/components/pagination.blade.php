@if ($paginator->hasPages())
    <ul class="inline-flex items-center space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li>
                <span class="px-2 py-1 text-gray-500 cursor-not-allowed text-sm">&laquo;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                    class="px-2 py-1 text-gray-600 hover:text-blue-500 text-sm">&laquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            $pageLimit = 5;

            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);

            if ($endPage - $startPage < $pageLimit - 1) {
                if ($startPage === 1) {
                    $endPage = min($lastPage, $startPage + $pageLimit - 1);
                } else {
                    $startPage = max(1, $endPage - $pageLimit + 1);
                }
            }

            $showLeftDots = $startPage > 1;
            $showRightDots = $endPage < $lastPage;
        @endphp

        {{-- Show left dots separator if applicable --}}
        @if ($showLeftDots && !$showRightDots)
            <li>
                <a href="{{ $paginator->url(1) . '&' . http_build_query(request()->except('page')) }}"
                    class="px-2 py-1 text-gray-600 hover:text-blue-500 text-sm">1</a>
            </li>
            <li>
                <span class="px-2 py-1 text-gray-500 text-sm">...</span>
            </li>
        @endif

        {{-- Show the calculated range of pages --}}
        @for ($i = $startPage; $i <= $endPage; $i++)
            @if ($i == $currentPage)
                <li>
                    <span class="px-2 py-1 rounded-lg bg-blue-500 text-white text-sm">{{ $i }}</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->url($i) . '&' . http_build_query(request()->except('page')) }}"
                        class="px-2 py-1 text-gray-600 hover:text-blue-500 text-sm">{{ $i }}</a>
                </li>
            @endif
        @endfor

        {{-- Dots Separator to the right if not on the last page --}}
        @if ($showRightDots)
            <li>
                <span class="px-2 py-1 text-gray-500 text-sm">...</span>
            </li>
            <li>
                <a href="{{ $paginator->url($lastPage) . '&' . http_build_query(request()->except('page')) }}"
                    class="px-2 py-1 text-gray-600 hover:text-blue-500 text-sm">{{ $lastPage }}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                    class="px-2 py-1 text-gray-600 hover:text-blue-500 text-sm">&raquo;</a>
            </li>
        @else
            <li>
                <span class="px-2 py-1 text-gray-500 cursor-not-allowed text-sm">&raquo;</span>
            </li>
        @endif
    </ul>
@endif
