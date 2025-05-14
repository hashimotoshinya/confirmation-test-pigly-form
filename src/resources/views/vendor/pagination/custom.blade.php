@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center" style="gap: 10px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="Previous">
                    <span aria-hidden="true">&lt;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">&lt;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span style="padding: 6px 12px; background: linear-gradient(45deg, #d1c4e9, #f8bbd0); border-radius: 8px; color: white;">{{ $page }}</span>
                            </li>
                        @else
                            <li><a href="{{ $url }}" style="padding: 6px 12px; border-radius: 8px; color: #444;">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">&gt;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="Next">
                    <span aria-hidden="true">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif