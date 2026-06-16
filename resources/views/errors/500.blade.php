@php
    $error_404=App\Models\ErrorPage::find(1);

    $mobile_app = (object) array(
        'app_bg' => $setting->app_bg,
        'full_title' => $setting->app_full_title,
        'description' => $setting->app_description,
        'play_store' => $setting->google_playstore_link,
        'app_store' => $setting->app_store_link,
        'image' => $setting->app_image,
        'apple_btn_text1' => $setting->apple_btn_text1,
        'apple_btn_text2' => $setting->apple_btn_text2,
        'google_btn_text1' => $setting->google_btn_text1,
        'google_btn_text2' => $setting->google_btn_text2,
    );

@endphp

@extends('layout')
@section('title')
    <title>{{ $error_404->page_name }}</title>
@endsection
@section('meta')
<title>{{ $error_404->page_name }}</title>
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
                        <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                        <li class="active"><a href="javascript:;">{{ $error_404->page_name }}</a></li>
                    </ul>
                    <h2 class="breadcrumb__title m-0">{{ $error_404->page_name }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<!-- Error Page -->
<section class="homec-error section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="homec-error-inner">
                    <!-- Eror Content Image -->
                    <div class="homec-error-inner__img">
                        <img src="{{ asset($error_404->image) }}" alt="#">
                    </div>
                    <h1 class="homec-error-inner__title">{{ $error_404->header }}</h1>
                    <div class="homec-error-inner__button">
                        <a href="{{ route('home') }}" class="homec-btn"><span>{{ $error_404->button_text }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Error Page -->


<!-- Download App -->
<section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15" style="background-image:url({{ asset($mobile_app->app_bg) }})">
    <div class="homec-shape">
        <div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
        <div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
        <div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="download-app__middle">
                    <div class="download-app__content">
                        <div class="homec-section__head section-white mg-btm-30" data-aos="fade-up" data-aos-delay="400">
                            <h2 class="homec-section__title">{{ $mobile_app->full_title }}</h2>
                            <p class="sec-head__text">{{ $mobile_app->description }}</p>
                        </div>
                        <!-- App Download Button -->
                        <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                            <a href="{{ $mobile_app->app_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                <div class="homec-btn__inside">
                                    <i class="fa-brands fa-apple"></i>
                                    <div class="btn-content"><span>{{ $mobile_app->apple_btn_text1 }}</span><p>{{ $mobile_app->apple_btn_text2 }}</p></div>
                                </div>
                            </a>
                            <a href="{{ $mobile_app->play_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                <div class="homec-btn__inside">
                                    <i class="fa-brands fa-google-play"></i>
                                    <div class="btn-content"><span>{{ $mobile_app->google_btn_text1 }}</span><p>{{ $mobile_app->google_btn_text2 }}</p></div>
                                </div>
                            </a>
                        </div>
                        <!-- End App Download Button -->
                    </div>
                    <!-- Download Image -->
                    <div class="download-app__img" data-aos="fade-up" data-aos-delay="700">
                        <img src="{{ ($mobile_app->image)? asset($mobile_app->image) : asset($setting->default_placeholder)}}" alt="mobile_app">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Download App -->

@endsection
