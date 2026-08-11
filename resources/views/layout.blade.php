<!DOCTYPE html>
@if (Session::get('lang_dir') == 'right_to_left')
    <html class="no-js" lang="ZXX" dir="rtl">
@else
    <html class="no-js" lang="ZXX">
@endif
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href="{{ asset($setting->favicon) }}">
    @yield('title')
    @yield('meta')

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css" />

    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome-all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Swiper Slider CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper-slider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flex-slider.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/select2-min.css') }}">
    <!-- Video Popup -->
    <link rel="stylesheet" href="{{ asset('frontend/css/video-popup.min.css') }}">
    <!-- Jquery UI CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/agency.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/hero-slider.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/kyc.css') }}">

    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/leaflet/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/leaflet/MarkerCluster.Default.css') }}">


    @if (Session::get('lang_dir') == 'right_to_left')
        <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
    @endif

    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}"> --}}

    <!-- Jquery JS -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Swiper SLider JS -->
    <script src="{{ asset('frontend/js/swiper-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>

    <script src="{{ asset('backend/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('backend/leaflet/leaflet.markercluster.js') }}"></script>

    @if ($googleAnalytic->status == 1)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAnalytic->analytic_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ $googleAnalytic->analytic_id }}');
        </script>
    @endif

    @if ($facebookPixel->status == 1)
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $facebookPixel->app_id }}');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ $facebookPixel->app_id }}&ev=PageView&noscript=1" /></noscript>
    @endif

    <style>
        html {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            width: 100% !important;
            margin: 0 !important;
        }

        body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            width: 100% !important;
            margin: 0 !important;
            padding-top: 125px !important;
        }

        [data-aos] {
            opacity: 1 !important;
            transform: none !important;
            visibility: visible !important;
        }

        /* Permanent Fixed Header Block */
        .homec-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 999999 !important;
            background: #ffffff !important;
            box-shadow: 0 4px 25px rgba(15, 23, 42, 0.08) !important;
        }

        .homec-header__top {
            background: #0f172a !important;
            padding: 8px 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            position: relative !important;
            z-index: 100 !important;
            display: block !important;
            visibility: visible !important;
        }

        .homec-header__list {
            display: flex !important;
            align-items: center !important;
            gap: 24px !important;
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
        }

        .homec-header__list li a {
            color: #cbd5e1 !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
        }

        .homec-header__list li a span {
            color: #cbd5e1 !important;
        }

        .homec-header__list li a:hover,
        .homec-header__list li a:hover span {
            color: #ffffff !important;
        }

        .homec-header__middle {
            background: #ffffff !important;
            padding: 12px 0 !important;
            border-bottom: 1px solid #e2e8f0 !important;
            position: relative !important;
            top: 0 !important;
        }

        .homec-header__inside {
            background: #ffffff !important;
            box-shadow: none !important;
            padding: 0 !important;
            border-radius: 0 !important;
            margin: 0 !important;
        }

        /* Mobile adjustments for header padding offset */
        @media (max-width: 768px) {
            body {
                padding-top: 80px !important;
            }
            .homec-header__top {
                display: none !important;
            }
            .footer-about-widget,
            .single-widget {
                text-align: center !important;
                margin-bottom: 30px !important;
            }
            .footer-logo {
                display: flex !important;
                justify-content: center !important;
            }
            .footer-about-widget .homec-social {
                justify-content: center !important;
            }
            .footer-about-text {
                text-align: left !important;
                display: inline-block !important;
                margin: 0 auto !important;
            }
            .f-useful-links-inner, 
            .f-need-helps-inner {
                display: inline-block !important;
                text-align: left !important;
                padding-left: 0 !important;
                margin: 0 auto !important;
            }
            .f-contact__form-top {
                text-align: center !important;
            }
            .f-contact-list {
                display: inline-flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                text-align: left !important;
                padding-left: 0 !important;
                margin: 0 auto !important;
            }
            .f-useful-links-inner li, .f-need-helps-inner li {
                margin-bottom: 12px !important;
                padding-bottom: 0 !important;
                line-height: 1.2 !important;
                text-align: left !important;
            }
            .f-contact-list li {
                display: flex !important;
                align-items: center !important;
                justify-content: flex-start !important;
                text-align: left !important;
                margin-bottom: 12px !important;
                gap: 10px !important;
            }
            .f-contact-list li p,
            .f-contact-list li a {
                margin: 0 !important;
                text-align: left !important;
            }
            .f-useful-links-inner li a, .f-need-helps-inner li a {
                padding: 4px 0 !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: flex-start !important;
                margin: 0 !important;
            }
            .copyright-text {
                text-align: center !important;
            }


        }


        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        .homec-header li.menu-item-has-children a::after {
            margin-left: 7px;
            font-size: 14px;
            font-family: "Font Awesome 6 Free";
            font-weight: 600;
        }
        
        .fade.in {
            opacity: 1 !important;
        }

        .tox .tox-promotion,
        .tox-statusbar__branding {
            display: none !important;
        }

        /* Responsive Header & Logo Fixes */
        .homec-header__logo img,
        .footer-logo img,
        .offcanvas-logo img {
            max-height: 52px;
            max-width: 180px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: inline-block;
            vertical-align: middle;
        }

        .homec-header__inside {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Breadcrumb Visibility & High Contrast Styling */
        .breadcrumbs__content {
            position: relative !important;
            background-color: #0f172a !important;
            height: auto !important;
            min-height: 220px !important;
            padding-top: 110px !important;
            padding-bottom: 45px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        @media (max-width: 768px) {
            .breadcrumbs__content {
                min-height: 150px !important;
                padding-top: 35px !important;
                padding-bottom: 25px !important;
            }
            .breadcrumb__title {
                font-size: 28px !important;
            }
            .breadcrumb__menu li,
            .breadcrumb__menu li a {
                font-size: 14px !important;
            }
        }

        .homec-overlay {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(15, 23, 42, 0.55) !important;
            z-index: 1 !important;
        }

        .breadcrumbs__content .container,
        .breadcrumb-content {
            position: relative !important;
            z-index: 2 !important;
        }

        .breadcrumb__menu {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            margin-bottom: 8px !important;
            padding: 0 !important;
            list-style: none !important;
        }

        .breadcrumb__menu li,
        .breadcrumb__menu li a {
            color: #ffffff !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.7) !important;
        }

        .breadcrumb__menu li a:hover {
            color: #fbbf24 !important;
            text-decoration: underline !important;
        }

        .breadcrumb__menu li.active a {
            color: #fbbf24 !important;
            font-weight: 700 !important;
        }

        .breadcrumb__menu li::after,
        .breadcrumb__menu li:after {
            color: #fbbf24 !important;
            font-weight: 800 !important;
            margin-left: 8px !important;
            margin-right: 4px !important;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.7) !important;
        }

        .breadcrumb__title {
            color: #ffffff !important;
            font-size: 38px !important;
            font-weight: 800 !important;
            text-shadow: 0 3px 12px rgba(0, 0, 0, 0.7) !important;
            letter-spacing: -0.5px !important;
        }


        /* Comprehensive Responsive Location Grid & Container Fixes */
        .homec-listing {
            display: flex !important;
            gap: 24px !important;
            flex-wrap: wrap !important;
            justify-content: flex-start !important;
            width: 100% !important;
        }

        .homec-listing__single {
            display: flex !important;
            flex-direction: column !important;
            gap: 24px !important;
            flex: 1 1 270px !important;
            max-width: 360px !important;
            min-width: 240px !important;
            width: auto !important;
        }

        .homec-listing__inner img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            border-radius: 8px !important;
        }

        /* Search Form Responsive Fixes */
        .homec-search-form__form {
            max-width: 760px !important;
            width: 100% !important;
            min-width: unset !important;
        }

        @media (max-width: 991px) {
            .homec-header__logo img {
                max-height: 44px;
                max-width: 150px;
            }
            .homec-header__inside {
                padding: 10px 0;
            }
            .homec-listing__single {
                flex: 1 1 45% !important;
                max-width: 50% !important;
            }
        }

        @media (max-width: 767px) {
            .homec-header__logo img {
                max-height: 38px;
                max-width: 130px;
            }
            .offcanvas-logo img {
                max-height: 40px;
                max-width: 140px;
            }
            .homec-listing__single {
                flex: 1 1 100% !important;
                max-width: 100% !important;
                min-width: 100% !important;
                width: 100% !important;
            }
            .homec-search-form__form {
                flex-direction: column !important;
                padding: 15px !important;
            }
            .homec-search-form__group {
                width: 100% !important;
            }
            .homec-search-form__form button {
                width: 100% !important;
                margin-top: 10px;
            }
        }

        .scrollToTop {
            position: fixed !important;
            bottom: 30px !important;
            right: 30px !important;
            z-index: 9999 !important;
            background: #6366f1 !important;
            color: #ffffff !important;
            width: 48px !important;
            height: 48px !important;
            border-radius: 50% !important;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
            border: 2px solid #ffffff !important;
            writing-mode: horizontal-tb !important;
            transform: none !important;
        }
        .scrollToTop:hover {
            background: #4f46e5 !important;
            transform: translateY(-4px) !important;
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.6) !important;
            color: #ffffff !important;
        }
    </style>

    @include('theme_color')

