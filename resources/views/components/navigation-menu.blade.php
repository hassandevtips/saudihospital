@props(['menu'])

<ul class="navigation clearfix">
    @if($menu && $menu->items)
    @foreach($menu->items as $item)
    <li class="{{ isset($item['children']) && count($item['children']) > 0 ? 'dropdown' : '' }}">
        <a href="{{ $item['url'] ?? '#' }}" @if(isset($item['blank']) && $item['blank']) target="_blank" @endif>
            {{ $item['title'] }}
        </a>

        @if(isset($item['children']) && count($item['children']) > 0)
        @php
        $childrenCount = count($item['children']);
        $columnsNeeded = min(4, ceil($childrenCount / 3));
        $chunkedChildren = array_chunk($item['children'], ceil($childrenCount / $columnsNeeded));
        @endphp
        <div class="megamenu">
            <div class="row clearfix">
                @foreach($chunkedChildren as $childGroup)
                <div class="col-lg-{{ 12 / $columnsNeeded }} column">
                    <ul>
                        @foreach($childGroup as $child)
                        <li>
                            <a href="{{ $child['url'] ?? '#' }}" @if(isset($child['blank']) && $child['blank'])
                                target="_blank" @endif>
                                {{ $child['title'] }}
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
    <li><a href="/">Home</a></li>
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