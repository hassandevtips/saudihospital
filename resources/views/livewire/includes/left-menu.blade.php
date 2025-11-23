<?php
if (isset($static_menu_id)) {
    $menuItemsParent = \App\Models\MenuItem::where('id', $static_menu_id)->first();
} else {
     $menuItemsParent = \App\Models\MenuItem::where('url', $page->slug)->first();
}
if ($menuItemsParent) {
    $menuItems = $menuItemsParent->children()->get();
    if ($menuItems->isEmpty()) {
        $menuItems = $menuItemsParent->parent()->first()->children()->get();
    }
} else {
    $menuItems = [];
}


$parent_menu_id = $menuItemsParent->parent()->first()->id ?? $menuItemsParent->id;

?>

@php
$menuItemsParentTitle = $menuItemsParent->getTranslation('title', app()->getLocale());
if (is_array($menuItemsParentTitle)) {
$menuItemsParentTitle = collect($menuItemsParentTitle)->flatten()->filter()->first() ?? '';
}
@endphp

<div class="service-sidebar mr_40">
    <div class="text">
        <h3>{{ $menuItemsParentTitle }}</h3>
    </div>
    <ul class="category-list clearfix">
        @forelse($menuItems as $menuItem)
        @php
        $menuItemTitle = $menuItem->getTranslation('title', app()->getLocale());
        if (is_array($menuItemTitle)) {
        $menuItemTitle = collect($menuItemTitle)->flatten()->filter()->first() ?? '';
        }
        @endphp
        <li>

            <a @if($parent_menu_id !=60) wire:navigate @endif href="{{ url($menuItem->url) }}" @class(['current'=>
                request()->is($menuItem->url)])>
                {{ $menuItemTitle }}
            </a>
        </li>
        @empty
        <li><a href="#" style="color: #666;">{{ gt('no_sub_links', 'No Sub Links available') }}</a></li>
        @endforelse
    </ul>
</div>