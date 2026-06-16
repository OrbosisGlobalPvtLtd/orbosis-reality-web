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
		<meta name="keywords" content="{{__('user.HomeCo || Forget Password')}}">
		<meta name="description" content="{{__('user.HomeCo || Forget Password')}}">
		<meta name="title" content="{{__('user.HomeCo || Forget Password')}}">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Site Title -->
		<title>{{__('user.HomeCo || Forget Password')}}</title>

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

		<!-- End Preloader -->

		<!-- Sign In -->
        <section class="ecom-wc ecom-wc__full ecom-bg-cover">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="ecom-wc__form">
                            <div class="ecom-wc__form-inner">
                                <h3 class="ecom-wc__form-title ecom-wc__form-title__one">{{__('user.Forget Password')}} <span>{{__('user.To get your reset link, fill out the form below')}}</span></h3>
                                <!-- Sign in Form -->
                                <form class="ecom-wc__form-main p-0" action="{{ route('send-forget-password') }}" method="post">
                                    @csrf
                                    <div class="form-group homec-form-input">
                                        <label class="ecom-wc__form-label mg-btm-10">{{__('user.Email')}}*</label>
                                        <div class="form-group__input">
                                            <input class="ecom-wc__form-input" type="email" name="email" placeholder="{{__('user.Email')}}">
                                        </div>
                                    </div>

                                    @if($recaptcha_setting->status==1)
                                        <div class="form-group homec-form-input">
                                            <div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div>
                                        </div>
                                    @endif

                                    <!-- Form Group -->
                                    <div class="form-group form-mg-top-30">
                                        <div class="ecom-wc__button ecom-wc__button--bottom">
                                            <button class="homec-btn homec-btn__second" type="submit"><span>{{__('user.Send Link')}}</span></button>

                                            @if ($social_login->is_gmail == 1)
                                                <button id="googleLoginBtn" class="homec-btn homec-btn__second homec-btn__social" type="button"><div class="ntfmax-wc__btn-icon"><img src="{{ asset('frontend/img/google.svg') }}"></div><span>{{__('user.Sign in with Google')}}</span></button>
                                            @endif

                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group mg-top-20">
                                        <div class="ecom-wc__bottom">
                                            <p class="ecom-wc__text">{{__('user.Go to login page')}} <a href="{{ route('login') }}">{{__('user.Click here')}}</a></p>
                                        </div>
                                    </div>
                                </form>
                                <!-- End Sign in Form -->
                            </div>
                        </div>
                    </div>
					<div class="col-lg-6 col-12 d-none d-lg-block ">
                        <div class="ecom-wc__inner homec-bg-cover homec-welcome-bg" style="background-image: url({{ asset($login_page->login_bg_image) }});">
                            <!-- Logo -->
                            <div class="ecom-wc__logo">
                                <a href="{{ route('home') }}"><img src="{{ asset($login_page->login_page_logo) }}" alt="image"></a>
                            </div>
							<div class="ecom-wc__inside">
								<!-- Middle Image -->
								<div class="ecom-wc__middle">
									<a href="{{ route('home') }}"><img src="{{ ($login_page->image)? asset($login_page->image) : asset($setting->default_placeholder)}}" alt="image"></a>
									<div class="ecom-wc__countdown--title">{{ $login_page->login_top_item_qty }}<span>{{ $login_page->login_top_item }}</span></div>
									<div class="ecom-wc__countdown--title ecom-wc__countdown--title--v2">{{ $login_page->login_footer_item_qty }}<span>{{ $login_page->login_footer_item }}</span></div>
								</div>
								<div class="ecom-wc__footer">
									<ul class="ecom-wc__footer--list list-none">
                                        <li><a href="{{ route('terms-and-conditions') }}">{{__('user.Terms and Conditions')}}</a></li>
                                        <li><a href="{{ route('privacy-policy') }}">{{__('user.Privacy Policy')}}</a></li>
                                        <li><a href="{{ route('contact-us') }}">{{__('user.Contact Us')}}</a></li>
									</ul>

								</div>
								<p class="ecom-wc__footer--text">{{ $footer->copyright }} </p>
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
