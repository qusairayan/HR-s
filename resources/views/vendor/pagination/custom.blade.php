<div>

    @if ($paginator->hasPages())

        <div
            class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">

                    @if ($paginator->onFirstPage())
                        <li class="page-item">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
                        </li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="page-item">
                                <a class="page-link" href="#">{{ $element }}</a>
                            </li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active">
                                        <a class="page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
    @endif
    <div class="fw-normal small mt-4 mt-lg-0">Showing <b>{{ $paginator->firstItem() }}</b>  out of <b>{{ $paginator->total() }}</b> entries</div>
</div>


