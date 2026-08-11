@extends('layout')
@section('title')
    <title>{{__('user.Pricing Plan')}}</title>
@endsection
@section('meta')
    <meta name="title" content="{{__('user.Pricing Plan')}}">
    <meta name="description" content="{{__('user.Pricing Plan')}}">
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
                            <li class="active"><a href="{{ route('pricing-plan') }}">{{__('user.Pricing Plan')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Pricing Plan')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->


    <!-- Pricing -->
    <section class="pd-top-90 pd-btm-120 homec-bg-third-color">
        <div class="container">
            <div class="row">
                @foreach ($pricing_plans as $index => $pricing_plan)
                    <div class="col-lg-4 col-md-4 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                        <!-- Pricing Single -->
                        <div class="homec-psingle {{ ++$index % 2 == 0 ? 'homec-psingle__active' : '' }} ">
                            <div class="homec-psingle__head">
                                <h4 class="homec-psingle__title">{{ $pricing_plan->plan_name }}</h4>
                                <div class="homec-psingle__amount">
                                    <span class="homec-psingle__currency"></span>{{ num_format($pricing_plan->plan_price) }}<span>/
                                        @if ($pricing_plan->expired_time == 'monthly')
                                        {{__('user.Monthly')}}
                                        @elseif ($pricing_plan->expired_time == 'yearly')
                                        {{__('user.Yearly')}}
                                        @elseif ($pricing_plan->expired_time == 'lifetime')
                                        {{__('user.Lifetime')}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="homec-psingle__body">
                                <ul class="homec-psingle__list">

                                    @if ($pricing_plan->max_agent_add > 0)
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Agency Profile')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Agency Profile')}}</li>
                                    @endif

                                    <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan->max_agent_add }} {{__('user.Agent')}}</li>

                                    @if ($pricing_plan->number_of_property == -1)
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Property Submission')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan->number_of_property }} {{__('user.Property Submission')}}</li>
                                    @endif

                                    @if ($pricing_plan->featured_property == 'enable')
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Featured Property')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Featured Property')}}</li>
                                    @endif

                                    @if ($pricing_plan->featured_property_qty == -1)
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Featured Property')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan->featured_property_qty }} {{__('user.Featured Property')}}</li>
                                    @endif

                                    @if ($pricing_plan->top_property == 'enable')
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Top Property')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Top Property')}}</li>
                                    @endif

                                    @if ($pricing_plan->top_property_qty == -1)
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Top Property')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan->top_property_qty }} {{__('user.Top Property')}}</li>
                                    @endif

                                    @if ($pricing_plan->urgent_property == 'enable')
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Urgent Property')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Urgent Property')}}</li>
                                    @endif

                                    @if ($pricing_plan->urgent_property_qty == -1)
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Urgent Property')}}</li>
                                    @else
                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan->urgent_property_qty }} {{__('user.Urgent Property')}}</li>
                                    @endif

                                    <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Aminities')}}</li>

                                    <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Nearest Location')}}</li>

                                </ul>
                                <div class="homec-psingle__button">
                                    @if ($pricing_plan->plan_type == 'free')
                                    <a href="{{ route('free-enroll', $pricing_plan->plan_slug) }}" class="homec-btn homec-btn__thrid"><span>{{__('user.Trail Now')}}</span></a>
                                    @else
                                    <a href="{{ route('payment', $pricing_plan->plan_slug) }}" class="homec-btn homec-btn__thrid"><span>{{__('user.Enroll Now')}}</span></a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!-- End Pricing Single -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Priicng -->


    <!-- Faq Area -->
    <section class="homec-bg-cover pd-top-90 pd-btm-120 homec-faq-bg" >
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
