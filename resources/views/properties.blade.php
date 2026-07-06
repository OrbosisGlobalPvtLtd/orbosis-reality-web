@extends('layout')

@section('title')
    <title>{{ $seo_setting->seo_title }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $seo_setting->seo_description }}">
    <meta name="title" content="{{ $seo_setting->seo_title }}">
    <meta name="keywords" content="{{ $seo_setting->seo_title }}">
@endsection

@section('frontend-content')
    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <!-- <div class="homec-overlay"></div> -->
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{ __('user.Home') }}</a></li>
                            <li class="active"><a
                             href="{{ route('properties', ['purpose' => 'any']) }}">{{ __('user.Properties') }}</a>
                            </li>
                        </ul>
                        @if (request()->has('top_property'))
                            <h2 class="breadcrumb__title m-0">{{ __('user.Top Properties') }}</h2>
                        @elseif (request()->has('urgent_property'))
                            <h2 class="breadcrumb__title m-0">{{ __('user.Urgent Properties') }}</h2>
                        @elseif (request()->has('featured_property'))
                            <h2 class="breadcrumb__title m-0">{{ __('user.Featured Properties') }}</h2>
                        @else
                            <h2 class="breadcrumb__title m-0">{{ __('user.Properties') }}</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End breadcrumbs -->
    <!-- Property -->

    <section class="homec-propertys pd-top-80 pd-btm-80">
        <div class="container">
            <form id="propertySearchForm">
                @if (request()->has('top_property'))
                    <input type="hidden" name="top_property" value="enable">
                @endif
                
                @if (request()->has('featured_property'))
                    <input type="hidden" name="featured_property" value="enable">
                @endif

                @if (request()->has('urgent_property'))
                    <input type="hidden" name="urgent_property" value="enable">
                @endif

                <!-- CSS Styling -->
                <style>
                    .homec-propertys {
                        background-color: #f8fafc !important;
                    }

                    .homec-property {
                        cursor: pointer;
                    }

                    /* Truncate Title to max 2 lines with ellipsis & set standard height to align cards */
                    .homec-property__title a {
                        display: -webkit-box !important;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        min-height: 48px;
                        line-height: 24px;
                    }

                    /* Truncate Address to max 2 lines with ellipsis & set standard height to align cards */
                    .homec-property__text p {
                        display: -webkit-box !important;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        min-height: 40px;
                        line-height: 20px;
                        margin: 0;
                    }

                    .homec-filter-wrapper {
                        position: relative;
                        margin-top: -60px;
                        z-index: 100;
                        margin-bottom: 40px;
                    }
                    
                    .homec-filter-card {
                        background: #ffffff;
                        border-radius: 16px;
                        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
                        padding: 24px 30px;
                        border: 1px solid rgba(0, 0, 0, 0.04);
                    }
                    
                    .homec-filter-grid {
                        display: grid;
                        grid-template-columns: 1.5fr 1fr 1fr 1fr 1.5fr;
                        gap: 16px;
                        align-items: flex-end;
                    }
                    
                    .homec-filter-group {
                        display: flex;
                        flex-direction: column;
                        gap: 8px;
                        align-items: flex-start !important;
                        text-align: left !important;
                    }
                    
                    .homec-filter-label {
                        font-size: 13px;
                        font-weight: 700;
                        color: #1e293b;
                        margin: 0;
                        text-transform: capitalize;
                        text-align: left !important;
                    }
                    
                    .homec-filter-input, .homec-filter-select {
                        width: 100%;
                        height: 48px;
                        padding: 10px 14px;
                        border-radius: 8px;
                        border: 1px solid #e2e8f0;
                        background-color: #ffffff;
                        font-size: 14px;
                        color: #334155;
                        outline: none;
                        transition: all 0.3s ease;
                    }
                    
                    .homec-filter-input {
                        cursor: text;
                    }

                    .homec-filter-select {
                        cursor: pointer;
                    }
                    
                    .homec-filter-input:focus, .homec-filter-select:focus {
                        border-color: #0052cc;
                        box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
                    }
                    
                    .homec-price-range-group {
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        height: 48px;
                    }
                    
                    .homec-price-input {
                        flex: 1;
                        height: 100%;
                        padding: 10px 12px;
                        border-radius: 8px;
                        border: 1px solid #e2e8f0;
                        background-color: #ffffff;
                        font-size: 14px;
                        color: #334155;
                        outline: none;
                        text-align: center;
                        transition: all 0.3s ease;
                    }
                    
                    .homec-price-input:focus {
                        border-color: #0052cc;
                        box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
                    }
                    
                    .homec-price-separator {
                        color: #94a3b8;
                        font-weight: 500;
                    }
                    
                    /* Results Bar styling */
                    .homec-results-bar {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 24px;
                        flex-wrap: wrap;
                        gap: 16px;
                    }
                    
                    .homec-results-count {
                        font-size: 16px;
                        font-weight: 600;
                        color: #475569;
                    }
                    
                    .homec-results-actions {
                        display: flex;
                        align-items: center;
                        gap: 16px;
                    }
                    
                    .custom-view-switcher {
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        background: #f1f5f9;
                        padding: 4px;
                        border-radius: 8px;
                    }
                    
                    .custom-view-switcher .view-btn {
                        width: 36px;
                        height: 36px;
                        border-radius: 6px;
                        background: transparent;
                        color: #64748b;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: none;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }
                    
                    .custom-view-switcher .view-btn.active {
                        background: #ffffff;
                        color: #0052cc;
                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                    }
                    
                    .homec-results-sort {
                        height: 44px;
                        padding: 0 14px;
                        border-radius: 8px;
                        border: 1px solid #e2e8f0;
                        background: #ffffff;
                        color: #334155;
                        font-size: 14px;
                        cursor: pointer;
                        outline: none;
                    }
                    
                    .homec-results-sort:focus {
                        border-color: #0052cc;
                    }
                    
                    /* Responsive tweaks */
                    @media (max-width: 1199px) {
                        .homec-filter-grid {
                            grid-template-columns: 1fr 1fr;
                        }
                    }
                    
                    @media (max-width: 767px) {
                        .homec-filter-wrapper {
                            margin-top: 20px;
                        }
                        .homec-filter-grid {
                            grid-template-columns: 1fr;
                        }
                        .homec-results-bar {
                            flex-direction: column;
                            align-items: flex-start;
                        }
                    }
                </style>

                <!-- Horizontal Filter Card Wrapper -->
                <div class="homec-filter-wrapper">
                    <div class="homec-filter-card">
                        <div class="homec-filter-grid">
                            <!-- Search Input Field (first) -->
                            <div class="homec-filter-group">
                                <label class="homec-filter-label">{{ __('user.Search Property') }}</label>
                                <input value="{{ request()->get('search') }}" id="search_input" name="search" type="text" class="homec-filter-input" placeholder="{{ __('user.Search Property') }}...">
                            </div>

                            <!-- Purpose Select -->
                            <div class="homec-filter-group">
                                <label class="homec-filter-label">{{ __('user.Purpose') }}</label>
                                <select class="homec-filter-select select_search" name="purpose">
                                    <option {{ request()->get('purpose') == 'any' || !request()->has('purpose') ? 'selected' : '' }} value="any">{{ __('user.Any') }}</option>
                                    <option {{ request()->get('purpose') == 'buy' ? 'selected' : '' }} value="buy">{{ __('For Buy') }}</option>
                                    <option {{ request()->get('purpose') == 'sale' ? 'selected' : '' }} value="sale">{{ __('user.For Sale') }}</option>
                                    <option {{ request()->get('purpose') == 'rent' ? 'selected' : '' }} value="rent">{{ __('user.For Rent') }}</option>
                                </select>
                            </div>

                            <!-- City Select -->
                            <div class="homec-filter-group">
                                <label class="homec-filter-label">{{ __('user.City') }}</label>
                                <select class="homec-filter-select city_location select_search" name="city">
                                    <option value="">{{ __('Select City') }}</option>
                                    @foreach ($locations as $city)
                                        <option {{ request()->get('city') == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Property Type Select -->
                            <div class="homec-filter-group">
                                <label class="homec-filter-label">{{ __('user.Property Type') }}</label>
                                <select class="homec-filter-select select_search" name="type">
                                    <option value="">{{ __('Select Type') }}</option>
                                    @foreach ($property_types as $property_type)
                                        <option {{ request()->get('type') == $property_type->slug ? 'selected' : '' }} value="{{ $property_type->slug }}">{{ $property_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Range Inputs -->
                            <div class="homec-filter-group">
                                <label class="homec-filter-label">{{ __('Price Range') }}</label>
                                <div class="homec-price-range-group">
                                    <input type="number" name="min_price" id="min_price" class="homec-price-input" placeholder="Min Price" value="{{ request()->get('min_price') }}">
                                    <span class="homec-price-separator">-</span>
                                    <input type="number" name="max_price" id="max_price" class="homec-price-input" placeholder="Max Price" value="{{ request()->get('max_price') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Count & View Switcher & Sorting Row -->
                <div class="homec-results-bar">
                    <div class="homec-results-count">
                        <span id="results_count_text">
                            {{-- Placeholder: Will be updated by AJAX --}}
                        </span>
                    </div>
                    <div class="homec-results-actions">
                        <div class="custom-view-switcher">
                            <button type="button" class="view-btn active grid_view" data-view="grid" title="Grid View">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </button>
                            <button type="button" class="view-btn list_view" data-view="list" title="List View">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                </svg>
                            </button>
                            @if ($setting->live_map == 'yes')
                            <button type="button" class="view-btn map_view" data-view="map" title="Map View">
                                <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                                <line x1="8" y1="2" x2="8" y2="18"></line>
                                <line x1="16" y1="6" x2="16" y2="22"></line>
                            </button>
                            @endif
                        </div>

                        <select class="homec-results-sort select_search" name="others_sorting">
                            <option {{ request()->get('others_sorting') == 'default_sort' ? 'selected' : '' }} value="default_sort">{{ __('user.Default Sorting') }}</option>
                            <option {{ request()->get('others_sorting') == 'price_low_to_high' ? 'selected' : '' }} value="price_low_to_high">{{ __('user.Price : low to high') }}</option>
                            <option {{ request()->get('others_sorting') == 'price_high_to_low' ? 'selected' : '' }} value="price_high_to_low">{{ __('user.Price : high to low') }}</option>
                            <option {{ request()->get('others_sorting') == 'sort_by_newest' ? 'selected' : '' }} value="sort_by_newest">{{ __('user.Sort by newest') }}</option>
                            <option {{ request()->get('others_sorting') == 'sort_by_oldest' ? 'selected' : '' }} value="sort_by_oldest">{{ __('user.Sort by oldest') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Full Width Properties List -->
                <div class="row">
                    <div class="col-12">
                        <div class="spinner_hidden_box d-none">
                            <div class="tab-pane fade show active" id="homec-grid" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 text-center my-5">
                                        <img class="spinner-element" src="{{ asset('uploads/website-images/Spinner.gif') }}" alt="loading...">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="homec-list" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 text-center my-5">
                                        <img class="spinner-element" src="{{ asset('uploads/website-images/Spinner.gif') }}" alt="loading...">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="map-grid" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 text-center my-5">
                                        <img class="spinner-element" src="{{ asset('uploads/website-images/Spinner.gif') }}" alt="loading...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <!-- Dynamic Content loaded via AJAX -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Property -->
    @php
        $price_min_value = 0;
        $price_max_value = $max_price;

        if (request()->has('min_price')) {
            $price_min_value = request()->get('min_price');
        }
        if (request()->has('max_price')) {
            $price_max_value = request()->get('max_price');
        }
    @endphp

    <script>
        let grid_view = true;
        (function($) {
            "use strict";
            $(document).ready(function() {

                loadPropertyWithAjax();

                // Debounce function to limit automatic AJAX requests while typing
                function debounce(func, wait) {
                    let timeout;
                    return function(...args) {
                        const context = this;
                        clearTimeout(timeout);
                        timeout = setTimeout(() => func.apply(context, args), wait);
                    };
                }

                // Handle view toggles
                $(document).on("click", ".custom-view-switcher .view-btn", function() {
                    $(".custom-view-switcher .view-btn").removeClass("active");
                    $(this).addClass("active");
                    
                    let view = $(this).data("view");
                    if (view === "grid") {
                        $(".grid_body").addClass('show active');
                        $(".list_body").removeClass('show active');
                        $(".map_body").removeClass('show active');
                    } else if (view === "list") {
                        $(".grid_body").removeClass('show active');
                        $(".list_body").addClass('show active');
                        $(".map_body").removeClass('show active');
                    } else if (view === "map") {
                        $(".grid_body").removeClass('show active');
                        $(".list_body").removeClass('show active');
                        $(".map_body").addClass('show active');
                    }
                });

                // Auto-submit triggers for select elements
                $(".select_search").on("change", function() {
                    $("#propertySearchForm").submit();
                });

                $(document).on("change", ".city_location", function() {
                    $("#propertySearchForm").submit();
                });

                // Input events with debouncing for smooth search while typing
                $(document).on("input keyup", "#search_input, #min_price, #max_price", debounce(function() {
                    $("#propertySearchForm").submit();
                }, 400));

                // Click handler for entire property card navigation
                $(document).on('click', '.homec-property', function(e) {
                    if ($(e.target).closest('a, button, input, select').length) {
                        return;
                    }
                    var url = $(this).find('.homec-property__title a').attr('href');
                    if (url) {
                        window.location.href = url;
                    }
                });

                $("#propertySearchForm").on("submit", function(e) {
                    e.preventDefault();
                    let spinner_box = $(".spinner_hidden_box").html();
                    $('#nav-tabContent').html(spinner_box);

                    $.ajax({
                        type: 'get',
                        data: $('#propertySearchForm').serialize(),
                        url: "{{ route('properties-with-ajax') }}",
                        success: function(response) {
                            $('#nav-tabContent').html(response);
                            updateCountTextAndPreserveView();
                        },
                        error: function(err) {}
                    });
                });

            });
        })(jQuery);

        function updateCountTextAndPreserveView() {
            // Update results count text
            let countText = jQuery("#ajax_results_count_meta").text();
            if (countText) {
                jQuery("#results_count_text").text(countText.trim());
            }

            // Preserve active view style
            var activeView = jQuery(".custom-view-switcher .view-btn.active").data("view");
            if (activeView === "list") {
                jQuery(".grid_body").removeClass('show active');
                jQuery(".map_body").removeClass('show active');
                jQuery(".list_body").addClass('show active');
            } else if (activeView === "map") {
                jQuery(".grid_body").removeClass('show active');
                jQuery(".list_body").removeClass('show active');
                jQuery(".map_body").addClass('show active');
            } else {
                jQuery(".grid_body").addClass('show active');
                jQuery(".list_body").removeClass('show active');
                jQuery(".map_body").removeClass('show active');
            }
        }

        function loadPropertyWithAjax() {
            let spinner_box = jQuery(".spinner_hidden_box").html();
            jQuery('#nav-tabContent').html(spinner_box);

            let currentURL = window.location.href;
            let index = currentURL.indexOf("?");
            let url = "{{ url('properties-with-ajax') }}";
            if (index !== -1) {
                url += "?" + currentURL.substr(index + 1);
            }

            jQuery.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    jQuery('#nav-tabContent').html(response);
                    updateCountTextAndPreserveView();
                },
                error: function(err) {}
            });
        }

        function ajax_pagination(link) {
            let spinner_box = jQuery(".spinner_hidden_box").html();
            jQuery('#nav-tabContent').html(spinner_box);
            jQuery.ajax({
                type: 'get',
                url: link,
                success: function(response) {
                    jQuery('#nav-tabContent').html(response);
                    updateCountTextAndPreserveView();
                },
                error: function(err) {}
            });
        }
    </script>
@endsection
