<div>
    <footer class="main-footer p_relative">
        <div class="widget-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="about-widget footer-widget mr_40">
                            <div class="footer-logo">
                                <figure class="logo"><a href="#"><img src="{{ asset('assets/images/footer-logo.png') }}"
                                            alt=""></a></figure>
                            </div>
                            <div class="widget-content" style="margin-top: 20px;">
                                <p>{{ gt('footer_about') }}</p>
                                <ul class="social-links clearfix">
                                    <li><a href="{{ $settings['facebook'] }}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{ $settings['twitter'] }}"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{ $settings['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget ml_100">
                            <div class="widget-title">
                                <h3>{{ gt('links', 'Links') }}</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    @php
                                    $topMenu = \App\Models\Menu::with('items.children')
                                    ->where('key', 'footer-menu')
                                    ->first();
                                    $menuItems = $topMenu ? $topMenu->getItemsArray() : [];
                                    @endphp
                                    @foreach($menuItems as $item)
                                    <li>
                                        @php
                                        $title = $item['title'] ?? '';
                                        if (is_array($title)) {
                                        $locale = app()->getLocale();
                                        $title = $title[$locale] ?? $title['en'] ?? ($title[array_key_first($title)] ??
                                        '');
                                        }
                                        @endphp
                                        <a href="{{ $item['url'] }}" target="{{ $item['blank'] ? '_blank' : '_self' }}">
                                            {{ $title }}
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget ml_30">
                            <div class="widget-title">
                                <h3>{{ gt('our_departments', 'Our Departments') }}</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    @forelse($departments as $department)
                                    <li>
                                        <a href="{{ route('doctors', ['department' => $department->id]) }}">
                                            {{ $department->name }}
                                        </a>
                                    </li>
                                    @empty
                                    <li><a href="#" style="color: #666;">No departments available</a></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="contact-widget footer-widget ml_50">
                            <div class="widget-title">
                                <h3>{{ gt('contacts', 'Contacts') }}</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info clearfix">
                                    <li>{{ $settings['address'] }}</li>
                                    <li><a href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a></li>
                                    <li><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer-logo">
                                <figure class="logo"><a href="#"><img src="assets/images/iso.png" alt=""></a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom centred">
            <div class="auto-container">
                <div class="copyright">
                    <p>{{ gt('copyright', 'Copyright © 2025 Al Saudi Hospital All Rights Reserved') }} <br>{{
                        gt('designed-by', 'Designed By : GULF TECH') }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->
</div>
