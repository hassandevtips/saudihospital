@props(['menu'])

@php
// Ensure we have the current locale set
$currentLocale = app()->getLocale();

// Get menu items - they should already be translated by the Menu model
$menuItems = $menu ? $menu->getItemsArray() : [];
@endphp

<ul class="navigation clearfix">
    @if(!empty($menuItems))
    @foreach($menuItems as $item)
    @php
    $hasChildren = isset($item['children']) && is_array($item['children']) && count($item['children']) > 0;
    $itemUrl = $item['url'] ?? '#';
    $itemTitle = $item['title'] ?? '';
    if (is_array($itemTitle)) {
    $itemTitle = $itemTitle[$currentLocale] ?? $itemTitle[config('app.fallback_locale')] ?? reset($itemTitle) ?? '';
    }
    $itemBlank = isset($item['blank']) && $item['blank'];
    // Check if this is an internal link that should use wire:navigate
    $isInternalLink = !$itemBlank
    && $itemUrl !== '#'
    && !str_starts_with($itemUrl, 'http://')
    && !str_starts_with($itemUrl, 'https://')
    && !str_starts_with($itemUrl, 'mailto:')
    && !str_starts_with($itemUrl, 'tel:');
    @endphp
    <li class="{{ $hasChildren ? 'dropdown' : '' }}">
        <a wire:navigate href="{{ $itemUrl }}" @if($itemBlank) target="_blank" @endif @if($isInternalLink) wire:navigate
            @endif>
            {{ $itemTitle }}
        </a>

        @if($hasChildren)
        @php
        $childrenCount = count($item['children']);
        $columnsNeeded = min(4, max(1, ceil($childrenCount / 3)));
        $itemsPerColumn = max(1, ceil($childrenCount / $columnsNeeded));
        $chunkedChildren = array_chunk($item['children'], $itemsPerColumn);
        $colSize = 12 / $columnsNeeded;
        @endphp
        <div class="megamenu">
            <div class="row clearfix">
                @foreach($chunkedChildren as $childGroup)
                <div class="col-lg-{{ $colSize }} column">
                    <ul>
                        @foreach($childGroup as $child)
                        @php
                        $childUrl = $child['url'] ?? '#';
                        $childTitle = $child['title'] ?? '';
                        if (is_array($childTitle)) {
                        $childTitle = $childTitle[$currentLocale] ?? $childTitle[config('app.fallback_locale')] ??
                        reset($childTitle) ?? '';
                        }
                        $childBlank = isset($child['blank']) && $child['blank'];
                        // Check if this is an internal link that should use wire:navigate
                        $isChildInternalLink = !$childBlank
                        && $childUrl !== '#'
                        && !str_starts_with($childUrl, 'http://')
                        && !str_starts_with($childUrl, 'https://')
                        && !str_starts_with($childUrl, 'mailto:')
                        && !str_starts_with($childUrl, 'tel:');
                        @endphp
                        <li>
                            <a href="{{ $childUrl }}" @if($childBlank) target="_blank" @endif @if($isChildInternalLink)
                                wire:navigate @endif>
                                {{ $childTitle }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </li>
    @endforeach
    @else
    {{-- Default menu if no dynamic menu is set --}}
    <li><a href="/" wire:navigate>Home</a></li>
    <li class="dropdown"><a href="#">About Us</a>
        <div class="megamenu">
            <div class="row clearfix">
                <div class="col-lg-4 column">
                    <ul>
                        <li><a href="#">Our History</a></li>
                        <li><a href="#">Core Values</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 column">
                    <ul>
                        <li><a href="#">Group Overview</a></li>
                        <li><a href="#">Board Members</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 column">
                    <ul>
                        <li><a href="#">Vision Mission</a></li>
                        <li><a href="#">Our Doctors</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li><a href="#">Our Doctors</a></li>
    <li><a href="#">Media</a></li>
    <li><a href="#">Contact Us</a></li>
    @endif
</ul>
