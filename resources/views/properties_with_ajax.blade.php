<style>
.img-box {
    width: 100%;
    height: 250px;       /* FIX HEIGHT */
    overflow: hidden;    /* IMPORTANT */
    border-radius: 10px;
}

.img-box img {
    width: 100%;
    height: auto !important;
    object-fit: cover;   /* MAIN FIX */
}
</style>
<!-- Grid Tab -->
<div class="tab-pane fade show active grid_body" id="homec-grid" role="tabpanel">
    <div class="row">
        @forelse ($properties as $property_item)
            <div class="col-md-6 col-12 mg-top-30">
                <!-- Single property-->
<a href="{{ route('property', html_decode($property_item->slug)) }}">
                <div class="homec-property">
                    <!-- Property Head-->
                    <div class="homec-property__head">
                    <div class="img-box">
                        <img src="{{ ($property_item->thumbnail_image)? asset($property_item->thumbnail_image) : asset($setting->default_placeholder)}}">
                    </div>
                        <!-- Top Sticky -->
                        <div class="homec-property__hsticky">

                            <div class="homec-heart-df">
                                <a href="javascript:;" class="homec-heart add-to-wishlist"
                                    data-property-id="{{ $property_item->id }}">
                                    <svg width="23" height="20" viewBox="0 0 23 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.5745 3.73257L11.1008 4.69447L11.6272 3.73258C11.9704 3.10535 12.5438 2.26267 13.3886 1.60933C14.2595 0.935774 15.2355 0.6 16.3044 0.6C19.29 0.6 21.6017 3.03446 21.6017 6.3966C21.6017 8.18186 20.8932 9.70959 19.5597 11.3187C18.211 12.9462 16.2694 14.6033 13.8617 16.6552L14.2508 17.1119L13.8617 16.6552L13.8611 16.6557C13.0479 17.3487 12.1237 18.1363 11.1625 18.9769L11.1623 18.977C11.1457 18.9916 11.1241 18.9999 11.1008 18.9999C11.0776 18.9999 11.056 18.9916 11.0394 18.9771L11.0391 18.9768C10.0784 18.1367 9.15452 17.3493 8.34203 16.6569L8.34054 16.6556L8.34053 16.6556C5.93251 14.6035 3.99081 12.9463 2.64202 11.3188C1.30844 9.70958 0.6 8.18186 0.6 6.3966C0.6 3.03446 2.91167 0.6 5.89732 0.6C6.96614 0.6 7.94219 0.935773 8.81311 1.60933C9.6579 2.26267 10.2313 3.10532 10.5745 3.73257Z"
                                            stroke-width="1.2" />
                                    </svg>
                                </a>
                                <a href="javascript:;" class="homec-heart add-to-compare"
                                    data-property-id="{{ $property_item->id }}">
                                    <span>
                                        <i class="fa-solid fa-shuffle"></i>
                                    </span>
                                </a>
                            </div>
                            <span class="homec-property__salebadge">

                                @if ($property_item->purpose == 'rent')
                                    {{ __('user.For Rent') }}
                                @else
                                    {{ __('user.For Sale') }}
                                @endif
                            </span>

                        </div>
                        <!-- End Top Sticky -->
                    </div>
                    <!-- Property Body-->
                    <div class="homec-property__body">
                        <div class="homec-property__topbar">
<div class="homec-property__price">
    {{ $setting->currency_icon }}{{ number_format(($property_item->total_price),2) }}
    <!-- <span>/Sf</span> -->
    <!-- @if ($property_item->purpose == 'rent')
    <span>/{{ $property_item->rent_period }}</span>
    @endif -->
</div>
                        </div>

                        <h3 class="homec-property__title">
                            <a href="{{ route('property', html_decode($property_item->slug)) }}">{{ html_decode($property_item->title) }}</a>
                        </h3>
                        <div class="homec-property__text">
                            <img src="{{ asset('frontend/img/location-icon.svg') }}" alt="address">
                            <p>{{ html_decode($property_item->address) }}</p>
                        </div>
                        <!-- Property List-->
                        <ul class="homec-property__list homec-border-top list-none">
                            <li><img src="{{ asset('frontend/img/room-icon2.svg') }}"
                                    alt="total_bedroom">{{ $property_item->total_bedroom }} {{ __('user.Bed') }}</li>
                            <li><img src="{{ asset('frontend/img/bath-icon2.svg') }}"
                                    alt="total_bathroom">{{ $property_item->total_bathroom }} {{ __('user.Bath') }}
                            </li>
                            <li><img src="{{ asset('frontend/img/size-icon2.svg') }}" alt="total_area">{{ html_decode($property_item->total_area) }} {{ __('user.m2') }}
                            </li>
                        </ul>
                    </div>
                </div>
