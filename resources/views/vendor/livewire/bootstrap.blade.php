<div>
    @if ($paginator->hasPages())
        <nav class="d-flex align-items-center">
            <div>
                <p class="">
                    <span>{!! __('Mostrando') !!}</span>
                    <span class="">{{ $paginator->firstItem() }}</span>
                    <span>{!! __('de') !!}</span>
                    <span class="">{{ $paginator->lastItem() }}</span>
                    <span>{!! __('Total') !!}</span>
                    <span class="">{{ $paginator->total() }}</span>
                    <span>{!! __('resultados') !!}</span>
                </p>
            </div>
            <ul class="ml-2 pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <button type="button" dusk="previousPage" class="page-link" wire:click="previousPage"
                            wire:loading.attr="disabled" rel="prev"
                            aria-label="@lang('pagination.previous')">&lsaquo;</button>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" wire:key="paginator-page-{{ $page }}"
                                    aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item" wire:key="paginator-page-{{ $page }}"><button
                                        type="button" class="page-link"
                                        wire:click="gotoPage({{ $page }})">{{ $page }}</button></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button type="button" dusk="nextPage" class="page-link" wire:click="nextPage"
                            wire:loading.attr="disabled" rel="next"
                            aria-label="@lang('pagination.next')">&rsaquo;</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
