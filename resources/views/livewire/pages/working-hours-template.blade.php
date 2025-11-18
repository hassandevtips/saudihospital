{{-- Page Hero --}}
@include('livewire.includes.page-hero')

{{-- Locations Map Section --}}
<section class="locations-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred mb_50">
            <span class="sub-title">{{ gt('our_locations', 'Our Locations') }}</span>
            <h2>{{ gt('find_us', 'Find Us on the Map') }}</h2>
            <p>{{ gt('visit_us', 'Visit us at any of our convenient locations') }}</p>
        </div>

        {{-- Google Map --}}
        <div class="map-container mb_50">
            <div id="map"
                style="width: 100%; height: 500px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
            </div>
        </div>

        {{-- Locations List with Working Hours --}}
        <div class="row clearfix">
            @forelse($locations as $location)
            <div class="col-lg-4 col-md-12 col-sm-4 location-block mb_30">
                <div class="location-card"
                    style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); height: 100%;">
                    <div class="location-header mb_20">
                        <h3 style="color: #0066b2; margin-bottom: 10px;">
                            <i class="fas fa-map-marker-alt" style="color: #e74c3c; margin-right: 10px;"></i>
                            {{ $location->name }}
                        </h3>
                        <p style="color: #666; margin-bottom: 5px;">
                            <i class="fas fa-location-dot" style="margin-right: 8px;"></i>
                            {{ $location->address }}
                        </p>
                        @if($location->description)
                        <p style="color: #888; font-size: 14px; margin-top: 10px;">{{ $location->description }}</p>
                        @endif
                    </div>

                    {{-- Contact Information --}}
                    <div class="contact-info mb_20" style="border-top: 1px solid #eee; padding-top: 15px;">
                        @if($location->phone)
                        <p style="margin-bottom: 8px;">
                            <i class="fas fa-phone" style="color: #0066b2; margin-right: 8px;"></i>
                            <a href="tel:{{ $location->phone }}" style="color: #333;">{{ $location->phone }}</a>
                        </p>
                        @endif
                        @if($location->email)
                        <p style="margin-bottom: 8px;">
                            <i class="fas fa-envelope" style="color: #0066b2; margin-right: 8px;"></i>
                            <a href="mailto:{{ $location->email }}" style="color: #333;">{{ $location->email }}</a>
                        </p>
                        @endif
                    </div>

                    {{-- Working Hours --}}
                    <div class="working-hours" style="border-top: 1px solid #eee; padding-top: 15px;">
                        <h4 style="color: #0066b2; margin-bottom: 15px; font-size: 16px;">
                            <i class="fas fa-clock" style="margin-right: 8px;"></i>
                            {{ gt('working_hours', 'Working Hours') }}
                        </h4>
                        <div class="hours-list">
                            @if($location->working_hours && is_array($location->working_hours))
                            @foreach($location->working_hours as $schedule)
                            @if(isset($schedule['day']))
                            <div class="day-schedule"
                                style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f5f5f5;">
                                <span style="font-weight: 500; text-transform: capitalize; color: #333;">
                                    {{ ucfirst($schedule['day']) }}
                                </span>
                                <span
                                    style="color: {{ ($schedule['is_open'] ?? false) ? '#27ae60' : '#e74c3c' }}; font-weight: 500;">
                                    @if($schedule['is_open'] ?? false)
                                    {{ $schedule['open_time'] ?? '08:00' }} - {{ $schedule['close_time'] ?? '17:00'
                                    }}
                                    @else
                                    Closed
                                    @endif
                                </span>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <p style="color: #888;">Working hours not available</p>
                            @endif
                        </div>
                    </div>

                    {{-- Get Directions Button --}}
                    <div class="location-actions"
                        style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee;">
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $location->latitude }},{{ $location->longitude }}"
                            target="_blank" class="theme-btn btn-one"
                            style="display: inline-block; padding: 10px 30px; background: #0066b2; color: #fff; border-radius: 5px; text-decoration: none; transition: all 0.3s;">
                            <i class="fas fa-directions" style="margin-right: 8px;"></i>
                            {{ gt('get_directions', 'Get Directions') }}
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="alert alert-info" style="text-align: center; padding: 30px;">
                    <i class="fas fa-info-circle" style="font-size: 48px; color: #0066b2; margin-bottom: 15px;"></i>
                    <h4>No Locations Available</h4>
                    <p>Location information will be displayed here once added.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Google Maps JavaScript --}}
