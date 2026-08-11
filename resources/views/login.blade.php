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
		<meta name="keywords" content="{{__('user.Orbosis Reality || Login')}}">
		<meta name="description" content="{{__('user.Orbosis Reality || Login')}}">
		<meta name="title" content="{{__('user.Orbosis Reality || Login')}}">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Site Title -->
		<title>{{__('user.Orbosis Reality || Login')}}</title>

		<!-- Fav Icon -->
        <link rel="icon" type="image/png" href="{{ asset($setting->favicon) }}">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500&display=swap" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
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

        @if ($setting->text_direction == 'rtl')
            <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
        @endif

        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        @include('theme_color')

    <style>
        /* Full Page Auth Layout */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .ecom-wc__full {
            min-height: 100vh !important;
            height: auto !important;
            overflow-y: auto !important;
            display: flex !important;
            align-items: stretch !important;
            background: #f8fafc !important;
        }

        .ecom-wc__full .container-fluid {
            padding: 0 !important;
            width: 100% !important;
        }

        .ecom-wc__full .row {
            margin: 0 !important;
            min-height: 100vh !important;
            width: 100% !important;
        }

        /* Form Container Column */
        .ecom-wc__form {
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
            align-items: center !important;
            min-height: 100vh !important;
            height: 100% !important;
            padding: 50px 30px !important;
            background: #ffffff !important;
            overflow-y: auto !important;
        }

        .ecom-wc__form-inner {
            width: 100% !important;
            max-width: 460px !important;
            min-width: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
            border: none !important;
            background: transparent !important;
            margin: 0 auto !important;
        }

        /* Header & Titles */
        .ecom-wc__form-title {
            font-size: 28px !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            border-bottom: none !important;
            padding-bottom: 0 !important;
            margin-bottom: 24px !important;
            gap: 6px !important;
        }

        .ecom-wc__form-title span {
            font-size: 14px !important;
            color: #64748b !important;
            font-weight: 400 !important;
        }

        /* Form Inputs */
        .homec-form-input {
            margin-bottom: 20px !important;
        }

        .ecom-wc__form-label {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #334155 !important;
            margin-bottom: 8px !important;
            display: block !important;
        }

        .form-input-label-group {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .forget-password {
            color: #0052cc !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }

        .forget-password:hover {
            color: #0040a8 !important;
            text-decoration: underline !important;
        }

        .ecom-wc__form-input {
            height: 48px !important;
            border-radius: 12px !important;
            border: 1px solid #cbd5e1 !important;
            padding: 0 16px !important;
            font-size: 14px !important;
            color: #0f172a !important;
            background: #ffffff !important;
            outline: none !important;
            transition: all 0.3s ease !important;
            width: 100% !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02) !important;
        }

        .ecom-wc__form-input:focus {
            border-color: #0052cc !important;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.15) !important;
        }

        /* Buttons */
        .ecom-wc__button {
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            margin-top: 10px !important;
        }

        .homec-btn__second {
            height: 48px !important;
            border-radius: 12px !important;
            background: #0052cc !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 15px !important;
            border: none !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 14px rgba(0, 82, 204, 0.3) !important;
            text-decoration: none !important;
        }

        .homec-btn__second span {
            color: #ffffff !important;
            font-weight: 600 !important;
        }

        .homec-btn__second:hover {
            background: #0040a8 !important;
            box-shadow: 0 6px 18px rgba(0, 82, 204, 0.4) !important;
            transform: translateY(-1px) !important;
        }

        .homec-btn__social {
            background: #ffffff !important;
            color: #334155 !important;
            border: 1px solid #cbd5e1 !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04) !important;
            gap: 10px !important;
        }

        .homec-btn__social span {
            color: #334155 !important;
            font-weight: 600 !important;
        }

        .homec-btn__social:hover {
            background: #f8fafc !important;
            border-color: #94a3b8 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
        }

        .ntfmax-wc__btn-icon img {
            width: 20px !important;
            height: 20px !important;
        }

        /* Bottom Link */
        .ecom-wc__bottom {
            text-align: center !important;
            margin-top: 15px !important;
        }

        .ecom-wc__text {
            font-size: 14px !important;
            color: #64748b !important;
            margin: 0 !important;
        }

        .ecom-wc__text a {
            color: #0052cc !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }

        .ecom-wc__text a:hover {
            text-decoration: underline !important;
        }

        /* Right Side Banner Area */
        .ecom-wc__inner {
            position: relative !important;
            height: 100% !important;
            min-height: 100vh !important;
            padding: 60px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            background-size: cover !important;
            background-position: center !important;
            border-radius: 0 !important;
        }

        .ecom-wc__inner::before {
            content: '' !important;
            position: absolute !important;
            inset: 0 !important;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.75) 0%, rgba(0, 82, 204, 0.85) 100%) !important;
            z-index: 1 !important;
        }

        .ecom-wc__logo,
        .ecom-wc__inside {
            position: relative !important;
            z-index: 2 !important;
        }

        .ecom-wc__logo img {
            max-height: 50px !important;
            width: auto !important;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.3)) !important;
        }

        .ecom-wc__middle {
            text-align: center !important;
            margin: auto 0 !important;
        }

        .ecom-wc__middle img {
            max-width: 220px !important;
            height: auto !important;
            border-radius: 20px !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3) !important;
            border: 4px solid rgba(255, 255, 255, 0.2) !important;
        }

        .ecom-wc__countdown--title {
            display: none !important; /* Hide weird floating overlays cutting image */
        }

        .ecom-wc__footer {
            margin-top: 30px !important;
        }

        .ecom-wc__footer--list {
            display: flex !important;
            gap: 24px !important;
            justify-content: center !important;
            padding: 0 !important;
            margin-bottom: 10px !important;
        }

        .ecom-wc__footer--list a {
            color: rgba(255, 255, 255, 0.85) !important;
            font-size: 13px !important;
            text-decoration: none !important;
        }

        .ecom-wc__footer--list a:hover {
            color: #ffffff !important;
        }

        .ecom-wc__footer--text {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 13px !important;
            text-align: center !important;
            margin: 0 !important;
        }

        /* Mobile Responsiveness */
        @media (max-width: 991px) {
            .ecom-wc__form {
                min-height: 100vh;
                padding: 40px 20px;
            }
            .ecom-wc__form-inner {
                max-width: 100% !important;
            }
        }
    </style>

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
        @endif

		<!-- Sign In -->
        <section class="ecom-wc ecom-wc__full ecom-bg-cover">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="ecom-wc__form">
                            <div class="ecom-wc__form-inner">
                                <h3 class="ecom-wc__form-title ecom-wc__form-title__one">{{__('user.Login')}} <span>To access our platform, please login first</span></h3>
                                <!-- Sign in Form -->
                                <form class="ecom-wc__form-main p-0" action="{{ route('store-login') }}" method="post">
                                    @csrf
                                    <div class="form-group homec-form-input">
                                        <label class="ecom-wc__form-label mg-btm-10">{{__('user.Email')}}*</label>
                                        <div class="form-group__input">
                                        @if (env('APP_MODE') == 'DEMO')
                                            <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('user.Email')}}" value="agent@gmail.com">
                                        @else
                                            <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('user.Email')}}">
                                        @endif
                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group homec-form-input">
                                        <div class="form-input-label-group">
                                            <label class="ecom-wc__form-label mg-btm-10">{{__('user.Password')}}*</label>
                                            <a class="forget-password" href="{{ route('forget-password') }}">{{__('user.Forget password ?')}}</a>
                                        </div>
                                        <div class="form-group__input">
                                        @if (env('APP_MODE') == 'DEMO')
                                            <input class="ecom-wc__form-input" id="password-field" type="password" name="password" value="1234" placeholder="{{__('user.Password')}}">
                                        @else
                                            <input class="ecom-wc__form-input" id="password-field" type="password" name="password" placeholder="{{__('user.Password')}}">
                                        @endif    
                                        </div>
                                    </div>

                                    @if(!empty($recaptcha_setting) && $recaptcha_setting->status==1)
                                        <div class="form-group homec-form-input">
                                            <div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div>
                                        </div>
                                    @endif

                                    <!-- Form Group -->
                                    <div class="form-group form-mg-top-30">
                                        <div class="ecom-wc__button ecom-wc__button--bottom">
                                            <button class="homec-btn homec-btn__second" type="submit"><span>{{__('user.Login')}}</span></button>

                                            @if (!empty($social_login) && $social_login->is_gmail == 1)
                                                <button id="googleLoginBtn" class="homec-btn homec-btn__second homec-btn__social" type="button"><div class="ntfmax-wc__btn-icon"><img src="{{ asset('frontend/img/google.svg') }}"></div><span>{{__('user.Sign in with Google')}}</span></button>
                                            @endif

                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group mg-top-20">
                                        <div class="ecom-wc__bottom">
                                            <p class="ecom-wc__text">{{__('user.Do not have an account ?')}} <a href="{{ route('register') }}">{{__('user.Create Account')}}</a></p>
                                        </div>
                                    </div>
                                </form>
                                <!-- End Sign in Form -->
                            </div>
                        </div>
                    </div>
					<div class="col-lg-6 col-12 d-none d-lg-block">
                        <div class="ecom-wc__inner homec-bg-cover homec-welcome-bg" style="background-image: url({{ asset($login_page->login_bg_image) }});">
                            <!-- Logo -->
                            <div class="ecom-wc__logo">
                                <a href="{{ route('home') }}"><img src="{{ asset($login_page->login_page_logo) }}" alt="image"></a>
                            </div>
							<div class="ecom-wc__inside">
								<!-- Middle Image -->
								<div class="ecom-wc__middle">
									<a href="{{ route('home') }}"><img src="{{ ($login_page->image)? asset($login_page->image) : asset($setting->default_placeholder)}}" alt="image"></a>
								</div>
								<div class="ecom-wc__footer">
									<ul class="ecom-wc__footer--list list-none">
                                        <li><a href="{{ route('terms-and-conditions') }}">{{__('user.Terms and Conditions')}}</a></li>
                                        <li><a href="{{ route('privacy-policy') }}">{{__('user.Privacy Policy')}}</a></li>
                                        <li><a href="{{ route('contact-us') }}">{{__('user.Contact Us')}}</a></li>
									</ul>
                                    <p class="ecom-wc__footer--text">{{ $footer->copyright }}</p>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Sign In -->

		<!-- Jquery JS -->
		<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
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
                    $("#googleLoginBtn").on("click", function(){
                        window.location.href = "{{ route('login-google') }}";
                    })
                });
            })(jQuery);
        </script>
	</body>
</html>