</head>

<body>
    @if ($setting->preloader_status == 'enable')
        <div class="preloader">
            <div class="preloader-inner">
                <div class="preloader-icon">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- End Preloader -->
    @endif
    <!-- Mobile Menu Modal -->
    <div class="modal offcanvas-modal fade" id="offcanvas-modal">
        <div class="modal-dialog offcanvas-dialog">
            <div class="modal-content">
                <div class="modal-header offcanvas-header" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; background: #fff; border-bottom: 1px solid #eee;">
                    <div class="offcanvas-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="logo" style="max-height: 40px; width: auto; object-fit: contain;"></a>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- offcanvas-menu start -->
                <nav id="offcanvas-menu" class="offcanvas-menu">


                    <li><a href="{{ route('home') }}">{{ __('user.Home') }}</a></li>

                    <!-- Main Menu -->
                    {{-- <ul class="nav-menu menu navigation list-none">

                        @if ($setting->selected_theme == 0)
                            <li class="menu-item-has-children"><a href="javascript:;">{{ __('user.Home') }}</a>

                            </li>
                        @else
                            <li><a href="{{ route('home') }}">{{ __('user.Home') }}</a></li>
                        @endif

                        <li class="menu-item-has-children"><a href="javascript:;">{{ __('user.Properties') }}</a>
                            <ul class="sub-menu">
                                <li><a
                                        href="{{ route('properties', ['purpose' => 'any']) }}">{{ __('user.Properties') }}</a>
                                </li>
                                <li><a
                                        href="{{ route('properties', ['purpose' => 'any', 'featured_property' => 'enable']) }}">{{ __('user.Featured Properties') }}</a>
                                </li>

                                <li><a
                                        href="{{ route('properties', ['purpose' => 'any', 'urgent_property' => 'enable']) }}">{{ __('user.Urgent Properties') }}</a>
                                </li>

                                <li><a
                                        href="{{ route('properties', ['purpose' => 'any', 'top_property' => 'enable']) }}">{{ __('user.Top Properties') }}</a>
                                </li>

                            </ul> --}}
                    {{-- </li> --}}

                    <li><a href="{{ route('properties') }}">{{ __('user.Properties') }}</a></li>


                    <li><a href="{{ route('agencies') }}">{{ __('user.Our Agency') }}</a></li>
                    <li class="menu-item-has-children"><a
                            href="{{ route('blogs') }}">{{ __('user.Blogs') }}</a>
                    </li>

                    <li><a href="{{ route('contact-us') }}">{{ __('user.Contact') }}</a></li>
                    <li><a href="{{ route('user.dashboard') }}">{{ __('user.Dashboard') }}</a></li>

                    @if ($setting->agent_can_add_property)
                        @if ($setting->agent_can_add_property == 'enable')
                            <li><a
                                    href="{{ route('user.choose-property-type') }}">{{ __('user.Create Property') }}</a>
                            </li>
                        @endif
                    @endif

                    </ul>
                    <!-- End Main Menu -->
                </nav>
                <!-- offcanvas-menu end -->
            </div>
        </div>
    </div>
    <!-- End Mobile Menu Modal -->

    <!-- Header -->
    <header id="active-sticky" class="homec-header">
        <!-- Topbar -->
        <div class="homec-header__top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="homec-topbar-flex">
                            <!-- Contact -->
                            <ul class="homec-header__list">
                                <li>
                                    <a href="mailto:{{ $footer->email }}">
                                        <img src="{{ asset('frontend/img/email-icon.svg') }}" alt="email">
                                        <span>{{ $footer->email }}</span>
                                    </a>
                                </li>
                                <li class="d-none-tab">
                                    <a href="tel:{{ $footer->phone }}">
                                        <img src="{{ asset('frontend/img/phone-icon.svg') }}" alt="phone">
                                        <span>{{ $footer->phone }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <img src="{{ asset('frontend/img/locations-icon.svg') }}" alt="address">
                                        <span>{{ $footer->address }}</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- End Contact -->
                            <!-- language swicer -->


                            {{-- <ul class="homec-social homec-social__topbar">
                                @include('template-part.language-switcher')


                                <div class="dropdown pt-1">
                                    <form action="{{ route('currency-switcher') }}" id="currency_swithcer_form_for_mobile">
                                    <select id="currency_swithcer_for_mobile"  class="form-control" name="currency_code">
                                    @if (Session::get('front_lang'))
                                        @foreach ($currency_list as $currency)
                                            <option class="dropdown-item" {{ Session::get('currency_code') == $currency->currency_code ? 'selected' : '' }} value="{{ $currency->currency_code }}">{{ $currency->currency_name }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($currency_list as $currency)
                                            <option  class="dropdown-item" value="{{ $currency->currency_code }}">{{ $currency->currency_name }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                    </form>
                                </div>

                            </ul> --}}
                            <!-- End Social --><!-- Social -->
                            {{-- <ul class="homec-social homec-social__topbar">
                                @foreach ($social_links as $social_link)
                                    <li><a href="{{ $social_link->link }}"><i
                                                class="{{ $social_link->icon }}"></i></a></li>
                                @endforeach

                            </ul> --}}
                            <!-- End Social -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <div class="homec-header__middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="homec-header__inside">
                            <div class="homec-header__group">
                                <div class="homec-header__logo">
                                    <a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}"
                                            alt="logo"></a>
                                </div>
                                <div class="homec-header__menu">
                                    <div class="navbar">
                                        <div class="nav-item">
                                            <!-- Main Menu -->
                                            <ul class="nav-menu menu navigation list-none">
                                                <li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">{{ __('user.Home') }}</a></li>

                                                <li><a href="{{ route('properties') }}" class="{{ Route::is('properties') || Route::is('property') ? 'active' : '' }}">{{ __('user.Properties') }}</a>
                                                </li>

                                                <li><a href="{{ route('agencies') }}" class="{{ Route::is('agencies') ? 'active' : '' }}">{{ __('Channel-Partner') }}</a>
                                                </li>

                                                <li><a href="{{ route('blogs') }}" class="{{ Route::is('blogs') || Route::is('blog') ? 'active' : '' }}">{{ __('user.Blogs') }}</a></li>

                                                <li><a href="{{ route('contact-us') }}" class="{{ Route::is('contact-us') ? 'active' : '' }}">{{ __('user.Contact') }}</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('builder.login') }}"
                                                        class="nav-link fw-semibold {{ Route::is('builder.login') ? 'active' : '' }}">
                                                        <i class="fas fa-user-helmet-safety me-2 text-primary"></i>
                                                        Builder Login
                                                    </a>
                                                </li>

                                            </ul>
                                            <!-- End Main Menu -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="offcanvas-toggler" data-bs-toggle="modal"
                                data-bs-target="#offcanvas-modal"><span class="line"></span><span
                                    class="line"></span><span class="line">
                                        
                                    </span>
                            </button>
                            
                            <div class="homec-header__button">
                                @auth('web')
                                    <a href="{{ route('user.dashboard') }}" class="homec-header__icon">
                                        <svg width="28" height="32" viewBox="0 0 28 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.9659 16.2014C18.423 16.2014 22.0666 12.5579 22.0666 8.1007C22.0666 3.64352 18.423 0 13.9659 0C9.50869 0 5.86523 3.64352 5.86523 8.1007C5.86523 12.5579 9.50876 16.2014 13.9659 16.2014Z" />
                                            <path
                                                d="M27.8681 22.6752C27.6558 22.1446 27.3729 21.6494 27.0545 21.1895C25.4273 18.784 22.9158 17.1922 20.0858 16.8031C19.7321 16.7677 19.343 16.8384 19.06 17.0507C17.5743 18.1473 15.8056 18.7133 13.9661 18.7133C12.1266 18.7133 10.3579 18.1473 8.87219 17.0507C8.58917 16.8384 8.20005 16.7323 7.84634 16.8031C5.0164 17.1922 2.46948 18.784 0.877655 21.1895C0.55929 21.6494 0.276269 22.18 0.0640708 22.6752C-0.0420283 22.8875 -0.00668454 23.1351 0.0994145 23.3474C0.382436 23.8426 0.736144 24.3379 1.05451 24.7623C1.54973 25.4345 2.08036 26.0358 2.68174 26.6018C3.17696 27.097 3.74294 27.5569 4.30898 28.0167C7.10351 30.1039 10.4641 31.2004 13.9307 31.2004C17.3974 31.2004 20.758 30.1038 23.5525 28.0167C24.1185 27.5923 24.6845 27.097 25.1798 26.6018C25.7457 26.0358 26.3117 25.4344 26.807 24.7623C27.1607 24.3025 27.4791 23.8426 27.7621 23.3474C27.9389 23.1351 27.9742 22.8874 27.8681 22.6752Z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="homec-header__icon">
                                        <svg width="28" height="32" viewBox="0 0 28 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.9659 16.2014C18.423 16.2014 22.0666 12.5579 22.0666 8.1007C22.0666 3.64352 18.423 0 13.9659 0C9.50869 0 5.86523 3.64352 5.86523 8.1007C5.86523 12.5579 9.50876 16.2014 13.9659 16.2014Z" />
                                            <path
                                                d="M27.8681 22.6752C27.6558 22.1446 27.3729 21.6494 27.0545 21.1895C25.4273 18.784 22.9158 17.1922 20.0858 16.8031C19.7321 16.7677 19.343 16.8384 19.06 17.0507C17.5743 18.1473 15.8056 18.7133 13.9661 18.7133C12.1266 18.7133 10.3579 18.1473 8.87219 17.0507C8.58917 16.8384 8.20005 16.7323 7.84634 16.8031C5.0164 17.1922 2.46948 18.784 0.877655 21.1895C0.55929 21.6494 0.276269 22.18 0.0640708 22.6752C-0.0420283 22.8875 -0.00668454 23.1351 0.0994145 23.3474C0.382436 23.8426 0.736144 24.3379 1.05451 24.7623C1.54973 25.4345 2.08036 26.0358 2.68174 26.6018C3.17696 27.097 3.74294 27.5569 4.30898 28.0167C7.10351 30.1039 10.4641 31.2004 13.9307 31.2004C17.3974 31.2004 20.758 30.1038 23.5525 28.0167C24.1185 27.5923 24.6845 27.097 25.1798 26.6018C25.7457 26.0358 26.3117 25.4344 26.807 24.7623C27.1607 24.3025 27.4791 23.8426 27.7621 23.3474C27.9389 23.1351 27.9742 22.8874 27.8681 22.6752Z" />
                                        </svg>
                                    </a>
                                @endauth

                                @if ($setting->agent_can_add_property)
                                    @if ($setting->agent_can_add_property == 'enable')
                                        <a href="{{ route('user.choose-property-type') }}"
                                            class="homec-btn"><span>{{ __('user.Create property') }}</span></a>
                                    @endif
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->



    @yield('frontend-content')

    <!-- Footer -->
    <style>
        .footer-area {
            background: #0f172a !important;
            color: #94a3b8;
            padding-top: 50px;
        }
        .homec-form {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 60px;
            flex-wrap: wrap;
        }
        .homec-form__content h4 {
            color: #0f172a;
            font-size: 22px;
            font-weight: 800;
            margin: 0;
        }
        .homec-form__content p {
            color: #64748b;
            font-size: 14px;
            margin: 4px 0 0 0;
        }
        .homec-form__form {
            display: flex !important;
            align-items: center !important;
            background: #ffffff !important;
            padding: 6px 6px 6px 20px !important;
            border-radius: 14px !important;
            border: 1.5px solid #e2e8f0 !important;
            width: 100% !important;
            max-width: 500px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
            box-sizing: border-box !important;
        }
        .homec-form__form input {
            border: none !important;
            background: transparent !important;
            outline: none !important;
            font-size: 15px !important;
            color: #0f172a !important;
            flex: 1 1 auto !important;
            padding: 0 !important;
            margin: 0 !important;
            height: 44px !important;
            line-height: 44px !important;
            box-shadow: none !important;
        }
        .homec-form__form input::placeholder {
            color: #94a3b8 !important;
        }
        .homec-form__form button {
            background: #6366f1 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 15px !important;
            padding: 0 28px !important;
            height: 44px !important;
            line-height: 44px !important;
            border-radius: 10px !important;
            border: none !important;
            white-space: nowrap !important;
            cursor: pointer !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3) !important;
            transition: all 0.2s ease !important;
            margin: 0 !important;
            flex-shrink: 0 !important;
        }
        .homec-form__form button:hover {
            background: #4f46e5 !important;
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.45) !important;
        }
        .footer-about-text {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
            margin-top: 16px;
        }
        .widget-title {
            color: #ffffff !important;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 22px;
        }
        .footer-useful-links ul li a, 
        .footer-need-helps ul li a {
            color: #94a3b8;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            padding: 8px 0;
            transition: color 0.2s ease, transform 0.2s ease;
            text-decoration: none;
        }
        .footer-useful-links ul li a:hover, 
        .footer-need-helps ul li a:hover {
            color: #ffffff;
            transform: translateX(4px);
        }
        .f-contact-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: #94a3b8;
            font-size: 15px;
            margin-bottom: 16px;
        }
        .f-contact-list li a, .f-contact-list li p {
            color: #94a3b8;
            text-decoration: none;
            margin: 0;
            transition: color 0.2s ease;
        }
        .f-contact-list li a:hover {
            color: #ffffff;
        }
        .f-contact-icon {
            width: 36px;
            height: 36px;
            background: rgba(99, 102, 241, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 24px 0;
            margin-top: 60px;
        }
        .copyright-text {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }
        .footer-pages li a {
            color: #64748b;
            font-size: 14px;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.2s ease;
        }
        .footer-pages li a:hover {
            color: #ffffff;
        }
        @media (max-width: 768px) {
            .homec-form {
                flex-direction: column;
                align-items: flex-start;
                padding: 24px;
            }
            .homec-form__form {
                max-width: 100%;
            }
        }
    </style>
    <footer class="footer-area p-relative">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Subscribe Form -->
                    <div class="homec-form">
                        <div class="homec-form__content">
                            <h4>Subscribe To Exclusive Indore Property Updates</h4>
                            <p>Get prime property alerts, price drops & market insights delivered to your inbox.</p>
                        </div>
                        <form id="subscriberForm" class="homec-form__form">
                            @csrf
                            <input type="email" placeholder="Enter your email address" name="email" required>
                            <button id="subscribe_btn" type="submit">
                                <span id="subscribe_btn_text">Subscribe Now</span>
                            </button>
                        </form>
                    </div>
                    <!-- End Subscribe Form -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="footer-top-inner pd-top-10 pd-btm-40">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12 mg-top-30">
                                <!-- Footer Widget -->
                                <div class="footer-about-widget">
                                    <div class="footer-logo homec-header__logo">
                                        @php
                                            $foot_logo = ($setting->footer_logo && file_exists(public_path($setting->footer_logo))) 
                                                ? asset($setting->footer_logo) 
                                                : asset('uploads/website-images/logo-2026-01-10-05-02-59-8516.png');
                                        @endphp
                                        <a class="logo" href="{{ route('home') }}"><img src="{{ $foot_logo }}" alt="Orbosis Reality Logo" style="max-height: 48px;"></a>
                                    </div>
                                    <p class="footer-about-text">Indore's leading real estate platform for residential homes, commercial spaces, plots, and premium luxury properties.</p>
                                    <!-- Social -->
                                    <ul class="homec-social homec-social__v2 mt-3">
                                        @foreach ($social_links as $social_link)
                                            <li><a href="{{ $social_link->link }}"><i class="{{ $social_link->icon }}"></i></a></li>
                                        @endforeach
                                    </ul>
                                    <!-- End Social -->
                                </div>
                                <!-- End Footer Widget -->
                            </div>
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12 mg-top-30">
                                        <!-- Footer Widget -->
                                        <div class="single-widget footer-useful-links">
                                            <h3 class="widget-title">{{ __('user.Property Type') }}</h3>
                                            <ul class="f-useful-links-inner list-none">
                                                @foreach ($footer_categories as $footer_category)
                                                    <li>
                                                        <a href="{{ route('properties', ['property_type' => $footer_category->slug]) }}">
                                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; flex-shrink: 0;">
                                                                <polyline points="9 18 15 12 9 6"></polyline>
                                                            </svg>
                                                            {{ $footer_category->translate(front_lang(), 'name') }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End Footer Widget -->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mg-top-30">
                                        <!-- Footer Widget -->
                                        <div class="single-widget footer-need-helps">
                                            <h3 class="widget-title">{{ __('user.Important Link') }}</h3>
                                            <ul class="f-need-helps-inner list-none">
                                                <li>
                                                    <a href="{{ route('about-us') }}">
                                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; flex-shrink: 0;">
                                                            <polyline points="9 18 15 12 9 6"></polyline>
                                                        </svg>
                                                        {{ __('user.About Us') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('contact-us') }}">
                                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px; flex-shrink: 0;">
                                                            <polyline points="9 18 15 12 9 6"></polyline>
                                                        </svg>
                                                        {{ __('user.Contact Us') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- End Footer Widget -->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 mg-top-30">
                                        <!-- Footer Widget -->
                                        <div class="single-widget footer-contact">
                                            <h3 class="widget-title">{{ __('user.Contact Us') }}</h3>
                                            <div class="f-contact__form-top">
                                                <ul class="f-contact-list list-none">
                                                    <li>
                                                        <div class="f-contact-icon">
                                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                                            </svg>
                                                        </div>
                                                        <a href="tel:{{ $footer->phone }}">{{ $footer->phone }}</a>
                                                    </li>
                                                    <li>
                                                        <div class="f-contact-icon">
                                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                                <polyline points="22,6 12,13 2,6"></polyline>
                                                            </svg>
                                                        </div>
                                                        <a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a>
                                                    </li>
                                                    <li>
                                                        <div class="f-contact-icon">
                                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                <circle cx="12" cy="10" r="3"></circle>
                                                            </svg>
                                                        </div>
                                                        <p>{{ $footer->address }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End Footer Widget -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12">
                        <p class="copyright-text">{{ $footer->copyright }}</p>
                    </div>
                    <div class="col-lg-6 col-12">
                        <ul class="footer-pages list-none d-flex justify-content-lg-end justify-content-start mt-lg-0 mt-2">
                            <li><a href="{{ route('privacy-policy') }}">{{ __('user.Privacy Policy') }}</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}">{{ __('user.Terms & Conditions') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Scroll Top -->
    <a href="#" class="scrollToTop" title="{{ __('user.Go Top') }}">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 15l-6-6-6 6"/>
        </svg>
    </a>



    @if ($tawk_setting->status == 1)
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = '{{ $tawk_setting->chat_link }}';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    @endif

    @if ($cookie_consent->status == 1)
        <script src="{{ asset('frontend/js/cookieconsent.min.js') }}"></script>

        <script>
            window.addEventListener("load", function() {
                window.wpcc.init({
                    "border": "{{ $cookie_consent->border }}",
                    "corners": "{{ $cookie_consent->corners }}",
                    "colors": {
                        "popup": {
                            "background": "{{ $cookie_consent->background_color }}",
                            "text": "{{ $cookie_consent->text_color }} !important",
                            "border": "{{ $cookie_consent->border_color }}"
                        },
                        "button": {
                            "background": "{{ $cookie_consent->btn_bg_color }}",
                            "text": "{{ $cookie_consent->btn_text_color }}"
                        }
                    },
                    "content": {
                        "href": "{{ route('privacy-policy') }}",
                        "message": "{{ $cookie_consent->message }}",
                        "link": "{{ $cookie_consent->link_text }}",
                        "button": "{{ $cookie_consent->btn_text }}"
                    }
                })
            });
        </script>
    @endif

    <script src="{{ asset('frontend/js/jquery-migrate.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- Aos JS -->
    <script src="{{ asset('frontend/js/aos.min.js') }}"></script>
    <!-- CK Editor JS -->
    <script src="{{ asset('frontend/js/ckeditor.min.js') }}"></script>
    <!-- Select2 JS-->
    <script src="{{ asset('frontend/js/select2-js.min.js') }}"></script>
    <!-- Video Popup JS -->
    <script src="{{ asset('frontend/js/video-popup.min.js') }}"></script>


    <script src="{{ asset('frontend/js/flex-slider.js') }}"></script>

    <!-- Waypoints JS -->
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <!-- Counterup JS -->
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('frontend/js/easing.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend/js/active.js') }}"></script>

    <script src="{{ asset('toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}');
            </script>
        @endforeach
    @endif


    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                tinymce.init({
                    selector: '.summernote',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist ',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [{
                            value: 'First.Name',
                            title: 'First Name'
                        },
                        {
                            value: 'Email',
                            title: 'Email'
                        },
                    ]
                });

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



                $("#rent_price_range").on("change", function() {
                    let min_price = $(this).find(':selected').data('min-price');
                    let max_price = $(this).find(':selected').data('max-price');
                    $("#rent_min_price").val(min_price);
                    $("#rent_max_price").val(max_price);
                })

                $("#sale_price_range").on("change", function() {
                    let min_price = $(this).find(':selected').data('min-price');
                    let max_price = $(this).find(':selected').data('max-price');
                    $("#sale_min_price").val(min_price);
                    $("#sale_max_price").val(max_price);
                })

                $("#any_price_range").on("change", function() {
                    let min_price = $(this).find(':selected').data('min-price');
                    let max_price = $(this).find(':selected').data('max-price');
                    $("#any_min_price").val(min_price);
                    $("#any_max_price").val(max_price);
                })

                $("#subscriberForm").on('submit', function(e) {
                    e.preventDefault();

                    var isDemo = "{{ env('APP_MODE') }}"
                    if (isDemo == 'DEMO') {
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }

                    let loading = "{{ __('user.Processing...') }}"

                    $("#subscribe_btn_text").html(loading);
                    $("#subscribe_btn").attr('disabled', true);

                    $.ajax({
                        type: 'POST',
                        data: $('#subscriberForm').serialize(),
                        url: "{{ route('subscribe-request') }}",
                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.message);
                                let subscribe = "{{ __('user.Subscribe Now') }}"
                                $("#subscribe_btn_text").html(subscribe);
                                $("#subscribe_btn").attr('disabled', false);
                                $("#subscriberForm").trigger("reset");
                            }

                            if (response.status == 0) {
                                toastr.error(response.message);
                                let subscribe = "{{ __('user.Subscribe Now') }}"
                                $("#subscribe_btn_text").html(subscribe);
                                $("#subscribe_btn").attr('disabled', false);
                                $("#subscriberForm").trigger("reset");
                            }
                        },
                        error: function(err) {
                            toastr.error('Something went wrong');
                            let subscribe = "{{ __('user.Subscribe Now') }}"
                            $("#subscribe_btn_text").html(subscribe);
                            $("#subscribe_btn").attr('disabled', false);
                            $("#subscriberForm").trigger("reset");
                        }
                    });
                })

                /* Hero Slider */
                var heroSwiper = new Swiper(".mySwiper", {
                    autoplay: {
                        delay: 1000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".homec-hero__button-next",
                        prevEl: ".homec-hero__button-prev",
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    mousewheel: true,
                    keyboard: {
                        enabled: true,
                        onlyInViewport: false,
                    },
                    loop: true,
                    grabCursor: true,
                    speed: 800,
                    spaceBetween: 0,
                    centeredSlides: false,
                    pagination: {
                        el: '.swiper-pagination__featured',
                        type: 'bullets',
                        clickable: true,
                        dynamicBullets: false,
                    },
                    slidesPerView: 1,
                    breakpoints: {
                        320: {
                            spaceBetween: 0,
                        },
                        480: {
                            spaceBetween: 0,
                        },
                        640: {
                            spaceBetween: 0,
                        },
                        768: {
                            spaceBetween: 0,
                        },
                        1024: {
                            spaceBetween: 0,
                        },
                    },
                    on: {
                        init: function() {
                            console.log('Hero Swiper initialized successfully');
                            console.log('Slides found:', this.slides.length);
                        },
                        slideChange: function() {
                            console.log('Hero slide changed to:', this.activeIndex);
                        },
                        error: function() {
                            console.log('Hero Swiper error');
                        }
                    }
                });
                console.log('Hero Swiper object:', heroSwiper);

                var swiper = new Swiper(".homec-slider-agent__card", {
                    autoplay: {
                        delay: 344500,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    mousewheel: true,
                    keyboard: true,
                    loop: true,
                    grabCursor: true,
                    spaceBetween: 30,
                    centeredSlides: false,
                    pagination: {
                        el: '.swiper-pagination__slider--agent',
                        type: 'bullets',
                        clickable: true,
                    },
                    slidesPerView: "1",
                });

                /* Slider Property */
                var swiper = new Swiper(".homec-slider-property", {
                    autoplay: {
                        delay: 4000,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    mousewheel: true,
                    keyboard: true,
                    loop: true,
                    grabCursor: true,
                    spaceBetween: 30,
                    centeredSlides: false,
                    pagination: {
                        el: '.swiper-pagination__property',
                        type: 'bullets',
                        clickable: true,
                    },
                    slidesPerView: "4",
                    breakpoints: {
                        320: {
                            slidesPerView: "1",
                        },
                        428: {
                            slidesPerView: "1",
                        },
                        640: {
                            slidesPerView: "2",
                        },
                        768: {
                            slidesPerView: "2",
                        },
                        1024: {
                            slidesPerView: "3",
                        },
                    },
                });

                /* Agent Slider */
                var swiper = new Swiper(".homec-slider-agent", {
                    autoplay: {
                        delay: 4000,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    mousewheel: true,
                    keyboard: true,
                    loop: true,
                    grabCursor: true,
                    spaceBetween: 30,
                    centeredSlides: false,
                    pagination: {
                        el: '.swiper-pagination__agent',
                        type: 'bullets',
                        clickable: true,
                    },
                    slidesPerView: "4",
                    breakpoints: {
                        320: {
                            slidesPerView: "1",
                        },
                        428: {
                            slidesPerView: "1",
                        },
                        640: {
                            slidesPerView: "2",
                        },
                        768: {
                            slidesPerView: "2",
                        },
                        1024: {
                            slidesPerView: "3",
                        },
                        1100: {
                            slidesPerView: "4",
                        },
                    },
                });

                /* Testimonial Slider */
                var swiper = new Swiper(".homec-slider-testimonial", {
                    autoplay: {
                        delay: 4000,
                    },
                    mousewheel: true,
                    keyboard: true,
                    loop: true,
                    grabCursor: true,
                    spaceBetween: 30,
                    centeredSlides: false,
                    breakpoints: {
                        320: {
                            slidesPerView: "1",
                        },
                        428: {
                            slidesPerView: "1",
                        },
                        768: {
                            slidesPerView: "1",
                        },
                        1024: {
                            slidesPerView: "2",
                        },
                    },
                });

                /* Client Slider */
                var swiper = new Swiper(".homec-slider-client", {
                    autoplay: {
                        delay: 3500,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    mousewheel: true,
                    keyboard: true,
                    loop: true,
                    grabCursor: true,
                    spaceBetween: 30,
                    centeredSlides: false,
                    slidesPerView: "4",
                    breakpoints: {
                        320: {
                            slidesPerView: "2",
                        },
                        428: {
                            slidesPerView: "2",
                        },
                        640: {
                            slidesPerView: "3",
                        },
                        768: {
                            slidesPerView: "4",
                        },
                        1024: {
                            slidesPerView: "6",
                        },
                    },
                });


                $('#f1').flexslider({
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    start: function(slider) {
                        $('body').removeClass('loading');
                    }
                });
                $('#f2').flexslider({
                    animation: "slide",
                    animationLoop: true,
                    itemWidth: 200,
                    itemMargin: 0,
                    pausePlay: false,
                    mousewheel: true,
                    asNavFor: '.flexslider',
                    controlNav: false,
                    move: 1,
                    pauseOnAction: false,
                    slideshow: false,
                    manualControls: true
                });

            });

            $("#lang_swithcer_for_mobile").on("change", function(e) {
                $("#lang_swithcer_form_for_mobile").submit();
            });

            $("#currency_swithcer_for_mobile").on("change", function(e) {
                $("#currency_swithcer_form_for_mobile").submit();
            });



        })(jQuery);
    </script>
    <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }

            const flagIcon = $(state.element).data('content');

            const $state = $(
                `<span>${flagIcon} ${state.text}</span>`
            );

            return $state;

        };

        $(function() {




            $('.selectpicker').selectpicker();
            $('.select2_for_lang').select2({
                templateResult: formatState,
                templateSelection: formatState
            });
        });
    </script>
</body>

</html>