</a>
                <!-- End Single property-->
            </div>
            @empty
                <h4 class="text-danger text-center mt-5">{{ __('user.Property not found!') }}</h4>
        @endforelse
    </div>
    <div class="row mg-top-40">
        {{ $properties->links('ajax_custom_pagination') }}
    </div>
</div>
<!-- End Grid Tab -->
<!-- List Tab -->
<div class="tab-pane fade list_body" id="homec-list" role="tabpanel">

    <div class="row">
        @foreach ($properties as $property_item)
            <div class="col-12 mg-top-30">
                <!-- Single property-->
                <div class="homec-property homec-property__list-style">
                    <!-- Property Head-->
                    <div class="homec-property__head">
                        <img src="{{ ($property_item->thumbnail_image)? asset($property_item->thumbnail_image) : asset($setting->default_placeholder)}}">
                        <!-- Top Sticky -->
                        <div class="homec-property__hsticky">
                            <a href="javascript:;" class="homec-heart add-to-wishlist"
                                data-property-id="{{ $property_item->id }}">
                                <svg width="23" height="20" viewBox="0 0 23 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.5745 3.73257L11.1008 4.69447L11.6272 3.73258C11.9704 3.10535 12.5438 2.26267 13.3886 1.60933C14.2595 0.935774 15.2355 0.6 16.3044 0.6C19.29 0.6 21.6017 3.03446 21.6017 6.3966C21.6017 8.18186 20.8932 9.70959 19.5597 11.3187C18.211 12.9462 16.2694 14.6033 13.8617 16.6552L14.2508 17.1119L13.8617 16.6552L13.8611 16.6557C13.0479 17.3487 12.1237 18.1363 11.1625 18.9769L11.1623 18.977C11.1457 18.9916 11.1241 18.9999 11.1008 18.9999C11.0776 18.9999 11.056 18.9916 11.0394 18.9771L11.0391 18.9768C10.0784 18.1367 9.15452 17.3493 8.34203 16.6569L8.34054 16.6556L8.34053 16.6556C5.93251 14.6035 3.99081 12.9463 2.64202 11.3188C1.30844 9.70958 0.6 8.18186 0.6 6.3966C0.6 3.03446 2.91167 0.6 5.89732 0.6C6.96614 0.6 7.94219 0.935773 8.81311 1.60933C9.6579 2.26267 10.2313 3.10532 10.5745 3.73257Z"
                                        stroke-width="1.2" />
                                </svg>
                            </a>
                            <span class="homec-property__salebadge">

                                @if ($property_item->purpose == 'rent')
                                    {{ __('user.For Rent') }}
                                @else
                                    {{ __('user.For Sale') }}
                                @endif
                            </span>

                        </div>
                        <!-- End Top Sticky -->
                    </div>
                    <!-- Property Body-->
                    <div class="homec-property__body">
                        <div class="homec-property__topbar">
                            <div class="homec-property__price">
                                {{ $setting->currency_icon }}{{ number_format(($property_item->total_price),2) }}
                                @if ($property_item->purpose == 'rent')
                                    <span>/{{ $property_item->rent_period }}</span>
                                @endif
                               <!-- bb {{ $property_item->price }}
                                @if ($property_item->purpose == 'rent')
                                    <span>/{{ $property_item->rent_period }}</span>
                                @endif -->
                            </div>
                        </div>

                        <h3 class="homec-property__title"><a
                                href="{{ route('property', html_decode($property_item->slug)) }}">{{ html_decode($property_item->title) }}</a>
                        </h3>
                        <div class="homec-property__text">
                            <img src="{{ asset('frontend/img/location-icon.svg') }}" alt="address">
                            <p>{{ html_decode($property_item->address) }}</p>
                        </div>

                        <!-- Property List-->
                        <ul class="homec-property__list homec-border-top list-none">
                            <li><img src="{{ asset('frontend/img/room-icon2.svg') }}"
                                    alt="total_bedroom">{{ $property_item->total_bedroom }} {{ __('user.Bed') }}</li>
                            <li><img src="{{ asset('frontend/img/bath-icon2.svg') }}"
                                    alt="total_bathroom">{{ $property_item->total_bathroom }} {{ __('user.Bath') }}
                            </li>
                            <li><img src="{{ asset('frontend/img/size-icon2.svg') }}"
                                    alt="total_area">{{ html_decode($property_item->total_area) }} {{ __('user.m2') }}
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Single property-->
            </div>
        @endforeach
    </div>
    <div class="row mg-top-40">
        {{ $properties->links('ajax_custom_pagination') }}
    </div>
