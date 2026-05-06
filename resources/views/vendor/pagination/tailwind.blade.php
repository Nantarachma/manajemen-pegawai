@if ($paginator->hasPages())
    <nav class="flex flex-col sm:flex-row items-center justify-between gap-3">
        {{-- Mobile pagination --}}
        <div class="flex justify-between w-full sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-gray-400 bg-transparent rounded-[10px]">@lang('pagination.previous')</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 text-sm text-text-secondary bg-transparent rounded-[10px] hover:bg-ocean-wash hover:text-ocean-dark transition-all no-underline">@lang('pagination.previous')</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 text-sm text-text-secondary bg-transparent rounded-[10px] hover:bg-ocean-wash hover:text-ocean-dark transition-all no-underline">@lang('pagination.next')</a>
            @else
                <span class="px-4 py-2 text-sm text-gray-400 bg-transparent rounded-[10px]">@lang('pagination.next')</span>
            @endif
        </div>

        {{-- Desktop pagination --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between sm:w-full">
            <div class="text-[13px] text-text-muted">
                Menampilkan <span class="font-semibold">{{ $paginator->firstItem() }}</span>
                – <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                dari <span class="font-semibold">{{ $paginator->total() }}</span> data
            </div>

            <div class="flex items-center gap-1">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-300 rounded-[10px]" aria-disabled="true">&lsaquo;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-2 text-sm text-text-secondary rounded-[10px] hover:bg-ocean-wash hover:text-ocean-dark transition-all no-underline">&lsaquo;</a>
                @endif

                {{-- Pages --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 py-2 text-sm text-gray-400 rounded-[10px]">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3.5 py-2 text-sm font-semibold text-white bg-ocean-dark rounded-[10px] shadow-[0_2px_6px_rgba(0,119,182,0.3)]" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3.5 py-2 text-sm font-medium text-text-secondary rounded-[10px] hover:bg-ocean-wash hover:text-ocean-dark transition-all no-underline">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-2 text-sm text-text-secondary rounded-[10px] hover:bg-ocean-wash hover:text-ocean-dark transition-all no-underline">&rsaquo;</a>
                @else
                    <span class="px-3 py-2 text-sm text-gray-300 rounded-[10px]" aria-disabled="true">&rsaquo;</span>
                @endif
            </div>
        </div>
    </nav>
@endif
