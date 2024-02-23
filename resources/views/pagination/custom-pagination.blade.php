@if (isset($paginator) && $paginator->lastPage() > 1)
<nav class="">
    @if (isset($showInfo) && $showInfo)
    <div class="m-2">
        <p class="text-sm text-gray-700 leading-5 text-center">
            {!! __('Showing') !!}
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>
    </div>
    @endif
    
    <ul class="pagination d-flex justify-content-center">
        <?php
        $interval = isset($interval) ? abs(intval($interval)) : 2 ;
        $from = $paginator->currentPage() - $interval;
        if($from < 1){
            $from = 1;
        }

        $to = $paginator->currentPage() + $interval;
        if($to > $paginator->lastPage()){
            $to = $paginator->lastPage();
        }
        ?>

        <!-- first/previous -->
        @if($paginator->currentPage() > 1)
            <li class="page-item">
                <a href="{{ $paginator->url(1) }}&categorySearch={{ request()->query("categorySearch") }}" aria-label="First" class="page-link">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <li class="page-item">
                <a href="{{ $paginator->url($paginator->currentPage() - 1) }}&categorySearch={{ request()->query("categorySearch") }}" aria-label="Previous" class="page-link">
                    <span aria-hidden="true">&lsaquo;</span>
                </a>
            </li>
        @endif

        <!-- links -->
        @for($i = $from; $i <= $to; $i++)
            <?php 
            $isCurrentPage = $paginator->currentPage() == $i;
            ?>
            <li class="{{ $isCurrentPage ? 'active' : '' }} page-item">
                <a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}&categorySearch={{ request()->query("categorySearch") }}" class="page-link">
                    {{ $i }}
                </a>
            </li>
        @endfor

        <!-- next/last -->
        @if($paginator->currentPage() < $paginator->lastPage())
            <li class="page-item">
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}&categorySearch={{ request()->query("categorySearch") }}" aria-label="Next" class="page-link">
                    <span aria-hidden="true">&rsaquo;</span>
                </a>
            </li>

            <li class="page-item">
                <a href="{{ $paginator->url($paginator->lastpage()) }}&categorySearch={{ request()->query("categorySearch") }}" aria-label="Last" class="page-link">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
@endif