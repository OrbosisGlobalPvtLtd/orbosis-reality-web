@extends('layout')

@section('title')
    <title>{{ $seo_setting->seo_title }}</title>
@endsection

@section('meta')
<meta name="title" content="{{ $seo_setting->seo_title }}">
    <meta name="description" content="{{ $seo_setting->seo_description }}">
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
                            <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            <li class="active"><a href="{{ route('about-us') }}">{{__('user.About Us')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.About Us')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->


    <!-- About Area -->
    <section class="homec-about homec-bg-third-color pd-top-90 pd-btm-120">
        <div class="homec-shape">
            <div class="homec-shape-single homec-shape-1"><img src="{{ asset('frontend/img/anim-shape-1.svg') }}" alt="shape"></div>
            <div class="homec-shape-single homec-shape-2"><img src="{{ asset('frontend/img/anim-shape-2.svg') }}" alt="shape"></div>
            <div class="homec-shape-single homec-shape-3"><img src="{{ asset('frontend/img/anim-shape-3.svg') }}" alt="shape"></div>
            <div class="homec-shape-single homec-shape-4"><img src="{{ asset('frontend/img/anim-shape-1.svg') }}" alt="shape"></div>
            <div class="homec-shape-single homec-shape-5"><img src="{{ asset('frontend/img/anim-shape-2.svg') }}" alt="shape"></div>
            <div class="homec-shape-single homec-shape-6"><img src="{{ asset('frontend/img/anim-shape-3.svg') }}" alt="shape"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 offset-lg-0 col-md-10 offset-md-1 col-12 mg-top-30" data-aos="fade-right" data-aos-delay="400">
                    <!-- Homec Image Group -->
                    <div class="homec-image-group homec-image-group--v2">
                        <div class="homec-image-group__main">
                            <img src="{{ asset($about_us->background_image) }}" alt="background_image">
                            <div class="homec-experiences">
                                <h4 class="homec-experiences__title">{{ $about_us->experience_text_1 }} <span>{{ $about_us->experience_text_2 }}</span></h4>
                            </div>
                        </div>
                        <div class="homec-ceo-quote">
                            <div class="homec-ceo-quote__img">
                                <div class="homec-overlay"></div>
                                <img src="{{ ($about_us->author_image)? asset($about_us->author_image) : asset($setting->default_placeholder)}}" alt="author_image">
                            </div>
                            <h4 class="homec-ceo-quote__title">{{ $about_us->author_name }}<span>{{ $about_us->author_designation }}</span></h4>
                        </div>
                    </div>
                    <!-- End Homec Image Group -->
                </div>
                <div class="col-lg-6 col-12 mg-top-30">
                    <div class="homec-about-content homec-about-content--v2">
                        <!-- Section Title -->
                        <div class="homec-section__head">
                            <div class="homec-section__shape">
                                <span class="homec-section__badge homec-section__badge--shape" data-aos="fade-down" data-aos-delay="300">{{ $about_us->short_title }}</span>
                            </div>
                            <h2 class="homec-section__title" data-aos="fade-in" data-aos-delay="400">{{ $about_us->long_title }}</h2>
                        </div>
                        <div class="homec-about-content__inner mg-top-20" data-aos="fade-in" data-aos-delay="500">
                            <p class="homec-about-content__text">{{ $about_us->description_1 }}</p>
                            <div class="homec-focus-content homec-focus-content--v2 homec-border mg-top-20">
                                <p>{{ $about_us->description_2 }}</p>
                            </div>
                            <div class="homec-dflex-space">
                                <div class="homec-funfact__single homec-funfact__single--v2">
                                    <div class="homec-funfact__icon">
                                        <img src="{{ $about_us->item1->icon }}" alt="icon">
                                    </div>
                                    <h3 class="homec-funfact__number"><span class="counter">{{ $about_us->item1->title }}</span>{{ $about_us->item1->title2 }}</h3>
                                    <p class="homec-funfact__text">{{ $about_us->item1->description }}</p>
                                </div>
                                <div class="homec-funfact__single homec-funfact__single--v2">
                                    <div class="homec-funfact__icon">
                                        <img src="{{ $about_us->item2->icon }}" alt="icon">
                                    </div>
                                    <h3 class="homec-funfact__number"><span class="counter">{{ $about_us->item1->title }}</span>{{ $about_us->item1->title2 }}</h3>
                                    <p class="homec-funfact__text">{{ $about_us->item1->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    @php
        $property_types = $category->property_types;
    @endphp

    <!-- Features Area -->
    <section class="homec-features pd-top-90 pd-btm-120">
        <div class="container">
            <div class="row">
                @foreach ($property_types as $property_type)
                <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                    <!-- Single Feature -->
                    <a href="{{ route('properties', ['type' => $property_type->slug]) }}" class="homec-features__single">
                        <div class="homec-features__icon">
                            <img src="{{ asset($property_type->icon) }}" alt="icon">
                        </div>
                        <div class="homec-features__content">
                            <h3 class="homec-features__title">{{ $property_type->name }}</h3>
                            <p class="homec-features__text">{{ $property_type->totalProperty }}+ {{__('user.Property')}}</p>
                        </div>
                    </a>
                    <!-- End Single Feature -->
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Features Area -->

    @php
        $counter_content = $counter->content;
    @endphp
    <!-- FunFacts -->
    <section class="homec-funfacts pd-btm-100">
        <img src="{{ asset($counter_content->bg_image) }}" alt="bg_image">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="homec-funfact homec-border homec-funfact--bg">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-12">
                                <div class="homec-funfact__inner">
                                    <div class="homec-funfact__content"  data-aos="fade-up" data-aos-delay="300">
                                        <h2 class="homec-section__title mg-btm-10">{{ $counter_content->title }}</h2>
                                        <p>{{ $counter_content->description }}</p>
                                    </div>
                                    <!-- Homec List -->
                                    <ul class="homec-iconic-list list-none mg-top-30"  data-aos="fade-up" data-aos-delay="400">
                                        <li><i class="fa-solid fa-check"></i>{{ $counter_content->list_1 }}</li>
                                        <li><i class="fa-solid fa-check"></i>{{ $counter_content->list_2 }}</li>
                                        <li><i class="fa-solid fa-check"></i>{{ $counter_content->list_3 }}</li>
                                    </ul>
                                    <!-- Homec Button -->
                                    <div class="homec-btn__main mg-top-40"  data-aos="fade-up" data-aos-delay="500">
                                        <a href="{{ route('contact-us') }}" class="homec-btn"><span>{{__('user.Contact Us')}}</span></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-7 col-12">
                                <div class="homec-funfacts">
                                    <div class="row">
                                        @foreach ($counter->items as $counter_item)
                                            <div class="col-lg-6 col-md-6 col-12"  data-aos="fade-in" data-aos-delay="400">
                                                <!-- FunFacts Single -->
                                                <div class="homec-funfact__single homec-border">
                                                    <div class="homec-funfact__icon">
                                                        <img src="{{ asset($counter_item->icon) }}" alt="icon">
                                                    </div>
                                                    <h3 class="homec-funfact__number"><span class="counter">{{ $counter_item->number }}</span></h3>
                                                    <p class="homec-funfact__text">{{ $counter_item->title }}</p>
                                                </div>
                                                <!-- End FunFacts Single -->
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End FunFacts Area -->

    <!-- Agents -->
    <section class="homec-bg-third-color homec-bg-cover pd-top-90 pd-btm-120" style="background-image: url({{ asset($agent->home2_agent_bg) }});">
        <div class="homec-overlay"></div>
        <div class="section-inside-bg homec-agent-inside"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="homec-flex homec-flex__section mg-btm-60">
                        <div class="homec-section__head section-white homec-section__head__half m-0 mg-top-30">
                            <span class="homec-section__badge homec-second-color homec-section__badge--small m-0"  data-aos="fade-in" data-aos-delay="300">{{ $agent->title }}</span>
                            <h2 class="homec-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $agent->description }}</h2>
                        </div>
                        <div class="homec-section__btn mg-top-30" data-aos="fade-right" data-aos-delay="500">
                            <a href="{{ route('agents') }}" class="homec-btn"><span>{{__('user.See All Agents')}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swiper mySwiper homec-slider-agent loading">
                        <div class="swiper-wrapper">
                            @foreach ($agent->agents as $agent_index => $single_agent )
                                <div class="swiper-slide">
                                    <!-- Single agent-->
                                    <div class="homec-agent">
                                        <!-- Agent Head-->
                                        <div class="homec-agent__head">
                                            @if ($single_agent->image)
                                            <img src="{{ asset($single_agent->image) }}" alt="agent">
                                            @else
                                            <img src="{{ asset($default_user_avatar) }}" alt="agent">
                                            @endif
                                            <ul class="homec-agent__social list-none">
                                                @if ($single_agent->linkedin)
                                                    <li><a href="{{ $single_agent->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                                @endif

                                                @if ($single_agent->twitter)
                                                <li><a href="{{ $single_agent->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                                @endif

                                                @if ($single_agent->instagram)
                                                <li><a href="{{ $single_agent->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                                @endif

                                                @if ($single_agent->facebook)
                                                <li><a href="{{ $single_agent->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- Agent Body -->
                                        <div class="homec-agent__body">
                                            <h4 class="homec-agent__title"><a href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => $single_agent->user_name]) }}">{{ $single_agent->name }}<span>{{ $single_agent->designation }}</span></a></h4>
                                        </div>
                                        <!-- End Agent Body -->
                                    </div>
                                    <!-- End Single agent-->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Slider Pagination -->
                    <div class="swiper-pagination swiper-pagination__start swiper-pagination--white  swiper-pagination__agent"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Agents -->

    <!-- Faq Area -->
    <section class="homec-bg-cover pd-top-90 pd-btm-120 homec-faq-bg">
        <div class="container homec-container-medium">
            <div class="row homec-container-medium__row align-items-center">
                <div class="col-lg-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                    <div class="homec-section__head">
                        <div class="homec-section__shape">
                            <span class="homec-section__badge homec-section__badge--shape homec-section__badge--shape--v2">{{ $faq->content->short_title }}</span>
                        </div>
                        <h2 class="homec-section__title">{{ $faq->content->long_title }}</h2>
                    </div>
                    <div class="homec-accordion accordion accordion-flush" id="homec-accordion">

                        @foreach ($faq->faqs as $faq_index => $faq_item )

                        <!-- End Single Accordion -->
                        <div class="accordion-item homec-accordion__single mg-top-30 {{ $faq_index == 0 ? 'active' : '' }}">
                            <h2 class="accordion-header" id="homect-1-{{ $faq_index }}">
                                <button class="accordion-button collapsed homec-accordion__heading" type="button" data-bs-toggle="collapse" data-bs-target="#ac-collapse1-{{ $faq_index }}">{{ $faq_item->question }}</button>
                            </h2>
                            <div id="ac-collapse1-{{ $faq_index }}" class="accordion-collapse collapse {{ $faq_index == 0 ? 'show' : '' }}"  data-bs-parent="#homec-accordion">
                                <div class="accordion-body homec-accordion__body">{!! nl2br($faq_item->answer) !!}</div>
                            </div>
                        </div>
                        <!-- End Single Accordion -->
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mg-top-30 d-none-tab" data-aos="fade-up" data-aos-delay="600">
                    <!-- Support Img -->
                    <div class="homec-support-img">
                        <img src="{{ ($faq->content->support_image)? asset($faq->content->support_image) : asset($setting->default_placeholder)}}" alt="support_image">
                        <div class="homec-support-img__content">
                            <img src="{{ asset('frontend/img/support-icon-white.svg') }}" alt="support_image">
                            <h4 class="homec-support-img__title">{{ $faq->content->support_time }} <span>{{ $faq->content->support_title }}</span>
                            </h4>
                        </div>
                    </div>
                    <!-- End Support Img -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Faq Area -->

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
