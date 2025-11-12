<?php
$menuItems = \App\Models\MenuItem::where('url', $page->slug)->first()->children()->get();
?>
<section>
    @include('livewire.includes.page-hero');


    <!-- service-details -->
    <section class="service-details p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar mr_40">
                        <div class="text">
                            <h3>Categories</h3>
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
                                <a wire:navigate href="{{ $menuItem->url }}">
                                    {{ $menuItemTitle }}
                                </a>
                            </li>
                            @empty
                            <li><a href="#" style="color: #666;">No Sub Links available</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">
                        <div class="content-one">
                            <div class="text">

                                <h2>{{ $page->title }}</h2>
                                {!! $page->content !!}
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-details end -->

</section>
