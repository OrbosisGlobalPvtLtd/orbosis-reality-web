<!DOCTYPE html>

@if ($setting->text_direction == 'rtl')
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
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500&display=swap" rel="stylesheet">

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
		<!-- Swiper Slider CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/swiper-slider.min.css') }}">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/select2-min.css') }}">
		<!-- Video Popup -->
		<link rel="stylesheet" href="{{ asset('frontend/css/video-popup.min.css') }}">
		<!-- Jquery UI CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/theme-default.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

        <link rel="stylesheet" href="{{ asset('frontend/css/kyc.css') }}">
		
		
		@if ($setting->text_direction == 'rtl')
		<link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
		@endif
		
		
		{{-- <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}"> --}}
		
		<!-- Jquery JS -->
		<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>

        @if ($googleAnalytic->status == 1)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAnalytic->analytic_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $googleAnalytic->analytic_id }}');
        </script>
        @endif

        @if ($facebookPixel->status == 1)
            <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $facebookPixel->app_id }}');
            fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={{ $facebookPixel->app_id }}&ev=PageView&noscript=1"
        /></noscript>
        @endif

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
					<div class="modal-header offcanvas-header">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<!-- offcanvas-logo-start -->
					 <div class="offcanvas-logo">
						<div class="homec-header__logo">
							<a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="logo"></a>
						</div>
					</div>
					<!-- offcanvas-logo-end -->
					<!-- offcanvas-menu start -->
					<nav id="offcanvas-menu" class="offcanvas-menu">
						<!-- Main Menu -->
						<ul class="nav-menu menu navigation list-none">
							                            @if ($setting->selected_theme == 0)
                                <li class="menu-item-has-children"><a href="javascript:;">{{__('user.Home')}}</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('home',['theme' => 1]) }}">{{__('user.Homepage 01')}}</a></li>
                                        <li><a href="{{ route('home',['theme' => 2]) }}">{{__('user.Homepage 02')}}</a></li>
                                        <li><a href="{{ route('home',['theme' => 3]) }}">{{__('user.Homepage 03')}}</a></li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            @endif

                            <li class="menu-item-has-children"><a href="javascript:;">{{__('user.Properties')}}</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('properties',['purpose' => 'any']) }}">{{__('user.Properties')}}</a></li>

                                    <li><a href="{{ route('properties',['purpose' => 'any','featured_property' => 'enable']) }}">{{__('user.Featured Properties')}}</a></li>

                                    <li><a href="{{ route('properties',['purpose' => 'any','urgent_property' => 'enable']) }}">{{__('user.Urgent Properties')}}</a></li>

                                    <li><a href="{{ route('properties',['purpose' => 'any','top_property' => 'enable']) }}">{{__('user.Top Properties')}}</a></li>

                                </ul>
                            </li>

                            <li><a href="{{ route('agencies') }}">{{ __('user.Our Agency') }}</a></li>

							<li class="menu-item-has-children"><a href="#">{{__('user.Pages')}}</a>
                                <ul class="sub-menu">

                                    @if ($setting->agent_can_add_property)
                                        @if ($setting->agent_can_add_property == 'enable')
                                        <li><a href="{{ route('pricing-plan') }}">{{__('user.Pricing Plan')}}</a></li>
                                        @endif
                                    @endif
                                    <li><a href="{{ route('about-us') }}">{{__('user.About Us')}}</a></li>
                                    <li><a href="{{ route('blogs') }}">{{__('user.Blogs')}}</a></li>
                                    <li><a href="{{ route('faq') }}">{{__('user.FAQ')}}</a></li>

                                    <li><a href="{{ route('terms-and-conditions') }}">{{__('user.Terms and Conditions')}}</a></li>

                                    <li><a href="{{ route('privacy-policy') }}">{{__('user.Privacy Policy')}}</a></li>

                                    @foreach ($custom_pages as $custom_page)
                                    <li><a href="{{ route('page', $custom_page->slug) }}">{{ $custom_page->page_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a href="{{ route('contact-us') }}">{{__('user.Contact')}}</a></li>

                            <li><a href="{{ route('user.dashboard') }}">{{__('user.Dashboard')}}</a></li>

                            @if ($setting->agent_can_add_property)
                                @if ($setting->agent_can_add_property == 'enable')
                                <li><a href="{{ route('user.choose-property-type') }}">{{__('user.Create Property')}}</a></li>
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
            <div class="homec-header__top p-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="homec-topbar-flex homec-topbar-flex--v2">
                                <!-- Contact -->
                                <ul class="homec-header__list homec-header__list--v2">
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
                            <ul class="homec-social homec-social__topbar">
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


                            </ul>

                                <!-- Social -->
                                {{-- <ul class="homec-social homec-social__topbar homec-social__topbar--v2">
                                    @foreach ($social_links as $social_link)
                                        <li><a href="{{ $social_link->link }}"><i class="{{ $social_link->icon }}"></i></a></li>
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
                            <div class="homec-header__inside homec-header__inside--v2">
                                <div class="homec-header__group">
                                    <div class="homec-header__logo">
                                        <a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="logo"></a>
                                    </div>

                                    <div class="homec-header__menu">
                                        <div class="navbar">
                                            <div class="nav-item">
                                                <!-- Main Menu -->
                                                <ul class="nav-menu menu navigation list-none">

                                                    @if ($setting->selected_theme == 0)
                                                        <li class="menu-item-has-children"><a href="javascript:;">{{__('user.Home')}}</a>
                                                            <ul class="sub-menu">
                                                                <li><a href="{{ route('home',['theme' => 1]) }}">{{__('user.Homepage 01')}}</a></li>
                                                                <li><a href="{{ route('home',['theme' => 2]) }}">{{__('user.Homepage 02')}}</a></li>
                                                                <li><a href="{{ route('home',['theme' => 3]) }}">{{__('user.Homepage 03')}}</a></li>
                                                            </ul>
                                                        </li>
                                                    @else
                                                        <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                                                    @endif

                                                    <li class="menu-item-has-children"><a href="javascript:;">{{__('user.Properties')}}</a>
														<ul class="sub-menu">
															<li><a href="{{ route('properties',['purpose' => 'any']) }}">{{__('user.Properties')}}</a></li>

                                                            <li><a href="{{ route('properties',['purpose' => 'any','featured_property' => 'enable']) }}">{{__('user.Featured Properties')}}</a></li>

                                                            <li><a href="{{ route('properties',['purpose' => 'any','urgent_property' => 'enable']) }}">{{__('user.Urgent Properties')}}</a></li>

                                                            <li><a href="{{ route('properties',['purpose' => 'any','top_property' => 'enable']) }}">{{__('user.Top Properties')}}</a></li>


														</ul>
													</li>

                                                    <li><a href="{{ route('agencies') }}">{{ __('user.Our Agency') }}</a></li>

													<li class="menu-item-has-children"><a href="#">{{__('user.Pages')}}</a>
														<ul class="sub-menu">

															@if ($setting->agent_can_add_property)
                                                                @if ($setting->agent_can_add_property == 'enable')
                                                                <li><a href="{{ route('pricing-plan') }}">{{__('user.Pricing Plan')}}</a></li>
                                                                @endif
                                                            @endif

                                                            <li><a href="{{ route('about-us') }}">{{__('user.About Us')}}</a></li>

															<li><a href="{{ route('blogs') }}">{{__('user.Blogs')}}</a></li>
															<li><a href="{{ route('faq') }}">{{__('user.FAQ')}}</a></li>

                                                            <li><a href="{{ route('terms-and-conditions') }}">{{__('user.Terms and Conditions')}}</a></li>

                                                            <li><a href="{{ route('privacy-policy') }}">{{__('user.Privacy Policy')}}</a></li>

                                                            @foreach ($custom_pages as $custom_page)
                                                            <li><a href="{{ route('page', $custom_page->slug) }}">{{ $custom_page->page_name }}</a></li>
                                                            @endforeach
														</ul>
													</li>

													<li><a href="{{ route('contact-us') }}">{{__('user.Contact')}}</a></li>
                                                </ul>
                                                <!-- End Main Menu -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="offcanvas-toggler" data-bs-toggle="modal" data-bs-target="#offcanvas-modal"><span class="line"></span><span class="line"></span><span class="line"></span>
                                </button>
                                <div class="homec-header__button">
                                    @auth('web')
                                        <a href="{{ route('user.dashboard') }}" class="homec-header__icon">
                                            <svg width="28" height="32" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9659 16.2014C18.423 16.2014 22.0666 12.5579 22.0666 8.1007C22.0666 3.64352 18.423 0 13.9659 0C9.50869 0 5.86523 3.64352 5.86523 8.1007C5.86523 12.5579 9.50876 16.2014 13.9659 16.2014Z" />
                                                <path d="M27.8681 22.6752C27.6558 22.1446 27.3729 21.6494 27.0545 21.1895C25.4273 18.784 22.9158 17.1922 20.0858 16.8031C19.7321 16.7677 19.343 16.8384 19.06 17.0507C17.5743 18.1473 15.8056 18.7133 13.9661 18.7133C12.1266 18.7133 10.3579 18.1473 8.87219 17.0507C8.58917 16.8384 8.20005 16.7323 7.84634 16.8031C5.0164 17.1922 2.46948 18.784 0.877655 21.1895C0.55929 21.6494 0.276269 22.18 0.0640708 22.6752C-0.0420283 22.8875 -0.00668454 23.1351 0.0994145 23.3474C0.382436 23.8426 0.736144 24.3379 1.05451 24.7623C1.54973 25.4345 2.08036 26.0358 2.68174 26.6018C3.17696 27.097 3.74294 27.5569 4.30898 28.0167C7.10351 30.1039 10.4641 31.2004 13.9307 31.2004C17.3974 31.2004 20.758 30.1038 23.5525 28.0167C24.1185 27.5923 24.6845 27.097 25.1798 26.6018C25.7457 26.0358 26.3117 25.4344 26.807 24.7623C27.1607 24.3025 27.4791 23.8426 27.7621 23.3474C27.9389 23.1351 27.9742 22.8874 27.8681 22.6752Z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="homec-header__icon">
                                            <svg width="28" height="32" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.9659 16.2014C18.423 16.2014 22.0666 12.5579 22.0666 8.1007C22.0666 3.64352 18.423 0 13.9659 0C9.50869 0 5.86523 3.64352 5.86523 8.1007C5.86523 12.5579 9.50876 16.2014 13.9659 16.2014Z" />
                                                <path d="M27.8681 22.6752C27.6558 22.1446 27.3729 21.6494 27.0545 21.1895C25.4273 18.784 22.9158 17.1922 20.0858 16.8031C19.7321 16.7677 19.343 16.8384 19.06 17.0507C17.5743 18.1473 15.8056 18.7133 13.9661 18.7133C12.1266 18.7133 10.3579 18.1473 8.87219 17.0507C8.58917 16.8384 8.20005 16.7323 7.84634 16.8031C5.0164 17.1922 2.46948 18.784 0.877655 21.1895C0.55929 21.6494 0.276269 22.18 0.0640708 22.6752C-0.0420283 22.8875 -0.00668454 23.1351 0.0994145 23.3474C0.382436 23.8426 0.736144 24.3379 1.05451 24.7623C1.54973 25.4345 2.08036 26.0358 2.68174 26.6018C3.17696 27.097 3.74294 27.5569 4.30898 28.0167C7.10351 30.1039 10.4641 31.2004 13.9307 31.2004C17.3974 31.2004 20.758 30.1038 23.5525 28.0167C24.1185 27.5923 24.6845 27.097 25.1798 26.6018C25.7457 26.0358 26.3117 25.4344 26.807 24.7623C27.1607 24.3025 27.4791 23.8426 27.7621 23.3474C27.9389 23.1351 27.9742 22.8874 27.8681 22.6752Z"/>
                                            </svg>
                                        </a>
                                    @endif

                                    @if ($setting->agent_can_add_property)
                                        @if ($setting->agent_can_add_property == 'enable')
                                        <a href="{{ route('user.choose-property-type') }}" class="homec-btn"><span>{{__('user.Create property')}}</span></a>
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
		<footer class="footer-area p-relative">
			<div class="homec-shape">
				<div class="homec-shape-single homec-shape-10"><img src="{{ asset($footer->background_image) }}" alt="#"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- Subscribe Form -->
						<div class="homec-form mg-top-100">
							<div class="homec-form__content">
								<span class="homec-form__label">{{__('user.For Rent house offer')}}</span>
								<h3 class="homec-form__title">{{__('user.Join Homeco  Community')}}</h3>
							</div>
							<form id="subscriberForm" class="homec-form__form">
                                @csrf
								<input type="email"  placeholder="{{__('user.Your Email')}}" name="email">
								<button id="subscribe_btn" type="submit" class="homec-btn"><span id="subscribe_btn_text">{{__('user.Subscribe Now')}}</span></button>
							</form>
						</div>
						<!-- End Subscribe Form -->
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="footer-top-inner pd-top-30 pd-btm-100">
							<div class="row">
								<div class="col-lg-4 col-md-3 col-12">
									<!-- Footer Widget -->
									<div class="footer-about-widget">
										<div class="footer-logo homec-header__logo">
											<a class="logo" href="{{ route('home') }}"><img src="{{ asset($setting->footer_logo) }}" alt="logo"></a>
										</div>
										<p class="footer-about-text">{{ $footer->about_us }}</p>
										<!-- Social -->
										<ul class="homec-social homec-social__v2">

                                            @foreach ($social_links as $social_link)
                                                <li><a href="{{ $social_link->link }}"><i class="{{ $social_link->icon }}"></i></a></li>
                                            @endforeach

										</ul>
										<!-- End Social -->
									</div>
									<!-- End Footer Widget -->
								</div>
								<div class="col-lg-8 col-md-9">
									<div class="row">
										<div class="col-lg-4 col-md-4 col-12">
											<!-- Footer Widget -->
											<div class="single-widget footer-useful-links">
												<h3 class="widget-title">{{__('user.Property Type')}}</h3>
												<ul class="f-useful-links-inner list-none">
                                                    @foreach ($footer_categories as $footer_category)
													<li><a href="{{ route('properties', ['property_type' => $footer_category->slug]) }}"><i class="fa-solid fa-minus"></i>{{ $footer_category->name }}</a></li>
                                                    @endforeach

												</ul>
											</div>
											<!-- End Footer Widget -->
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<!-- Footer Widget -->
											<div class="single-widget footer-need-helps">
												<h3 class="widget-title">{{__('user.Important Link')}}</h3>
												<ul class="f-need-helps-inner list-none">
													<li><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-minus"></i>{{__('user.Dashboard')}}</a></li>
													<li><a href="{{ route('user.wishlist') }}"><i class="fa-solid fa-minus"></i>{{__('user.Wishlist')}}</a></li>
													<li><a href="{{ route('user.change-password') }}"><i class="fa-solid fa-minus"></i>{{__('user.Change Password')}}</a></li>
													<li><a href="{{ route('about-us') }}"><i class="fa-solid fa-minus"></i>{{__('user.About Us')}}</a></li>
													<li><a href="{{ route('contact-us') }}"><i class="fa-solid fa-minus"></i>{{__('user.Contact Us')}}</a></li>
												</ul>
											</div>
											<!-- End Footer Widget -->
										</div>
										<div class="col-lg-4 col-md-4 col-12">
											<!-- Footer Widget -->
											<div class="single-widget footer-contact">
												<h3 class="widget-title">{{__('user.Contact Us')}}</h3>
												<div class="f-contact__form-top">
													<ul class="f-contact-list list-none">
														<li><img src="{{ asset('frontend/img/footer-phone.svg') }}" alt="phone"><a href="tel:{{ $footer->phone }}">{{ $footer->phone }}</a></li>
														<li><img src="{{ asset('frontend/img/footer-message.png') }}" alt="email"><a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a></li>
														<li><img src="{{ asset('frontend/img/footer-location.png') }}" alt="address"><p>{{ $footer->address }}</p></li>
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
					<div class="row">
						<div class="col-lg-6 col-12">
							<!-- Copyright Text -->
							<p class="copyright-text">{{ $footer->copyright }}</a></p>
						</div>
						<div class="col-lg-6 col-12">
							<!-- Footer Page List -->
							<ul class="footer-pages list-none">
								<li><a href="{{ route('privacy-policy') }}">{{__('user.Privacy Policy')}}</a></li>
								<li><a href="{{ route('terms-and-conditions') }}">{{__('user.Terms & Conditions')}}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- End Copyright -->
		</footer>
		<!-- End Footer -->

		<!-- Scrool Top -->
		<a href="#" class="scrollToTop">{{__('user.Go Top')}}<i class="fa-solid fa-angle-right"></i></a>


        @if ($tawk_setting->status == 1)
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='{{ $tawk_setting->chat_link }}';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        @endif


        @if ($cookie_consent->status == 1)
        <script src="{{ asset('frontend/js/cookieconsent.min.js') }}"></script>

        <script>
        window.addEventListener("load",function(){window.wpcc.init({"border":"{{ $cookie_consent->border }}","corners":"{{ $cookie_consent->corners }}","colors":{"popup":{"background":"{{ $cookie_consent->background_color }}","text":"{{ $cookie_consent->text_color }} !important","border":"{{ $cookie_consent->border_color }}"},"button":{"background":"{{ $cookie_consent->btn_bg_color }}","text":"{{ $cookie_consent->btn_text_color }}"}},"content":{"href":"{{ route('privacy-policy') }}","message":"{{ $cookie_consent->message }}","link":"{{ $cookie_consent->link_text }}","button":"{{ $cookie_consent->btn_text }}"}})});
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
		<!-- Swiper SLider JS -->
		<script src="{{ asset('frontend/js/swiper-slider.min.js') }}"></script>
		<!-- Waypoints JS -->
		<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
		<!-- Counterup JS -->
		<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
		<!-- Easing JS -->
		<script src="{{ asset('frontend/js/easing.min.js') }}"></script>
		<!-- Main JS -->
		<script src="{{ asset('frontend/js/active.js') }}"></script>

        <script src="{{ asset('toastr/toastr.min.js') }}"></script>

        <script>
            @if(Session::has('messege'))
            var type="{{Session::get('alert-type','info')}}"
            switch(type){
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
        $(document).ready(function () {

            $("#any_price_range").on("change", function(){
                let min_price = $(this).find(':selected').data('min-price');
                let max_price = $(this).find(':selected').data('max-price');
                $("#any_min_price").val(min_price);
                $("#any_max_price").val(max_price);
            })

            $(".add-to-wishlist").on("click", function(){

                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                let property_id = $(this).data('property-id');

                $.ajax({
                    type: 'get',
                    url: "{{ url('/user/add-to-wishlist') }}" + "/" + property_id,
                    success: function (response) {
                        toastr.success(response.message)
                    },
                    error: function(err) {
                        if(err.status == 401){
                            toastr.error("{{__('user.Please login first')}}")
                        }

                        if(err.status == 403){
                            let erro_message = err.responseJSON.message
                            toastr.error(erro_message)
                        }
                    }
                });
            })

			$(".add-to-compare").on("click", function(){
			var isDemo = "{{ env('APP_MODE') }}"
			if(isDemo == 'DEMO'){
				toastr.error('This Is Demo Version. You Can Not Change Anything');
				return;
			}
			let property_id = $(this).data('property-id');
			$.ajax({
				type: 'get',
				url: "{{ url('/user/add-to-compare') }}" + "/" + property_id,
				success: function (response) {
					toastr.success(response.message)
				},
				error: function(err) {
					if(err.status == 401){
						toastr.error("{{__('user.Please login first')}}")
					}

					if(err.status == 403){
						let erro_message = err.responseJSON.message
						toastr.error(erro_message)
					}
				}
			});
		  })

            $("#subscriberForm").on('submit', function(e){
                e.preventDefault();

                var isDemo = "{{ env('APP_MODE') }}"
                if(isDemo == 'DEMO'){
                    toastr.error('This Is Demo Version. You Can Not Change Anything');
                    return;
                }

                let loading = "{{__('user.Processing...')}}"

                $("#subscribe_btn_text").html(loading);
                $("#subscribe_btn").attr('disabled',true);

                $.ajax({
                    type: 'POST',
                    data: $('#subscriberForm').serialize(),
                    url: "{{ route('subscribe-request') }}",
                    success: function (response) {
                        if(response.status == 1){
                            toastr.success(response.message);
                            let subscribe = "{{__('user.Subscribe Now')}}"
                            $("#subscribe_btn_text").html(subscribe);
                            $("#subscribe_btn").attr('disabled',false);
                            $("#subscriberForm").trigger("reset");
                        }

                        if(response.status == 0){
                            toastr.error(response.message);
                            let subscribe = "{{__('user.Subscribe Now')}}"
                            $("#subscribe_btn_text").html(subscribe);
                            $("#subscribe_btn").attr('disabled',false);
                            $("#subscriberForm").trigger("reset");
                        }
                    },
                    error: function(err) {
                        toastr.error('Something went wrong');
                        let subscribe = "{{__('user.Subscribe Now')}}"
                            $("#subscribe_btn_text").html(subscribe);
                            $("#subscribe_btn").attr('disabled',false);
                            $("#subscriberForm").trigger("reset");
                    }
                });
            })

            /* urgent  property Slider */
			var swiper = new Swiper(".homec-slider-gallery", {
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
				spaceBetween: 20,
				centeredSlides: false,
				pagination: {
					el: '.swiper-pagination__gallery',
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
					slidesPerView:"1",
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
					slidesPerView:"1",
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
					slidesPerView:"1",
				  },
				  768: {
					slidesPerView:"1",
				  },
				  1024: {
					slidesPerView:"2",
				  },
				},
			});

            /* Testimonial Slider */
			var swiper = new Swiper(".homec-slider-testimonial--v2", {
				autoplay: {
					 delay: 3500,
				},
				mousewheel: true,
				keyboard: true,
				loop: true,
				grabCursor: true,
				spaceBetween: 30,
				centeredSlides: false,
				pagination: {
					el: '.swiper-pagination__testimonial',
					type: 'bullets',
					clickable: true,
				},
				slidesPerView: "1",
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
					slidesPerView:"2",
				  },
				  640: {
					slidesPerView: "3",
				  },
				  768: {
					slidesPerView: "4",
				  },
				  1024: {
					slidesPerView: "4",
				  },
				},
			});

            /* Home Featured Slider */
			var swiper = new Swiper(".homec-slider-pcard", {
				autoplay: {
					delay: 2500,
				},
				navigation: {
				  nextEl: ".swiper-button-next",
				  prevEl: ".swiper-button-prev",
				},
				effect: 'fade',
				mousewheel: true,
				keyboard: true,
				loop: true,
				grabCursor: true,
				speed: 500,
				spaceBetween: 15,
				centeredSlides: false,
				pagination: {
					el: '.swiper-pagination__featured',
					type: 'bullets',
					clickable: true,
				},
				slidesPerView: "1",
			});

        });

		$("#lang_swithcer_for_mobile").on("change", function(e){
                $("#lang_swithcer_form_for_mobile").submit();
            });

            $("#currency_swithcer_for_mobile").on("change", function(e){
                $("#currency_swithcer_form_for_mobile").submit();
            });


    })(jQuery);


</script>
<script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script>
        $(function() {
            $('.selectpicker').selectpicker();
        });
    </script>
	</body>
</html>
