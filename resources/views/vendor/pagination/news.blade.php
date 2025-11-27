@php
$isRTL = app()->getLocale() === 'ar';
@endphp

@if ($paginator->hasPages())
<ul class="pagination clearfix">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled">
        <span><i class="fas fa-angle-{{ $isRTL ? 'right' : 'left' }}"></i></span>
    </li>
    @else
    <li>
        <a wire:navigate href="{{ $paginator->previousPageUrl() }}" rel="prev">
            <i class="fas fa-angle-{{ $isRTL ? 'right' : 'left' }}"></i>
        </a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="dot">
        <span>{{ $element }}</span>
    </li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="current">
        <span aria-current="page">{{ $page }}</span>
    </li>
    @else
    <li>
        <a wire:navigate href="{{ $url }}">{{ $page }}</a>
    </li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li>
        <a wire:navigate href="{{ $paginator->nextPageUrl() }}" rel="next">
            <i class="fas fa-angle-{{ $isRTL ? 'left' : 'right' }}"></i>
        </a>
    </li>
    @else
    <li class="disabled">
        <span><i class="fas fa-angle-{{ $isRTL ? 'left' : 'right' }}"></i></span>
    </li>
    @endif
</ul>
@endif
