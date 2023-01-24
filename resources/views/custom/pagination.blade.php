@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Link para voltar uma pagina --}}
        @if ($paginator->onFirstPage())
            {{--<li class="page-link"><ion-icon name="arrow-back-outline"></ion-icon></li>--}}
        @else
            <li class="page-link"><a href="{{ $paginator->previousPageUrl() }}"><ion-icon name="arrow-back-outline"></ion-icon></a></li>
        @endif

        {{-- Paginação --}}
        @foreach ($elements as $element)
            {{-- Separador --}}
            @if (is_string($element))
                <li class="disabled">{{ $element }}</li>
            @endif

            {{-- links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-link disabled">
                            <a>{{ $page }}</a>
                        </li>
                    @else
                        <li class="waves-effect"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Link para proxima pagina --}}
        @if ($paginator->hasMorePages())
            <li class="page-link"><a href="{{ $paginator->nextPageUrl() }}"><ion-icon name="arrow-forward-outline"></ion-icon></a></li>
        @else
           {{--<li class="page-link"><ion-icon name="arrow-forward-outline"></ion-icon></li>--}}
        @endif
    </ul>
@endif
