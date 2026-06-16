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
            <div class="row">
                <div class="col-12">
                    <!-- Proeprty Bar -->
                    <div class="homec-property-bar">
                        <div class="homec-property-bar__single first">
                            <div class="homec-form__form homec-form__form--bar">
                                <input value="{{ request()->get('search') }}" id="search_input" type="text"
                                    placeholder="{{ __('user.Search Property') }}...">
                                <button id="searchPropertyBtn" type="button"
                                    class="homec-btn"><span>{{ __('user.Search Now') }}</span></button>
                            </div>
                            <!-- Show Results -->
                            <div class="hoemc-showing-results">
                                <p class="hoemc-showing-results__text">
                                    {{ __('user.You can see list or grid view from right side') }}</p>
                            </div>
                            <!-- End Show Results -->
                        </div>
                        <div class="homec-property-bar__single last">
                            <div id="homec-tabs" class="list-group homec-gl-tabs" role="tablist">
                                <a class="list-group-item active grid_view" data-bs-toggle="list" href="#homec-grid"
                                    role="tab">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.31756 0.517578H3.14916C1.88457 0.517578 0.855469 1.54668 0.855469 2.81127V6.97916C0.855469 8.24375 1.88457 9.27285 3.14916 9.27285H7.31705C8.58164 9.27285 9.61075 8.24375 9.61075 6.97916V2.81127C9.61126 1.54668 8.58215 0.517578 7.31756 0.517578ZM8.08213 6.97967C8.08213 7.4012 7.73909 7.74424 7.31756 7.74424H3.14916C2.72763 7.74424 2.3846 7.4012 2.3846 6.97967V2.81178C2.3846 2.39025 2.72763 2.04722 3.14916 2.04722H7.31705C7.73858 2.04722 8.08162 2.39025 8.08162 2.81178L8.08213 6.97967ZM17.63 0.517578H13.4616C12.197 0.517578 11.1679 1.54668 11.1679 2.81127V6.97916C11.1679 8.24375 12.197 9.27285 13.4616 9.27285H17.63C18.8946 9.27285 19.9237 8.24375 19.9237 6.97916V2.81127C19.9237 1.54668 18.8951 0.517578 17.63 0.517578ZM18.3946 6.97967C18.3946 7.4012 18.0515 7.74424 17.63 7.74424H13.4616C13.0401 7.74424 12.697 7.4012 12.697 6.97967V2.81178C12.697 2.39025 13.0401 2.04722 13.4616 2.04722H17.63C18.0515 2.04722 18.3946 2.39025 18.3946 2.81178V6.97967ZM7.31756 10.3392H3.14916C1.88457 10.3392 0.855469 11.3683 0.855469 12.6329V16.8008C0.855469 18.0653 1.88457 19.0944 3.14916 19.0944H7.31705C8.58164 19.0944 9.61075 18.0653 9.61075 16.8008V12.6329C9.61126 11.3678 8.58215 10.3392 7.31756 10.3392ZM8.08213 16.8008C8.08213 17.2223 7.73909 17.5653 7.31756 17.5653H3.14916C2.72763 17.5653 2.3846 17.2223 2.3846 16.8008V12.6329C2.3846 12.2113 2.72763 11.8683 3.14916 11.8683H7.31705C7.73858 11.8683 8.08162 12.2113 8.08162 12.6329L8.08213 16.8008ZM17.63 10.3392H13.4616C12.197 10.3392 11.1679 11.3683 11.1679 12.6329V16.8008C11.1679 18.0653 12.197 19.0944 13.4616 19.0944H16.5759C16.998 19.0944 17.3405 18.7519 17.3405 18.3299C17.3405 17.9078 16.998 17.5653 16.5759 17.5653H13.4616C13.0401 17.5653 12.697 17.2223 12.697 16.8008V12.6329C12.697 12.2113 13.0401 11.8683 13.4616 11.8683H17.63C18.0515 11.8683 18.3946 12.2113 18.3946 12.6329V16.1264C18.3946 16.5484 18.7371 16.891 19.1591 16.891C19.5812 16.891 19.9237 16.5484 19.9237 16.1264V12.6329C19.9237 11.3678 18.8951 10.3392 17.63 10.3392Z" />
                                    </svg>
                                </a>
                                <a class="list-group-item list_view" data-bs-toggle="list" href="#homec-list"
                                    role="tab">
                                    <svg width="27" height="19" viewBox="0 0 27 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.3596 0.517578H6.84306C5.93088 0.517578 5.19141 1.25705 5.19141 2.16923C5.19141 3.08141 5.93088 3.82088 6.84306 3.82088H23.3596C24.2717 3.82088 25.0112 3.08141 25.0112 2.16923C25.0112 1.25705 24.2717 0.517578 23.3596 0.517578Z" />
                                        <path
                                            d="M3.53912 2.17009C3.53726 1.73276 3.36203 1.31402 3.05188 1.00567C2.40768 0.365297 1.36725 0.365297 0.723052 1.00567C0.412851 1.31402 0.237621 1.73276 0.235814 2.17009C0.223479 2.27708 0.223479 2.38516 0.235814 2.49216C0.254499 2.59977 0.284951 2.70502 0.326655 2.80597C0.370992 2.90378 0.423483 2.99772 0.483562 3.08675C0.542867 3.17935 0.612081 3.26518 0.690018 3.34276C0.765169 3.4176 0.848216 3.48408 0.937766 3.54096C1.02474 3.60429 1.11903 3.65699 1.21855 3.69786C1.32802 3.75464 1.44472 3.79634 1.56539 3.82174C1.67239 3.83371 1.78047 3.83371 1.88747 3.82174C2.32361 3.8221 2.7422 3.64992 3.05188 3.34276C3.12982 3.26518 3.19903 3.17935 3.25834 3.08675C3.31842 2.99772 3.37091 2.90378 3.41524 2.80597C3.46794 2.70625 3.50949 2.60101 3.53912 2.49216C3.55145 2.38516 3.55145 2.27708 3.53912 2.17009Z" />
                                        <path
                                            d="M3.53768 9.60173C3.54996 9.49473 3.54996 9.38665 3.53768 9.27966C3.50914 9.17307 3.46753 9.07046 3.4138 8.9741C3.37127 8.87278 3.31868 8.77595 3.2569 8.68506C3.19966 8.5935 3.13018 8.51014 3.05044 8.43731C2.40624 7.79694 1.36581 7.79694 0.721612 8.43731C0.411411 8.74566 0.236181 9.1644 0.234375 9.60173C0.237575 9.81938 0.279537 10.0347 0.358249 10.2376C0.399643 10.3353 0.449399 10.4293 0.506897 10.5184C0.569712 10.6082 0.641662 10.6912 0.721612 10.7661C0.794594 10.8457 0.8779 10.9152 0.96936 10.9726C1.05633 11.036 1.15058 11.0887 1.25014 11.1295C1.35084 11.1719 1.45618 11.2024 1.56395 11.2203C1.66961 11.244 1.77774 11.2551 1.88603 11.2534C1.99302 11.2657 2.1011 11.2657 2.2081 11.2534C2.31318 11.2354 2.41579 11.2049 2.51365 11.1625C2.6159 11.122 2.71294 11.0693 2.80269 11.0056C2.89415 10.9482 2.97746 10.8788 3.05044 10.7992C3.13003 10.7262 3.1995 10.6429 3.2569 10.5514C3.32038 10.4645 3.37308 10.3703 3.4138 10.2706C3.47022 10.161 3.51187 10.0444 3.53768 9.9238C3.55037 9.8168 3.55037 9.70872 3.53768 9.60173Z" />
                                        <path
                                            d="M3.53778 17.0334C3.55001 16.9264 3.55001 16.8183 3.53778 16.7113C3.50924 16.6021 3.46764 16.4967 3.41391 16.3975C3.36957 16.2997 3.31708 16.2057 3.257 16.1167C3.1996 16.0252 3.13013 15.9419 3.05054 15.869C2.40635 15.2286 1.36591 15.2286 0.721713 15.869C0.642124 15.9419 0.572652 16.0252 0.515257 16.1167C0.455178 16.2057 0.402687 16.2997 0.35835 16.3975C0.31551 16.498 0.285006 16.6034 0.267509 16.7113C0.244231 16.8171 0.233186 16.9251 0.234476 17.0334C0.236334 17.4707 0.411564 17.8894 0.721713 18.1978C0.794696 18.2774 0.878001 18.3468 0.969461 18.4042C1.05643 18.4676 1.15068 18.5203 1.25024 18.5611C1.35094 18.6035 1.45629 18.634 1.56406 18.652C1.66971 18.6757 1.77784 18.6868 1.88613 18.685C1.99312 18.6974 2.1012 18.6974 2.2082 18.685C2.31329 18.667 2.41589 18.6365 2.51376 18.5942C2.616 18.5536 2.71304 18.5009 2.80279 18.4373C2.89425 18.3799 2.97756 18.3104 3.05054 18.2308C3.13013 18.1578 3.1996 18.0745 3.257 17.9831C3.32054 17.8962 3.37323 17.8019 3.41391 17.7023C3.47027 17.5926 3.51192 17.476 3.53778 17.3554C3.55048 17.2484 3.55048 17.1404 3.53778 17.0334Z" />
                                        <path
                                            d="M25.0112 7.94922H6.84306C5.93088 7.94922 5.19141 8.68869 5.19141 9.60087C5.19141 10.513 5.93088 11.2525 6.84306 11.2525H25.0112C25.9234 11.2525 26.6629 10.513 26.6629 9.60087C26.6629 8.68869 25.9234 7.94922 25.0112 7.94922Z" />
                                        <path
                                            d="M17.5788 15.3828H6.84306C5.93088 15.3828 5.19141 16.1223 5.19141 17.0345C5.19141 17.9466 5.93088 18.6861 6.84306 18.6861H17.5788C18.491 18.6861 19.2304 17.9466 19.2304 17.0345C19.2304 16.1223 18.491 15.3828 17.5788 15.3828Z" />
                                    </svg>
                                </a>
                                @if ($setting->live_map == 'yes')
                                    <a class="list-group-item map_view" data-bs-toggle="list" href="#map-grid"
                                        role="tab">
                                        <svg  width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_301_121147)">
                                            <path d="M22.2799 10.0619C21.8831 10.0619 21.5612 10.3838 21.5612 10.7806V18.9192L15.8115 21.219V13.6554C15.8115 13.2587 15.4895 12.9367 15.0928 12.9367C14.6961 12.9367 14.3741 13.2587 14.3741 13.6554V21.2176L8.62446 18.9177V7.53059L11.9549 8.86306C12.3186 9.00968 12.7412 8.83144 12.8893 8.46203C13.0373 8.09405 12.8576 7.67576 12.4882 7.52771L8.18605 5.80569C8.18605 5.80569 8.18605 5.80569 8.18461 5.80569L8.17311 5.80138C8.00206 5.73238 7.81089 5.73238 7.63983 5.80138L7.6269 5.80569C7.6269 5.80569 7.6269 5.80569 7.62546 5.80569L0.451347 8.6762C0.179676 8.78544 0 9.04849 0 9.34316V22.2799C0 22.5185 0.119305 22.7413 0.31623 22.8749C0.436973 22.9569 0.576402 22.9986 0.718705 22.9986C0.809262 22.9986 0.899819 22.9813 0.986063 22.9468L7.90576 20.1798L14.8125 22.9425C14.8125 22.9425 14.8125 22.9425 14.814 22.9425L14.8269 22.9482C14.9979 23.0172 15.1891 23.0172 15.3602 22.9482L15.3731 22.9425C15.3731 22.9425 15.3731 22.9425 15.3745 22.9425L22.5487 20.0734C22.8189 19.9627 22.9986 19.6997 22.9986 19.405V10.7806C22.9986 10.3838 22.6766 10.0619 22.2799 10.0619ZM7.18705 18.9177L1.43741 21.2176V9.829L7.18705 7.52915V18.9177Z" />
                                            <path d="M17.9686 2.87482C16.7799 2.87482 15.8125 3.84219 15.8125 5.03093C15.8125 6.21967 16.7799 7.18705 17.9686 7.18705C19.1574 7.18705 20.1247 6.21967 20.1247 5.03093C20.1247 3.84219 19.1574 2.87482 17.9686 2.87482ZM17.9686 5.74964C17.5719 5.74964 17.2499 5.42766 17.2499 5.03093C17.2499 4.63421 17.5719 4.31223 17.9686 4.31223C18.3653 4.31223 18.6873 4.63421 18.6873 5.03093C18.6873 5.42766 18.3653 5.74964 17.9686 5.74964Z" />
                                            <path d="M17.9684 0C15.1942 0 12.9375 2.25673 12.9375 5.03094C12.9375 7.61252 16.9737 12.1849 17.4337 12.6981C17.5703 12.849 17.7643 12.9367 17.9684 12.9367C18.1725 12.9367 18.3666 12.849 18.5032 12.6981C18.9631 12.1849 22.9994 7.61252 22.9994 5.03094C22.9994 2.25673 20.7426 0 17.9684 0ZM17.9684 11.1212C16.3988 9.2598 14.3749 6.40222 14.3749 5.03094C14.3749 3.05018 15.9877 1.43741 17.9684 1.43741C19.9492 1.43741 21.562 3.05018 21.562 5.03094C21.562 6.40079 19.5381 9.2598 17.9684 11.1212Z"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_301_121147">
                                            <rect width="23" height="23" />
                                            </clipPath>
                                            </defs>
                                        </svg>

                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Proeprty Bar -->
                </div>
            </div>

            <form id="propertySearchForm">
                <input type="hidden" name="search" value="{{ request()->get('search') }}" id="search_id">

                @if (request()->has('top_property'))
                    <input type="hidden" name="top_property" value="enable">
                @endif

                
                @if (request()->has('featured_property'))
                    <input type="hidden" name="featured_property" value="enable">
                @endif

                @if (request()->has('urgent_property'))
                    <input type="hidden" name="urgent_property" value="enable">
                @endif

                <div class="row">
                    <div class="col-lg-4 col-12 mg-top-30">
                        <div class="property-sidebar">
                            <!-- Single Sidebar -->
                            <div class="property-sidebar__single">
                                <div class="property-sidebar__filters">
                                    <h4 class="property-sidebar__title">{{ __('user.Purpose') }}</h4>
                                    <div class="form-group">
                                        <select class="property-sidebar__group homec-border select2noSearch select_search" name="purpose">
                                            <option {{ request()->get('purpose') == 'any' ? 'selected' : '' }}
                                                value="any">{{ __('user.Any') }}</option>

                                                <option {{ request()->get('purpose') == 'buy' ? 'selected' : '' }}
                                                value="buy">{{ __('For Buy') }}</option>


                                                 <option {{ request()->get('purpose') == 'sale' ? 'selected' : '' }}
                                                value="sale">{{ __('user.For Sale') }}</option>


                                            <option {{ request()->get('purpose') == 'rent' ? 'selected' : '' }}
                                                value="rent">{{ __('user.For Rent') }}</option>
                                           
                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Sidebar -->
                            <!-- Single Sidebar -->
                            <div class="property-sidebar__single mg-top-20">
                                {{-- <div class="property-sidebar__filters">
                                    <h4 class="property-sidebar__title">{{ __('user.Country') }}</h4>
                                    <div class="form-group">
                                        <select class="property-sidebar__group homec-border select2 select_search" name="country"
                                            id="country_id">
                                            <option value="">{{ __('user.Select') }}</option>
                                            @foreach ($countries as $country)
                                                <option {{ request()->get('country') == $country->id ? 'selected' : '' }}
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="property-sidebar__single mg-top-20">
                                <div class="property-sidebar__filters">
                                    <h4 class="property-sidebar__title">{{ __('user.City') }}</h4>
                                    <div class="form-group" id="country_selector">

<select class="property-sidebar__group homec-border select2 select_search" name="city" id="city_id">
    <option value="">{{ __('user.Select') }}</option>
    @foreach ($locations as $ct)
        <option {{ request()->get('ct') == $ct->id ? 'selected' : '' }}
            value="{{ $ct->id }}">{{ $ct->name }}</option>
    @endforeach
</select>
<!-- <select class="property-sidebar__group homec-border select2 city_location select_search" name="city">
    <option value="">{{ __('user.Select') }}</option>
</select>
 -->                                    </div>
                                </div>
                            </div>

                            <!-- End Single Sidebar -->
                            <!-- Single Sidebar -->
                            <div class="property-sidebar__single mg-top-20">
                                <div class="property-sidebar__filters">
                                    <h4 class="property-sidebar__title">{{ __('user.Property Type') }}</h4>
                                    <div class="form-group">  
                                        <select class="property-sidebar__group homec-border select2 select_search" name="type" id="property_type">
<option value="" data-display="">{{ __('user.Select') }}</option>
@foreach ($property_types as $property_type)
    <option
        {{ $property_type == $property_type->slug ? 'selected' : '' }}
        value="{{ $property_type->slug }}">{{ $property_type->name }}
    </option>
@endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Sidebar -->
                            <!-- Single Sidebar -->
                            <div class="property-sidebar__single mg-top-20">
                                <div class="property-sidebar__checkboxd">
                                    <h4 class="property-sidebar__title m-0">{{ __('Select Total Bedrooms') }}</h4>
                                    <div class="row">
                                        @for ($i = 1; $i <= $max_bed_room; $i++)
                                            <div class="col-md-6 col-12">
                                                <div class="form-group homec-form-checkbox mg-top-15">
                                                    <input type="checkbox" id="room1-{{ $i }}" name="rooms[]"
                                                        value="{{ $i }}">
                                                    <label class="homec-form-label"
                                                        for="room1-{{ $i }}">{{ __('user.Room') }}
                                                        {{ $i }}</label>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                            <!-- End Single Sidebar -->
                           
                            <!-- Single Sidebar -->
                            <div class="property-sidebar__single mg-top-20">
                                <h4 class="property-sidebar__title">{{ __('user.Area(m2)') }}</h4>
                                <div class="price-filter homec-border pd-top-20">
                                    <div class="price-filter-inner">
                                        <div id="slider-range"></div>
                                        <div class="price_slider_amount">
                                            <div class="label-input">
                                                <input type="text" id="amount" readonly />

                                                <input type="hidden" name="min_area" id="min_area" value="0">
                                                <input type="hidden" name="max_area" id="max_area"
                                                    value="{{ $max_area }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Sidebar -->
                            <!-- Single Sidebar -->
                            <div class="property-sidebar__single mg-top-20">
                                <h4 class="property-sidebar__title">{{ __('user.Price') }}</h4>
                                <div class="price-filter homec-border pd-top-20">
                                    <div class="price-filter-inner">
                                        <div id="slider-range__v2"></div>
                                        <div class="price_slider_amount">
                                            <div class="label-input">
                                                <span>{{ __('user.Range') }}:</span><input type="text" id="amount-2"
                                                    readonly />

                                                <input type="hidden" name="min_price" id="min_price" value="0">
                                                <input type="hidden" name="max_price" id="max_price"
                                                    value="{{ $max_price }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Sidebar -->

                             <!-- Single Sidebar -->
                            <div class="property-sidebar__single mg-top-20">
                                <div class="property-sidebar__checkboxd">
                                    <h4 class="property-sidebar__title m-0">{{ __('Select Total Bathrooms') }}</h4>
                                    <div class="row">
                                        @for ($i = 1; $i <= $max_bath_room; $i++)
                                            <div class="col-md-6 col-12">
                                                <div class="form-group homec-form-checkbox mg-top-15">
                                                    <input type="checkbox" id="broom1-{{ $i }}"
                                                        name="bath_rooms[]" value="{{ $i }}">
                                                    <label class="homec-form-label"
                                                        for="broom1-{{ $i }}">{{ __('user.Room') }}
                                                        {{ $i }}</label>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Sidebar -->

                            <!-- Single Sidebar -->
                            <div class="property-sidebar__single mg-top-20">
                                <div class="property-sidebar__filters">
                                    <h4 class="property-sidebar__title">{{ __('user.Others') }}</h4>
                                    <div class="form-group">
                                        <select class="property-sidebar__group homec-border select2noSearch select_search"
                                            name="others_sorting">

                                            <option
                                                {{ request()->get('others_sorting') == 'default_sort' ? 'selected' : '' }}
                                                value="default_sort">{{ __('user.Default Sorting') }}</option>

                                            <option
                                                {{ request()->get('others_sorting') == 'price_low_to_high' ? 'selected' : '' }}
                                                value="price_low_to_high">{{ __('user.Price : low to high') }}</option>

                                            <option
                                                {{ request()->get('others_sorting') == 'price_high_to_low' ? 'selected' : '' }}
                                                value="price_high_to_low">{{ __('user.Price : high to low') }}</option>

                                            <option
                                                {{ request()->get('others_sorting') == 'sort_by_newest' ? 'selected' : '' }}
                                                value="sort_by_newest">{{ __('user.Sort by newest') }}</option>

                                            <option
                                                {{ request()->get('others_sorting') == 'sort_by_oldest' ? 'selected' : '' }}
                                                value="sort_by_oldest">{{ __('user.Sort by oldest') }}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Sidebar -->

                            <button type="submit" class="homec-btn mg-top-20">
                                <span class="homec-btn__inside">
                                    <span>{{ __('user.Search') }}</span>
                                </span>
                            </button>
                        </div>
                        <div class="mg-top-30">
                            <div class="homec-agent-card homec-bg-cover homec-agent-vector-bg">
                                <h4 class="homec-agent-card__title mg-btm-20 text-white">{{ __('user.Our Agents') }}</h4>
                                <div class="swiper mySwiper homec-slider-agent__card loading">
                                    <div class="swiper-wrapper">
                                        {{-- @foreach ($slider_agents as $slider_agent)
                                            <div class="swiper-slide">
<!-- Single agent-->
<div class="homec-agent">
<!-- Agent Head-->
<div class="homec-agent__head">
    @if ($slider_agent->image)
        <img src="{{ $slider_agent->image }}" alt="agent">
    @else
        <img src="{{ $default_user_avatar }}" alt="agent">
    @endif

    <ul class="homec-agent__social list-none">
        @if ($slider_agent->linkedin)
            <li><a href="{{ $slider_agent->linkedin }}"><i
                        class="fab fa-linkedin-in"></i></a></li>
        @endif

        @if ($slider_agent->twitter)
            <li><a href="{{ html_decode($slider_agent->twitter) }}"><i
                        class="fab fa-twitter"></i></a></li>
        @endif

        @if ($slider_agent->instagram)
            <li><a href="{{ html_decode($slider_agent->instagram) }}"><i
                        class="fab fa-instagram"></i></a></li>
        @endif

        @if ($slider_agent->facebook)
            <li><a href="{{ html_decode($slider_agent->facebook) }}"><i
                        class="fab fa-facebook-f"></i></a></li>
        @endif
    </ul>
</div>
<!-- Agent Body -->
<div class="homec-agent__body">
    <h4 class="homec-agent__title position_relitive">

        <a
            href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => html_decode($slider_agent->user_name)]) }}">{{ html_decode($slider_agent->name) }}

            @php
                $kyc = Modules\Kyc\Entities\KycInformation::where(
                    'user_id',
                    $slider_agent->id,
                )
                    ->where('status', 1)
                    ->first();
            @endphp
            @if ($kyc)
                <span class="varified-badge">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z">

                                                                            </path>
                                                                        </svg>
                                                                    </span>
                                                                @endif

                                                            </a>

                                                            <span>{{ html_decode($slider_agent->designation) }}</span>
                                                        </h4>

                                                    </div>
                                                    <!-- End Agent Body -->
                                                </div>
                                                <!-- End Single agent-->
                                            </div>
                                        @endforeach --}}
                                    </div>
                                </div>
                                <!-- Slider Pagination -->
                                <div
                                    class="swiper-pagination swiper-pagination--white swiper-pagination__slider--agent mg-top-40">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="spinner_hidden_box d-none">
                            <div class="tab-pane fade show active" id="homec-grid" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <img class="spinner-element"
                                            src="{{ asset('uploads/website-images/Spinner.gif') }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="homec-list" role="tabpanel">
                                <div class="row">
                                    <img class="spinner-element" src="{{ asset('uploads/website-images/Spinner.gif') }}"
                                        alt="">
                                </div>
                            </div>

                            <div class="tab-pane fade" id="map-grid" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <img class="spinner-element"
                                            src="{{ asset('uploads/website-images/Spinner.gif') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="nav-tabContent">

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

                let max_area = "{{ $max_area }}";
                let max_price = "{{ $max_price }}";
                let price_min_value = "{{ $price_min_value }}";
                let price_max_value = "{{ $price_max_value }}";

                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: max_area,
                    values: [0, max_area],
                    slide: function(event, ui) {
                        let text_val =
                            `${ui.values[0]} {{ __('user.m2') }} - ${ui.values[1]} {{ __('user.m2') }}`
                        $("#amount").val(text_val);

                        $("#min_area").val(ui.values[0]);
                        $("#max_area").val(ui.values[1]);
                    }
                });

                let loading_time_text =
                    `${$("#slider-range").slider("values", 0)} {{ __('user.m2') }} - ${$("#slider-range").slider("values", 1)} {{ __('user.m2') }}`;

                $("#amount").val(loading_time_text);

                $("#slider-range__v2").slider({
                    range: true,
                    min: 0,
                    max: max_price,
                    values: [price_min_value, price_max_value],
                    slide: function(event, ui) {
                        let price_text =
                            `{{ $currency_icon }}${ui.values[0]} - {{ $currency_icon }}${ui.values[1]}`
                        $("#amount-2").val(price_text);

                        $("#min_price").val(ui.values[0]);
                        $("#max_price").val(ui.values[1]);

                    }
                });

                let loading_time_price_text =
                    `{{ $currency_icon }}${$("#slider-range__v2").slider("values", 0)} - {{ $currency_icon }}${$("#slider-range__v2").slider("values", 1)}`

                $("#amount-2").val(loading_time_price_text);


                $("#searchPropertyBtn").on("click", function(e) {
                    $("#propertySearchForm").submit();
                })

                $("#search_input").on("keyup", function(e) {
                    $("#search_id").val(e.target.value);
                })

                $(".select_search").on("change", function() {
                    $("#propertySearchForm").submit();
                })

                $(document).on("change", ".city_location", function() {
                    $("#propertySearchForm").submit();
                })

                $('input[type="checkbox"]').on("change", function() {
                    setTimeout(function() {
                        $("#propertySearchForm").submit();
                    }, 500);
                })

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
                        },
                        error: function(err) {}
                    });

                })

                $(".list_view").on("click", function() {
                    $(".grid_body").removeClass('show active');
                    $(".map_body").removeClass('show active');
                    $(".list_body").addClass('show active');
                })

                $(".grid_view").on("click", function() {
                    $(".grid_body").addClass('show active');
                    $(".list_body").removeClass('show active');
                    $(".map_body").removeClass('show active');
                })

                $(".map_view").on("click", function() {
                    $(".map_body").addClass('show active');
                    $(".list_body").removeClass('show active');
                    $(".grid_body").removeClass('show active');
                })

            });
        })(jQuery);

        function loadPropertyWithAjax() {

            let spinner_box = $(".spinner_hidden_box").html();
            $('#nav-tabContent').html(spinner_box);

            let currentURL = window.location.href
            let index = currentURL.indexOf("?");
            currentURL = currentURL.substr(index + 1)
            let url = "{{ url('properties-with-ajax') }}" + "?" + currentURL;

            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#nav-tabContent').html(response);
                },
                error: function(err) {}
            });
        }

        function ajax_pagination(link) {
            let spinner_box = $(".spinner_hidden_box").html();
            $('#nav-tabContent').html(spinner_box);
            $.ajax({
                type: 'get',
                url: link,
                success: function(response) {
                    $('#nav-tabContent').html(response);
                },
                error: function(err) {}
            });
        }

        $("#country_id").change(function() {
            let id = this.value;
            let route = "{{ url('/property/city/list/filtering') }}/" + id;
            ajax_switch_country(route)
        });

        function ajax_switch_country(route) {
            $.get({
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function() {},
                success: function(response) {
                    $('#country_selector').html(response.template);
                },
                complete: function() {},
            });
        }
    </script>
<script>
$(document).ready(function () {

    // select2 init
    $('#property_type').select2();

    let urlParams = new URLSearchParams(window.location.search);
    let type = urlParams.get('property_type');

    if(type){
        // set value properly
        $('#property_type').val(type).trigger('change');
    }

});
</script>
@endsection
