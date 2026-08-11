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
        <div class="homec-overlay"></div>
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{ __('user.Home') }}</a></li>
                            <li class="active"><a href="{{ route('agents') }}">{{ __('user.Our Agents and Agencies') }}</a>
                            </li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{ __('user.Our Agents and Agencies') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <style>
        /* Filter Bar Card */
        .agent_agency_btn {
            background: #ffffff !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
            padding: 20px 28px !important;
            border: 1px solid #e2e8f0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            flex-wrap: wrap !important;
            gap: 20px !important;
            margin-bottom: 40px !important;
        }

        .agent_agency_btn .nav-pills {
            margin-bottom: 0 !important;
            gap: 12px !important;
        }

        .agent_agency_btn .nav-pills .nav-link {
            border-radius: 10px !important;
            padding: 12px 26px !important;
            font-weight: 600 !important;
            font-size: 15px !important;
            line-height: normal !important;
            height: auto !important;
            color: #475569 !important;
            background-color: #f1f5f9 !important;
            border: 1px solid transparent !important;
            transition: all 0.3s ease !important;
        }

        .agent_agency_btn .nav-pills .nav-link.active {
            background-color: #0052cc !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(0, 82, 204, 0.3) !important;
        }

        .homec-form__form--bar {
            display: flex !important;
            align-items: center !important;
            background: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 12px !important;
            padding: 5px 5px 5px 16px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04) !important;
            transition: all 0.3s ease !important;
            gap: 10px !important;
            min-width: 360px !important;
            margin: 0 !important;
        }

        .homec-form__form--bar:focus-within {
            border-color: #0052cc !important;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.12) !important;
        }

        .homec-form__form--bar input {
            height: 40px !important;
            padding: 0 !important;
            border: none !important;
            font-size: 14px !important;
            color: #1e293b !important;
            background: transparent !important;
            flex-grow: 1 !important;
            outline: none !important;
            box-shadow: none !important;
            min-width: 0 !important;
        }

        .homec-form__form--bar input::placeholder {
            color: #94a3b8 !important;
        }

        .homec-form__form--bar .homec-btn,
        .homec-form__form--bar button[type="submit"] {
            height: 42px !important;
            padding: 0 22px !important;
            border-radius: 9px !important;
            background: #0052cc !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            border: none !important;
            cursor: pointer !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            white-space: nowrap !important;
            line-height: 1 !important;
            transition: all 0.3s ease !important;
            position: static !important;
            box-shadow: 0 2px 6px rgba(0, 82, 204, 0.25) !important;
            flex-shrink: 0 !important;
        }

        .homec-form__form--bar .homec-btn::before,
        .homec-form__form--bar .homec-btn::after,
        .homec-form__form--bar button[type="submit"]::before,
        .homec-form__form--bar button[type="submit"]::after {
            display: none !important;
        }

        .homec-form__form--bar .homec-btn:hover,
        .homec-form__form--bar button[type="submit"]:hover {
            background: #0040a8 !important;
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.35) !important;
            transform: translateY(-1px) !important;
        }

        .homec-form__form--bar .homec-btn i,
        .homec-form__form--bar button[type="submit"] i {
            font-size: 14px !important;
            margin: 0 !important;
            display: inline-block !important;
            position: static !important;
            vertical-align: middle !important;
        }

        .homec-form__form--bar .homec-btn span,
        .homec-form__form--bar button[type="submit"] span {
            display: inline-block !important;
            position: static !important;
            line-height: 1 !important;
            vertical-align: middle !important;
        }

        /* Agency & Agent Card Improvements */
        .homec-agent__grid {
            background: #ffffff !important;
            border-radius: 16px !important;
            border: 1px solid #e2e8f0 !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04) !important;
            height: calc(100% - 30px) !important;
            display: flex !important;
            flex-direction: column !important;
        }

        .homec-agent__grid:hover {
            transform: translateY(-6px) !important;
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.1) !important;
            border-color: #0052cc !important;
        }

        .homec-agent__grid .homec-agent__head {
            height: 200px !important;
            background: #f8fafc !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 20px !important;
            position: relative !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .homec-agent__grid .homec-agent__head img {
            max-height: 140px !important;
            max-width: 100% !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain !important;
            transition: transform 0.3s ease !important;
        }

        .homec-agent__grid:hover .homec-agent__head img {
            transform: scale(1.05) !important;
        }

        .homec-agent__grid .homec-agent__body {
            padding: 20px !important;
            text-align: center !important;
            flex-grow: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
        }

        .homec-agent__grid .homec-agent__title a {
            color: #0f172a !important;
            font-size: 18px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }

        .homec-agent__grid .homec-agent__title a:hover {
            color: #0052cc !important;
        }

        .homec-agent__grid .homec-agent__title span {
            display: block !important;
            color: #64748b !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            margin-top: 6px !important;
        }

        /* FAQ Section Full Width Styling */
        .homec-faq-bg {
            background-color: #f8fafc !important;
            padding: 80px 0 !important;
        }

        .homec-accordion {
            width: 100% !important;
        }

        .homec-accordion__single {
            background: #ffffff !important;
            border-radius: 14px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03) !important;
            margin-top: 16px !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        .homec-accordion__single.active,
        .homec-accordion__single:hover {
            border-color: #0052cc !important;
            box-shadow: 0 8px 25px rgba(0, 82, 204, 0.08) !important;
        }

        .homec-accordion__heading {
            font-size: 17px !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            padding: 20px 24px !important;
            background: #ffffff !important;
            box-shadow: none !important;
            width: 100% !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            border: none !important;
        }

        .homec-accordion__heading:not(.collapsed) {
            color: #0052cc !important;
            background: #f1f5f9 !important;
        }

        .homec-accordion__body {
            padding: 20px 24px !important;
            font-size: 15px !important;
            line-height: 1.7 !important;
            color: #475569 !important;
            background: #ffffff !important;
            border-top: 1px solid #f1f5f9 !important;
        }

        /* App Download Section Styling */
        .homec-btn__download {
            display: inline-flex !important;
            align-items: center !important;
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
            backdrop-filter: blur(10px) !important;
            padding: 12px 24px !important;
            border-radius: 12px !important;
            color: #ffffff !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
        }

        .homec-btn__download:hover {
            background: #ffffff !important;
            color: #0f172a !important;
            border-color: #ffffff !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important;
        }

        .homec-btn__download:hover .btn-content span,
        .homec-btn__download:hover .btn-content p {
            color: #0f172a !important;
        }

        .homec-btn__download:hover svg {
            fill: #0f172a !important;
        }

        .homec-btn__inside {
            display: flex !important;
            align-items: center !important;
            gap: 14px !important;
        }

        .homec-btn__inside svg {
            width: 28px !important;
            height: 28px !important;
            fill: #ffffff !important;
            flex-shrink: 0 !important;
            transition: fill 0.3s ease !important;
        }

        .btn-content span {
            font-size: 11px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            opacity: 0.85 !important;
            display: block !important;
        }

        .btn-content p {
            font-size: 15px !important;
            font-weight: 700 !important;
            margin: 0 !important;
            line-height: 1.2 !important;
        }
        /* Fix: Tab pane hidden content space fix */
        .tab-pane {
            overflow: hidden !important;
        }

        .tab-pane:not(.show):not(.active) {
            display: none !important;
            height: 0 !important;
            overflow: hidden !important;
            visibility: hidden !important;
        }

        /* Fix: Remove any accidental shape/circle elements in agency section */
        #pills-tabContent .homec-shape,
        #pills-tabContent canvas,
        #pills-tabContent svg:not([class]) {
            display: none !important;
        }

        /* Remove extra bottom space in section */
        #pills-tabContent {
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }
    </style>


    <!-- Agents -->
    <section class="pd-top-70 pd-btm-50" style="overflow: hidden; position: relative;">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="agent_agency_btn homec-property-bar">
                        <div class="homec-property-bar__single">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true"><i class="fas fa-building me-2"></i> {{ __('user.Agency/Team') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false"><i class="fas fa-user me-2"></i> {{ __('user.Single Agents') }}</button>
                                </li>
                            </ul>
                        </div>
                        <div class="homec-property-bar__single">
                            <form class="homec-form__form homec-form__form--bar" action="{{ route('agencies') }}">

                                <input type="text" name="search" value="{{ Request()->get('search') }}" placeholder="Search Agency/Agent...">
                                <button type="submit" class="homec-btn"><i class="fas fa-search me-2"></i><span>{{ __('user.Search Now') }}</span></button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div class="row">
                        @forelse ($agencies as $agency)
                            @php
                                $agency_logo = null;
                                if (!empty($agency?->profile?->image)) {
                                    $agency_logo = asset($agency->profile->image);
                                } elseif (!empty($agency->company_logo)) {
                                    $agency_logo = asset($agency->company_logo);
                                } else {
                                    $agency_logo = asset($setting->default_placeholder);
                                }
                                $company_name = $agency?->profile?->company_name ?? $agency->company_name ?? 'Agency Partner';
                                $tag_line = $agency?->profile?->tag_line ?? $agency->address ?? 'Channel Partner / Agency';
                            @endphp
                            <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="400">
                                <!-- Single agency-->
                                <div class="homec-agent homec-agent__grid homec-border mg-top-30">
                                    <!-- agency Head-->
                                    <div class="homec-agent__head">
                                        <img src="{{ $agency_logo }}" alt="{{ $company_name }}">
                                    </div>
                                    <!-- Agent Body -->
                                    <div class="homec-agent__body">
                                        <h4 class="homec-agent__title">
                                            <a href="{{ route('agency-details', ['id' => $agency->id]) }}">
                                                {{ $company_name }}
                                            </a>
                                            <span>
                                                {{ $tag_line }}
                                            </span>
                                        </h4>
                                    </div>
                                    <!-- End agency Body -->
                                </div>
                                <!-- End Single agency-->
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="p-4 bg-white rounded-4 shadow-sm d-inline-block text-center my-4" style="max-width: 450px;">
                                    <i class="fas fa-building fa-3x text-primary mb-3"></i>
                                    <h5 class="fw-bold text-dark mb-2">No Agencies Found</h5>
                                    <p class="text-muted fs-6 mb-0">We couldn't find any agencies matching your search criteria.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="row mt-3">
                        {{ $agencies->links('custom_pagination') }}
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        @forelse ($agents as $single_agent)
                            <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="400">
                                <!-- Single agent-->
                                <div class="homec-agent homec-agent__grid homec-border mg-top-30">
                                    <!-- Agent Head-->
                                    <div class="homec-agent__head">
                                        @if ($single_agent->image)
                                            <img src="{{ asset($single_agent->image) }}" alt="agent">
                                        @else
                                            <img src="{{ asset($default_user_avatar) }}" alt="agent">
                                        @endif
                                        <ul class="homec-agent__social list-none">
                                            @if ($single_agent->linkedin)
                                                <li><a href="{{ html_decode($single_agent->linkedin) }}"><i
                                                            class="fab fa-linkedin-in"></i></a></li>
                                            @endif

                                            @if ($single_agent->twitter)
                                                <li><a href="{{ html_decode($single_agent->twitter) }}"><i
                                                            class="fab fa-twitter"></i></a></li>
                                            @endif

                                            @if ($single_agent->instagram)
                                                <li><a href="{{ html_decode($single_agent->instagram) }}"><i
                                                            class="fab fa-instagram"></i></a></li>
                                            @endif

                                            @if ($single_agent->facebook)
                                                <li><a href="{{ html_decode($single_agent->facebook) }}"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <!-- Agent Body -->
                                    <div class="homec-agent__body">
                                        <h4 class="homec-agent__title position_relitive">

                                            <a
                                                href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => html_decode($single_agent->user_name)]) }}">{{ html_decode($single_agent->name) }}

                                                @php
                                                    $kyc = Modules\Kyc\Entities\KycInformation::where(
                                                        'user_id',
                                                        $single_agent->id,
                                                    )
                                                        ->where('status', 1)
                                                        ->first();
                                                @endphp
                                                @if ($kyc)
                                                    <span class="varified-badge">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor">
                                                            <path
                                                                d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z">

                                                            </path>
                                                        </svg>
                                                    </span>
                                                @endif

                                            </a>

                                            <span>{{ html_decode($single_agent->designation) }}</span>
                                        </h4>


                                    </div>
                                    <!-- End Agent Body -->
                                </div>
                                <!-- End Single agent-->
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="p-4 bg-white rounded-4 shadow-sm d-inline-block text-center my-4" style="max-width: 450px;">
                                    <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                                    <h5 class="fw-bold text-dark mb-2">No Agents Found</h5>
                                    <p class="text-muted fs-6 mb-0">We couldn't find any single agents matching your search criteria.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="row mt-3">
                        {{ $agents->links('custom_pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Agents -->

    <!-- Faq Area -->
    <section class="homec-bg-cover pd-top-90 pd-btm-120 homec-faq-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="homec-section__head text-center mb-4">
                        <div class="homec-section__shape">
                            <span
                                class="homec-section__badge homec-section__badge--shape homec-section__badge--shape--v2">{{ $faq->content->short_title }}</span>
                        </div>
                        <h2 class="homec-section__title">{{ $faq->content->long_title }}</h2>
                    </div>
                    <div class="homec-accordion accordion accordion-flush" id="homec-accordion">

                        @foreach ($faq->faqs as $faq_index => $faq_item)
                            <!-- End Single Accordion -->
                            <div
                                class="accordion-item homec-accordion__single {{ $faq_index == 0 ? 'active' : '' }}">
                                <h2 class="accordion-header" id="homect-1-{{ $faq_index }}">
                                    <button class="accordion-button collapsed homec-accordion__heading" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#ac-collapse1-{{ $faq_index }}">{{ $faq_item->question }}</button>
                                </h2>
                                <div id="ac-collapse1-{{ $faq_index }}"
                                    class="accordion-collapse collapse {{ $faq_index == 0 ? 'show' : '' }}"
                                    data-bs-parent="#homec-accordion">
                                    <div class="accordion-body homec-accordion__body">{!! nl2br($faq_item->answer) !!}</div>
                                </div>
                            </div>
                            <!-- End Single Accordion -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Faq Area -->

    <!-- Download App -->
    <section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15"
        style="background-image:url({{ asset($mobile_app->app_bg) }})">
        <div class="homec-shape">
            <div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                    alt="bg"></div>
            <div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                    alt="bg"></div>
            <div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}"
                    alt="bg"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="download-app__middle">
                        <div class="download-app__content">
                            <div class="homec-section__head section-white mg-btm-30" data-aos="fade-up"
                                data-aos-delay="400">
                                <h2 class="homec-section__title" style="color: #ffffff !important;">{{ $mobile_app->full_title ?? 'Download Our Mobile App' }}</h2>
                                <p class="sec-head__text" style="color: rgba(255, 255, 255, 0.9) !important; font-size: 16px;">{{ $mobile_app->description ?? 'Get instant property alerts, market insights, and real-time listings on your mobile device.' }}</p>
                            </div>
                            <!-- App Download Button -->
                            <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                                <a href="{{ $mobile_app->app_store }}"
                                    class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.32c.67-.82 1.13-1.96.99-3.11-1 .04-2.17.67-2.88 1.5-.63.73-1.18 1.89-1.03 3.02 1.12.09 2.25-.59 2.92-1.41z"/>
                                        </svg>
                                        <div class="btn-content"><span>{{ $mobile_app->apple_btn_text1 }}</span>
                                            <p>{{ $mobile_app->apple_btn_text2 }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ $mobile_app->play_store }}"
                                    class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.609 1.814L13.792 12 3.61 22.186a1.26 1.26 0 0 1-.61-.986V2.8a1.26 1.26 0 0 1 .609-.986zm11.6 11.6l2.368 2.368-12.784 7.228 10.416-9.596zm0-2.828L4.793 1.002l12.784 7.228-2.368 2.356zm1.414 1.414l3.528 2.002a1.258 1.258 0 0 1 0 2.196l-3.528 2.002-2.364-2.364 2.364-2.356z"/>
                                        </svg>
                                        <div class="btn-content"><span>{{ $mobile_app->google_btn_text1 }}</span>
                                            <p>{{ $mobile_app->google_btn_text2 }}</p>
                                        </div>
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
