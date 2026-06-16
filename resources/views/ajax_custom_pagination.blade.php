<div class="homec-pagination">
    <ul class="homec-pagination__list list-none">

        @if ($paginator->onFirstPage())
        @else
            <li class="homec-pagination__button"><a onclick="ajax_pagination('{{ $paginator->previousPageUrl() }}')" href="javascript:;">{{__('user.Prev')}}</a></li>
        @endif


        @foreach ($elements as $element)
        @if (is_array($element))
            @if (count($element) < 2)
            @else
                @foreach ($element as $key => $el)
                    @if ($key == $paginator->currentPage())
                        <li class="active"><a href="javascript:;">{{ $key }}</a></li>
                    @else
                        <li><a onclick="ajax_pagination('{{ $el }}')" href="javascript:;">{{ $key }}</a></li>
                    @endif
                @endforeach
            @endif
        @else
        <li><a href="javascript::void()">...</a></li>
        @endif

    @endforeach

        @if ($paginator->hasMorePages())
            <li class="homec-pagination__button"><a onclick="ajax_pagination('{{ $paginator->nextPageUrl() }}')" href="javascript:;">{{__('user.Next')}}</a></li>
        @endif


    </ul>
</div>
