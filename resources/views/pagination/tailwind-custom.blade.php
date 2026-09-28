@if ($paginator->hasPages())
    <nav class="flex flex-wrap items-center justify-between gap-3" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-400">Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Sebelumnya</a>
        @endif

        <div class="flex items-center gap-2">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-sm text-slate-400">{{ $element }}</span>
                @elseif (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-500 text-sm font-semibold text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-sm text-slate-700 transition hover:bg-blue-50 hover:text-blue-600">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50">Berikutnya</a>
        @else
            <span class="rounded-xl border border-slate-200 px-4 py-2 text-sm text-slate-400">Berikutnya</span>
        @endif
    </nav>
@endif
