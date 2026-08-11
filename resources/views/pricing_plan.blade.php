@extends('layout')

@section('title')
    <title>{{__('user.Pricing Plan')}} - Orbosis Reality</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.Pricing Plan')}}">
    <meta name="description" content="{{__('user.Pricing Plan')}}">
@endsection

@section('frontend-content')

    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }}); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
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

    <!-- Pricing Section -->
    <section class="pd-top-90 pd-btm-120 homec-bg-third-color">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold uppercase" style="letter-spacing: 1px;">Flexible Pricing</span>
                <h2 class="fw-bold text-dark mt-2 mb-3">Choose the Right Plan for Your Real Estate Business</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Every user gets 5 lifetime free property listings. Upgrade anytime for higher quotas and agency features.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ($pricing_plans as $index => $pricing_plan)
                    @php
                        $is_popular = strtolower($pricing_plan->plan_slug) === 'silver';
                        $is_basic = strtolower($pricing_plan->plan_slug) === 'basic';
                    @endphp

                    <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                        <div class="card h-100 border-0 shadow-sm rounded-4 position-relative p-4 d-flex flex-column justify-content-between" style="background: #ffffff; border: {{ $is_popular ? '2px solid #0d6efd' : '1px solid #e2e8f0' }} !important;">
                            
                            @if ($is_popular)
                                <div class="position-absolute top-0 start-50 translate-middle">
                                    <span class="badge bg-primary text-white fw-bold px-3 py-1 rounded-pill shadow-sm" style="font-size: 11px; letter-spacing: 0.5px;">MOST POPULAR</span>
                                </div>
                            @endif

                            <div>
                                <div class="text-center pb-3 border-bottom mb-3">
                                    <h4 class="fw-bold text-dark mb-1">{{ $pricing_plan->plan_name }}</h4>
                                    <div class="my-3">
                                        <span class="fs-2 fw-bold text-primary">₹{{ number_format($pricing_plan->plan_price) }}</span>
                                        <span class="text-muted small">/ {{ $pricing_plan->expired_time == 'lifetime' ? 'lifetime' : 'month' }}</span>
                                    </div>
                                </div>

                                <ul class="list-unstyled mb-4" style="font-size: 14px;">
                                    <li class="py-2 border-bottom d-flex align-items-center">
                                        <i class="fa fa-check-circle text-success me-2 fs-5"></i>
                                        <span>
                                            <strong>{{ $pricing_plan->number_of_property == -1 ? 'Unlimited' : $pricing_plan->number_of_property }}</strong> 
                                            {{ $is_basic ? 'Lifetime Free Listings' : 'Property Listings' }}
                                        </span>
                                    </li>

                                    <li class="py-2 border-bottom d-flex align-items-center">
                                        <i class="fa fa-{{ $pricing_plan->featured_property == 'enable' ? 'check-circle text-success' : 'times-circle text-muted' }} me-2 fs-5"></i>
                                        <span>
                                            @if ($pricing_plan->featured_property == 'enable')
                                                <strong>{{ $pricing_plan->featured_property_qty == -1 ? 'Unlimited' : $pricing_plan->featured_property_qty }}</strong> Featured Listings
                                            @else
                                                <span class="text-muted">Featured Listings Unavailable</span>
                                            @endif
                                        </span>
                                    </li>

                                    <li class="py-2 border-bottom d-flex align-items-center">
                                        <i class="fa fa-{{ $pricing_plan->top_property == 'enable' ? 'check-circle text-success' : 'times-circle text-muted' }} me-2 fs-5"></i>
                                        <span>
                                            @if ($pricing_plan->top_property == 'enable')
                                                <strong>{{ $pricing_plan->top_property_qty == -1 ? 'Unlimited' : $pricing_plan->top_property_qty }}</strong> Top Listings
                                            @else
                                                <span class="text-muted">Top Listings Unavailable</span>
                                            @endif
                                        </span>
                                    </li>

                                    <li class="py-2 border-bottom d-flex align-items-center">
                                        <i class="fa fa-{{ $pricing_plan->urgent_property == 'enable' ? 'check-circle text-success' : 'times-circle text-muted' }} me-2 fs-5"></i>
                                        <span>
                                            @if ($pricing_plan->urgent_property == 'enable')
                                                <strong>{{ $pricing_plan->urgent_property_qty == -1 ? 'Unlimited' : $pricing_plan->urgent_property_qty }}</strong> Urgent Listings
                                            @else
                                                <span class="text-muted">Urgent Listings Unavailable</span>
                                            @endif
                                        </span>
                                    </li>

                                    <li class="py-2 border-bottom d-flex align-items-center">
                                        <i class="fa fa-{{ $pricing_plan->max_agent_add > 0 ? 'check-circle text-success' : 'times-circle text-muted' }} me-2 fs-5"></i>
                                        <span>
                                            @if ($pricing_plan->max_agent_add > 0)
                                                Agency & <strong>{{ $pricing_plan->max_agent_add }}</strong> Sub-Agents
                                            @else
                                                <span class="text-muted">Single Agent Profile</span>
                                            @endif
                                        </span>
                                    </li>

                                    <li class="py-2 border-bottom d-flex align-items-center">
                                        <i class="fa fa-check-circle text-success me-2 fs-5"></i>
                                        <span>Amenities & Location Info</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="mt-auto">
                                @if ($pricing_plan->plan_price == 0 || $pricing_plan->plan_type == 'free')
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary w-100 rounded-pill fw-bold py-2">
                                        Current Plan (Free)
                                    </a>
                                @else
                                    <a href="{{ route('payment', $pricing_plan->plan_slug) }}" class="btn btn-{{ $is_popular ? 'primary' : 'dark' }} w-100 rounded-pill fw-bold py-2 shadow-sm">
                                        Upgrade to {{ $pricing_plan->plan_name }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Area -->
    <section class="homec-bg-cover pd-top-90 pd-btm-120 homec-faq-bg">
        <div class="container homec-container-medium">
            <div class="row homec-container-medium__row align-items-center">
                <div class="col-lg-6 col-12 mg-top-30" data-aos="fade-up">
                    <div class="homec-section__head">
                        <div class="homec-section__shape">
                            <span class="homec-section__badge homec-section__badge--shape homec-section__badge--shape--v2">{{ $faq->content->short_title ?? 'FAQ' }}</span>
                        </div>
                        <h2 class="homec-section__title">{{ $faq->content->long_title ?? 'Frequently Asked Questions' }}</h2>
                    </div>
                    <div class="homec-accordion accordion accordion-flush" id="homec-accordion">
                        @foreach ($faq->faqs as $faq_index => $faq_item)
                            <div class="accordion-item homec-accordion__single mg-top-30 {{ $faq_index == 0 ? 'active' : '' }}">
                                <h2 class="accordion-header" id="homect-1-{{ $faq_index }}">
                                    <button class="accordion-button collapsed homec-accordion__heading" type="button" data-bs-toggle="collapse" data-bs-target="#ac-collapse1-{{ $faq_index }}">{{ $faq_item->question }}</button>
                                </h2>
                                <div id="ac-collapse1-{{ $faq_index }}" class="accordion-collapse collapse {{ $faq_index == 0 ? 'show' : '' }}" data-bs-parent="#homec-accordion">
                                    <div class="accordion-body homec-accordion__body">{!! nl2br($faq_item->answer) !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mg-top-30 d-none-tab" data-aos="fade-up">
                    <div class="homec-support-img">
                        <img src="{{ ($faq->content->support_image)? asset($faq->content->support_image) : asset($setting->default_placeholder)}}" alt="support_image">
                        <div class="homec-support-img__content">
                            <img src="{{ asset('frontend/img/support-icon-white.svg') }}" alt="support_image">
                            <h4 class="homec-support-img__title">{{ $faq->content->support_time ?? '24/7' }} <span>{{ $faq->content->support_title ?? 'Support' }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
