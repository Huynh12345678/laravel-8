@if ($paginator->hasPages())
    <div class="border-bottom border-top mt-4 section__category-product-pagination">
        <div class="row">
            <div class="col-12 py-3">
                <ul class="d-flex flex-wrap list-unstyled justify-content-center">
                    @if ($paginator->onFirstPage())
                    <li class="d-none">
                        <a href="{{ $paginator->previousPageUrl() }}">
                            <i class="fa fa-angle-left mr-1" aria-hidden="true"></i>
                            Trước
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}">
                            <i class="fa fa-angle-left mr-1" aria-hidden="true"></i>
                            Trước
                        </a>
                    </li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li>
                                        <a href="javascript:void(0)" class="active">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}">
                            Sau
                            <i class="fa fa-angle-right ml-1" aria-hidden="true"></i>
                        </a>
                    </li>
                    @else 
                    <li class="d-none">
                        <a href="{{ $paginator->nextPageUrl() }}">
                            Sau
                            <i class="fa fa-angle-right ml-1" aria-hidden="true"></i>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
