@if($paginationItems->lastPage() > 1)
    <div class="section section-paginate">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                @if(!empty($paginationItems->previousPageUrl()))
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginationItems->url(1) }}">
                            <span aria-hidden="true">&lt;&lt;</span>
                        </a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="{{ $paginationItems->previousPageUrl() }}">
                            <span aria-hidden="true">&lt;</span>
                        </a>
                    </li>
                @endif

                @php
                    $firstIndex = $paginationItems->currentPage() <= 2 ? 1 : $paginationItems->currentPage()-2;
                    $lastIndex = $paginationItems->currentPage() >= $paginationItems->lastPage()-3 ? $paginationItems->lastPage() : $paginationItems->currentPage()+3;
                @endphp

                @for($i=$firstIndex;$i<=$lastIndex;$i++)
                    <li class="page-item"><a class="page-link" style="{{ $i == $paginationItems->currentPage() ? "background-color: #cbcbcb;" : '' }}" href="{{ $paginationItems->url($i) }}">{{ $i }}</a></li>
                @endfor

                @if(!empty($paginationItems->nextPageUrl()))
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginationItems->nextPageUrl() }}">
                            <span aria-hidden="true">&gt;</span>
                        </a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="{{ $paginationItems->url($paginationItems->lastPage()) }}">
                            <span aria-hidden="true">&gt;&gt;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div><!-- /.section section-paginate -->
@endif
