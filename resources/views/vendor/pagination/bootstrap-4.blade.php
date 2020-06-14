<div class="pagination bg">
    @if ($paginator->hasPages())
        <ul class="pagination" role="navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" class="btn btn-white shadow"><i class="mi-arrow-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><a href="#" class="btn btn-white shadow"><span>{{$element}}</span></a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())

                            <li class="active"><a class="btn btn-white shadow"><span>{{$page}}</span></a></li>

                        @else
                            <li><a href="{{$url}}" class="btn btn-white shadow"><span>{{$page}}</span></a></li>

                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" class="btn btn-white shadow"><i class="mi-arrow-right"></i></a></li>
            @else

            @endif
        </ul>
    @endif
</div>