</div>
<!-- End List Tab -->

<!-- List Tab -->
<div class="tab-pane fade map_body" id="map-grid" role="tabpanel">
    @php
        $initialMarkers = [];

        // Loop through each property and add to the array if lat and lon are not null
        foreach ($properties as $property_item) {
            if (!is_null($property_item->lat) && !is_null($property_item->lon)) {
                $initialMarkers[] = [
                    'position' => [
                        'lat' => $property_item->lat,
                        'lng' => $property_item->lon,
                    ],
                    'draggable' => false,
                ];
            }
        }
    @endphp

    <div class="row">
        <div class="pl-3">
            <div id="map" class="mg-top-30 map-height">

            </div>
        </div>
    </div>
</div>
<!-- End List Tab -->

<div class="modal fade" id="propertyModal" tabindex="-1" style="z-index: 9999999" role="dialog" aria-labelledby="propertyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="propertyModalLabel">{{ __('user.Property Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Dynamic content will be injected here -->
            </div>
        </div>
    </div>
</div>


<script>
    (function($) {
        "use strict";

        $(document).ready(function() {
            var initialLat = 23.822350;
            var initialLon = 90.365417;

            var map = L.map('map').setView([initialLat, initialLon], 6);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Create a marker cluster group
            const markerClusterGroup = L.markerClusterGroup();

            $('a[data-bs-toggle="list"]').on('shown.bs.tab', function(e) {
                if ($(e.target).attr('href') === '#map-grid') {
                    map.invalidateSize();
                }
            });

            initMarkers();

            function initMarkers() {
                const initialMarkers = <?php echo json_encode($initialMarkers); ?>;
                const properties = <?php echo json_encode($properties); ?>.data;
                const liveMapEnabled = "{{ $setting->live_map }}";

                if (!Array.isArray(properties)) {
                    console.error("Properties is not an array:", properties);
                    return;
                }

                for (let index = 0; index < initialMarkers.length; index++) {
                    const data = initialMarkers[index];
                    const property = properties.find(prop => prop.lat == data.position.lat && prop.lon == data.position.lng);

                    if (property && property.lat && property.lon && liveMapEnabled === 'yes') {
                        const marker = L.marker(data.position);

                        let baseRoute = "{{ url('/property') }}";

                        let propertiesRoute = `${baseRoute}/${property.slug}`;
                        // Create the popup content
                        const popupContent = `
                            <div class="popup-content" style="width: 200px;">
                                <a href="${propertiesRoute}">
                                <img height="50px" src="${property.thumbnail_image || 'default-image-url.jpg'}" class="card-img-top" alt="${property.title || 'Property Image'}">
                                    <p>${property.title || 'Unknown Property'}</p>
                                </a>
                            </div>
                        `;

                        // Bind the popup to the marker
                        marker.bindPopup(popupContent, { minWidth: 150, closeButton: true });

                        // Add marker to the cluster group
                        markerClusterGroup.addLayer(marker);
                    } else {
                        console.warn(`Property at index ${index} does not have lat/lon or is not enabled.`);
                    }
                }

                // Add the marker cluster group to the map
                map.addLayer(markerClusterGroup);
            }
        });

        $(document).ready(function() {

            $(".add-to-wishlist").on("click", function() {

                var isDemo = "{{ env('APP_MODE') }}"
                if (isDemo == 'DEMO') {
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                let property_id = $(this).data('property-id');

                $.ajax({
                    type: 'get',
                    url: "{{ url('/user/add-to-wishlist') }}" + "/" + property_id,
                    success: function(response) {
                        toastr.success(response.message)
                    },
                    error: function(err) {
                        if (err.status == 401) {
                            toastr.error("{{ __('user.Please login first') }}")
                        }

                        if (err.status == 403) {
                            let erro_message = err.responseJSON.message
                            toastr.error(erro_message)
                        }
                    }
                });
            })

            $(".add-to-compare").on("click", function() {
                var isDemo = "{{ env('APP_MODE') }}"
                if (isDemo == 'DEMO') {
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }
                let property_id = $(this).data('property-id');
                $.ajax({
                    type: 'get',
                    url: "{{ url('/user/add-to-compare') }}" + "/" + property_id,
                    success: function(response) {
                        toastr.success(response.message)
                    },
                    error: function(err) {
                        if (err.status == 401) {
                            toastr.error("{{ __('user.Please login first') }}")
                        }

                        if (err.status == 403) {
                            let erro_message = err.responseJSON.message
                            toastr.error(erro_message)
                        }
                    }
                });
            })
        });
    })(jQuery);
</script>