@push('scripts')
<script>
    let map;
        let markers = [];
        let infoWindows = [];

        function initMap() {
            // Default center (will be adjusted to show all markers)
            const defaultCenter = { lat: 31.9539, lng: 35.9106 }; // Amman, Jordan

            // Create map
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: defaultCenter,
                styles: [
                    {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{ visibility: "off" }]
                    }
                ]
            });

            // Locations data
            const locations = @json($locationsForMap);

            if (locations.length === 0) {
                return;
            }

            // Create bounds to fit all markers
            const bounds = new google.maps.LatLngBounds();

            // Add markers for each location
            locations.forEach((location, index) => {
                const position = { lat: location.lat, lng: location.lng };

                // Create marker with custom icon if available
                const markerOptions = {
                    position: position,
                    map: map,
                    title: location.name,
                    animation: google.maps.Animation.DROP
                };

                // Use custom icon if available, otherwise use default red marker
                if (location.marker_icon) {
                    markerOptions.icon = {
                        url: location.marker_icon,
                        scaledSize: new google.maps.Size(40, 40)
                    };
                } else {
                    markerOptions.icon = {
                        url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                        scaledSize: new google.maps.Size(40, 40)
                    };
                }

                const marker = new google.maps.Marker(markerOptions);

                // Create info window content
                let infoContent = `
                    <div style="padding: 10px; max-width: 300px;">
                        <h3 style="color: #0066b2; margin-bottom: 10px; font-size: 16px;">${location.name}</h3>
                        <p style="margin-bottom: 8px; color: #666; font-size: 14px;">
                            <i class="fas fa-location-dot" style="margin-right: 5px;"></i>
                            ${location.address}
                        </p>
                `;

                if (location.phone) {
                    infoContent += `
                        <p style="margin-bottom: 8px; font-size: 14px;">
                            <i class="fas fa-phone" style="margin-right: 5px; color: #0066b2;"></i>
                            <a href="tel:${location.phone}" style="color: #333;">${location.phone}</a>
                        </p>
                    `;
                }

                if (location.email) {
                    infoContent += `
                        <p style="margin-bottom: 8px; font-size: 14px;">
                            <i class="fas fa-envelope" style="margin-right: 5px; color: #0066b2;"></i>
                            <a href="mailto:${location.email}" style="color: #333;">${location.email}</a>
                        </p>
                    `;
                }

                infoContent += `
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${location.lat},${location.lng}"
                           target="_blank"
                           style="display: inline-block; margin-top: 10px; padding: 8px 15px; background: #0066b2; color: #fff; border-radius: 5px; text-decoration: none; font-size: 13px;">
                            Get Directions
                        </a>
                    </div>
                `;

                const infoWindow = new google.maps.InfoWindow({
                    content: infoContent
                });

                // Add click listener to marker
                marker.addListener('click', () => {
                    // Close all other info windows
                    infoWindows.forEach(iw => iw.close());
                    // Open this info window
                    infoWindow.open(map, marker);
                });

                markers.push(marker);
                infoWindows.push(infoWindow);
                bounds.extend(position);
            });

            // Fit map to show all markers
            if (locations.length > 1) {
                map.fitBounds(bounds);
            } else if (locations.length === 1) {
                map.setCenter(bounds.getCenter());
                map.setZoom(15);
            }
        }

        // Load Google Maps API
        function loadGoogleMapsAPI() {
            const script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key={{ $settings['google_maps_api_key'] }}&sensor=false&callback=initMap';
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }

        // Initialize when page loads
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadGoogleMapsAPI);
        } else {
            loadGoogleMapsAPI();
        }
</script>
@endpush