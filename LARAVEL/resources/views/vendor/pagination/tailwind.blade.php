@php
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    $start = max(1, $current - 2);
    $end = min($last, $current + 2);
@endphp

@if ($paginator->hasPages())
    <div class="flex items-center justify-center gap-1 mt-8 text-sm select-none">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 border border-gray-300 rounded text-gray-300 cursor-default">
                &laquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 bg-white border border-gray-300 rounded text-gray-700 hover:bg-blue-50 transition">
                &laquo;
            </a>
        @endif

        {{-- First + Ellipsis --}}
        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}"
                class="px-3 py-1 border border-gray-300 rounded hover:bg-blue-50 transition {{ $current == 1 ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' }}">
                1
            </a>
            @if ($start > 2)
                <span class="px-2 text-gray-400">…</span>
            @endif
        @endif

        {{-- Page Numbers --}}
        @for ($i = $start; $i <= $end; $i++)
            <a href="{{ $paginator->url($i) }}"
                class="px-3 py-1 border border-gray-300 rounded transition
                {{ $current == $i ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-blue-50' }}">
                {{ $i }}
            </a>
        @endfor

        {{-- Last + Ellipsis --}}
        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="px-2 text-gray-400">…</span>
            @endif
            <a href="{{ $paginator->url($last) }}"
                class="px-3 py-1 border border-gray-300 rounded hover:bg-blue-50 transition {{ $current == $last ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' }}">
                {{ $last }}
            </a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-1 bg-white border border-gray-300 rounded text-gray-700 hover:bg-blue-50 transition">
                &raquo;
            </a>
        @else
            <span class="px-3 py-1 border border-gray-300 rounded text-gray-300 cursor-default">
                &raquo;
            </span>
        @endif
    </div>
@endif
