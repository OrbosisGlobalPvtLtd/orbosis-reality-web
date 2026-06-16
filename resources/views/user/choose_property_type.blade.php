@extends('layout')

@section('title')
    <title>{{__('user.Dashboard')}}</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.Dashboard')}}">
    <meta name="description" content="{{__('user.Dashboard')}}">
@endsection

@section('frontend-content')
    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            <li class="active"><a href="{{ route('user.dashboard') }}">{{__('user.Dashboard')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Dashboard')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->


    <!-- Property Section -->
    <section class="homec-error pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row">

                <!-- Rent Property -->
                <div class="col-lg-4 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                    <div class="homec-add-property homec-bg-third-color homec-border">
                        <div class="homec-add-property__img">
                            <img src="{{ asset($property_content->rent_logo) }}">
                        </div>
                        <div class="homec-add-property__content">
                            <h3 class="homec-add-property__title">{{ $property_content->rent_title }}</h3>
                            <p class="homec-add-property__text">{{ $property_content->rent_description }}</p>
                            <div class="homec-add-property__button">
                                <a href="{{ route('user.property.create',['purpose' => 'rent']) }}" class="homec-btn">
                                    <span>{{ $property_content->rent_btn_text }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sale Property -->
                <div class="col-lg-4 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="600">
                    <div class="homec-add-property homec-bg-third-color homec-border">
                        <div class="homec-add-property__img homec-add-property__img--sale">
                            <img src="{{ asset($property_content->sale_logo) }}">
                        </div>
                        <div class="homec-add-property__content">
                            <h3 class="homec-add-property__title">{{ $property_content->sale_title }}</h3>
                            <p class="homec-add-property__text">{{ $property_content->sale_description }}</p>
                            <div class="homec-add-property__button">
                                <a href="{{ route('user.property.create',['purpose' => 'sale']) }}" class="homec-btn">
                                    <span>{{ $property_content->sale_btn_text }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buy Property (NEW SECTION ADDED) -->
                <div class="col-lg-4 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="800">
                    <div class="homec-add-property homec-bg-third-color homec-border">
                        <div class="homec-add-property__img homec-add-property__img--sale">
                            <img src="https://orbosisreality.com/uploads/website-images/property-buy-sell-concept-18674444.webp">
                        </div>
                        <div class="homec-add-property__content">
                            <h3 class="homec-add-property__title">
                                {{ $property_content->buy_title ?? 'Add Property for Buy' }}
                            </h3>
                            <p class="homec-add-property__text">
                                {{ $property_content->buy_description ?? 'Are you looking for clients for your property ? Please submit the property form and collect your best client.' }}
                            </p>
                            <div class="homec-add-property__button">
                                <a href="{{ route('user.property.create',['purpose' => 'buy']) }}" class="homec-btn">
                                    <span>{{ $property_content->buy_btn_text ?? 'Add Buy Property' }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Buy Property -->

            </div>
        </div>
    </section>
    <!-- End Property Section -->


    <!-- Download App -->
    <section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15"
        style="background-image:url({{ asset($mobile_app->app_bg) }})">
        
        <div class="homec-shape">
            <div class="homec-shape-single homec-shape-11">
                <img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg">
            </div>
            <div class="homec-shape-single homec-shape-12">
                <img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg">
            </div>
            <div class="homec-shape-single homec-shape-13">
                <img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="bg">
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="download-app__middle">
                        <div class="download-app__content">
                            <div class="homec-section__head section-white mg-btm-30">
                                <h2 class="homec-section__title">{{ $mobile_app->full_title }}</h2>
                                <p class="sec-head__text">{{ $mobile_app->description }}</p>
                            </div>

                            <div class="download__app-button">
                                <a href="{{ $mobile_app->app_store }}"
                                   class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-apple"></i>
                                        <div class="btn-content">
                                            <span>{{ $mobile_app->apple_btn_text1 }}</span>
                                            <p>{{ $mobile_app->apple_btn_text2 }}</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ $mobile_app->play_store }}"
                                   class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <i class="fa-brands fa-google-play"></i>
                                        <div class="btn-content">
                                            <span>{{ $mobile_app->google_btn_text1 }}</span>
                                            <p>{{ $mobile_app->google_btn_text2 }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="download-app__img">
                            <img src="{{ ($mobile_app->image) ? asset($mobile_app->image) : asset($setting->default_placeholder) }}"
                                alt="mobile_app">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Download App -->

@endsection