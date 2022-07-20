<ul class="site-pagination text-center mt-md-5 mt-4">
    <li><span aria-current="page" class="page-numbers current">1</span></li>
    <li><a class="page-numbers" href="#page2">2</a></li>
    <li><a class="page-numbers" href="#page3">3</a></li>
    <li><span class="page-numbers dots">…</span></li>
    <li><a class="page-numbers" href="#page7">7</a></li>
    <li><a class="next page-numbers" href="#next">Next »</a></li>
</ul>

@if ($paginator->hasPages())
    <!-- Pagination -->
    <ul class="site-pagination text-center mt-md-5 mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <span><i class="fa fa-angle-double-left"></i></span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <span><i class="fa fa-angle-double-left"></i></span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($items as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li ><span class="page-numbers current">{{ $page }}</span></li>
                    @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                        <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                    @elseif ($page == $paginator->lastPage() - 1)
                        <li class="disabled"><span><i class="fa fa-ellipsis-h"></i></span></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}">
                    <span><i class="fa fa-angle-double-right"></i></span>
                </a>
            </li>
        @else
            <li class="disabled">
                <span><i class="fa fa-angle-double-right"></i></span>
            </li>
        @endif
    </ul>

    <!-- Pagination -->
@endif

