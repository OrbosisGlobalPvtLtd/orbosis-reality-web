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
    <!-- Custom Scoped CSS for Contact Us Redesign -->
    <style>
        .contact-section-wrapper {
            padding: 80px 0 90px 0;
            background-color: #f8fafc;
        }

        .contact-card-info {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border-radius: 24px;
            padding: 40px 35px;
            color: #ffffff;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
            position: relative;
            overflow: hidden;
        }

        .contact-card-info::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            background: rgba(59, 130, 246, 0.15);
            border-radius: 50%;
            filter: blur(40px);
            pointer-events: none;
        }

        .contact-info-header {
            margin-bottom: 30px;
        }

        .contact-info-badge {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .contact-info-title {
            color: #ffffff !important;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .contact-info-desc {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .contact-detail-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            gap: 18px;
        }

        .contact-detail-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .contact-detail-item:hover .contact-detail-icon {
            background: #3b82f6;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .contact-detail-content h5 {
            color: #e2e8f0;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-detail-content p, 
        .contact-detail-content a {
            color: #ffffff;
            font-size: 1rem;
            font-weight: 500;
            margin: 0;
            text-decoration: none;
            word-break: break-word;
        }

        .contact-detail-content a:hover {
            color: #60a5fa;
        }

        .contact-info-footer-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .contact-info-footer-icon {
            font-size: 1.8rem;
            color: #10b981;
        }

        .contact-info-footer-text h6 {
            color: #ffffff;
            margin: 0 0 2px 0;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .contact-info-footer-text p {
            color: #94a3b8;
            margin: 0;
            font-size: 0.85rem;
        }

        /* Right Form Card */
        .contact-card-form {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05), 0 5px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #f1f5f9;
        }

        .contact-form-header {
            margin-bottom: 30px;
        }

        .contact-form-title {
            color: #0f172a;
            font-size: 1.85rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .contact-form-sub {
            color: #64748b;
            font-size: 0.95rem;
        }

        .custom-input-group {
            margin-bottom: 22px;
        }

        .custom-input-label {
            display: block;
            color: #334155;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .custom-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .custom-input-icon {
            position: absolute;
            left: 18px !important;
            z-index: 5;
            color: #94a3b8;
            font-size: 1.1rem;
            pointer-events: none;
            transition: color 0.3s ease;
        }

        .custom-input-field {
            width: 100% !important;
            height: 52px !important;
            padding: 10px 16px 10px 52px !important;
            background-color: #f8fafc !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 12px !important;
            color: #0f172a !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
            outline: none !important;
        }

        .custom-textarea-field {
            width: 100% !important;
            min-height: 140px !important;
            padding: 14px 16px 14px 52px !important;
            background-color: #f8fafc !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 14px !important;
            color: #0f172a !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
            outline: none !important;
            resize: vertical !important;
        }

        .custom-input-field:focus,
        .custom-textarea-field:focus {
            background-color: #ffffff !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12) !important;
        }

        .custom-input-wrapper:focus-within .custom-input-icon {
            color: #3b82f6 !important;
        }

        .custom-input-field::placeholder,
        .custom-textarea-field::placeholder {
            color: #94a3b8 !important;
            font-weight: 400 !important;
        }

        .btn-submit-contact {
            width: 100%;
            height: 54px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        }

        .btn-submit-contact:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.35);
            color: #ffffff;
        }

        /* Map Section */
        .contact-map-section {
            padding: 0 0 80px 0;
            background-color: #f8fafc;
        }

        .contact-map-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.04);
            border: 1px solid #f1f5f9;
        }

        .contact-map-card h4 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .contact-map-card h4 i {
            color: #2563eb;
        }

        .map-iframe-container {
            width: 100%;
            height: 420px;
            border-radius: 16px;
            overflow: hidden;
        }

        .map-iframe-container iframe {
            width: 100% !important;
            height: 100% !important;
            border: 0 !important;
        }

        @media (max-width: 991px) {
            .contact-card-form {
                padding: 30px 24px;
            }
            .contact-card-info {
                padding: 30px 24px;
            }
            .contact-info-title {
                font-size: 1.6rem;
            }
        }
    </style>

    <!-- Breadcrumbs -->
    <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            <li class="active"><a href="{{ route('contact-us') }}">{{__('user.Contact Us')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Contact Us')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Main Contact Section (Left-Right Layout) -->
    <section class="contact-section-wrapper">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                
                <!-- LEFT COLUMN: Contact Details & Info -->
                <div class="col-lg-5 col-12">
                    <div class="contact-card-info">
                        <div>
                            <div class="contact-info-header">
                                <span class="contact-info-badge"><i class="fa-solid fa-headset me-1"></i> {{__('user.Contact Us')}}</span>
                                <h3 class="contact-info-title">Get In Touch With Our Experts</h3>
                                <p class="contact-info-desc">Whether you are looking to buy, sell, rent, or invest in real estate across Indore, our team is ready to guide you at every step.</p>
                            </div>

                            <!-- Phone -->
                            <div class="contact-detail-item">
                                <div class="contact-detail-icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="contact-detail-content">
                                    <h5>{{__('user.Phone')}}</h5>
                                    <p><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="contact-detail-item">
                                <div class="contact-detail-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="contact-detail-content">
                                    <h5>{{__('user.Email')}}</h5>
                                    <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="contact-detail-item">
                                <div class="contact-detail-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="contact-detail-content">
                                    <h5>{{__('user.Location')}}</h5>
                                    <p>{{ $contact->address }}</p>
                                </div>
                            </div>

                            @if(!empty($contact->support_time))
                            <!-- Support Hours -->
                            <div class="contact-detail-item">
                                <div class="contact-detail-icon">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div class="contact-detail-content">
                                    <h5>Working Hours</h5>
                                    <p>{{ $contact->support_time }} @if(!empty($contact->off_day)) <span class="text-danger">({{ $contact->off_day }})</span> @endif</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Footer Badge inside info card -->
                        <div class="contact-info-footer-card">
                            <div class="contact-info-footer-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div class="contact-info-footer-text">
                                <h6>Quick Response Guaranteed</h6>
                                <p>Our dedicated advisors respond within 24 hours.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT COLUMN: Contact Form -->
                <div class="col-lg-7 col-12">
                    <div class="contact-card-form">
                        <div class="contact-form-header">
                            <h3 class="contact-form-title">Send Us A Message</h3>
                            <p class="contact-form-sub">Have a question or specific inquiry? Fill out the form below to connect directly with our real estate specialists.</p>
                        </div>

                        <form method="POST" action="{{ route('send-contact-message') }}">
                            @csrf
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 col-12">
                                    <div class="custom-input-group">
                                        <label class="custom-input-label">{{__('user.Name')}} <span class="text-danger">*</span></label>
                                        <div class="custom-input-wrapper">
                                            <i class="fa-regular fa-user custom-input-icon"></i>
                                            <input type="text" name="name" class="custom-input-field" placeholder="Enter your full name" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 col-12">
                                    <div class="custom-input-group">
                                        <label class="custom-input-label">{{__('user.Email')}} <span class="text-danger">*</span></label>
                                        <div class="custom-input-wrapper">
                                            <i class="fa-regular fa-envelope custom-input-icon"></i>
                                            <input type="email" name="email" class="custom-input-field" placeholder="Enter your email address" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 col-12">
                                    <div class="custom-input-group">
                                        <label class="custom-input-label">{{__('user.Phone')}}</label>
                                        <div class="custom-input-wrapper">
                                            <i class="fa-solid fa-phone custom-input-icon"></i>
                                            <input type="text" name="phone" class="custom-input-field" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                </div>

                                <!-- Subject -->
                                <div class="col-md-6 col-12">
                                    <div class="custom-input-group">
                                        <label class="custom-input-label">{{__('user.Subject')}} <span class="text-danger">*</span></label>
                                        <div class="custom-input-wrapper">
                                            <i class="fa-regular fa-bookmark custom-input-icon"></i>
                                            <input type="text" name="subject" class="custom-input-field" placeholder="Inquiry subject (e.g. Property Query)" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <div class="custom-input-group">
                                        <label class="custom-input-label">{{__('user.Type here')}} <span class="text-danger">*</span></label>
                                        <div class="custom-input-wrapper">
                                            <i class="fa-regular fa-comment-dots custom-input-icon" style="top: 18px;"></i>
                                            <textarea name="message" class="custom-textarea-field" placeholder="Write your detailed message or property requirements here..." required></textarea>
                                        </div>
                                    </div>
                                </div>

                                @if(isset($recaptcha_setting) && $recaptcha_setting->status == 1)
                                    <div class="col-12 mb-3">
                                        <div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <button type="submit" class="btn-submit-contact">
                                        <span>{{__('user.Send Message Now')}}</span>
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section -->
    @if(!empty($contact->map))
    <section class="contact-map-section">
        <div class="container">
            <div class="contact-map-card">
                <h4><i class="fa-solid fa-map-location-dot"></i> {{__('user.Location')}} Map</h4>
                <div class="map-iframe-container">
                    {!! $contact->map !!}
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Download App Section -->
    @if(isset($mobile_app) && $mobile_app->visibility)
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
                                <h2 class="homec-section__title" style="color: #ffffff !important;">{{ $mobile_app->full_title ?? 'Download Our Mobile App' }}</h2>
                                <p class="sec-head__text" style="color: rgba(255, 255, 255, 0.9) !important; font-size: 16px;">{{ $mobile_app->description ?? 'Get instant property alerts, market insights, and real-time listings on your mobile device.' }}</p>
                            </div>
                            <!-- App Download Button -->
                            <div class="download__app-button" data-aos="fade-up" data-aos-delay="500">
                                <a href="{{ $mobile_app->app_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 28px; height: 28px; fill: #ffffff; flex-shrink: 0;">
                                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.32c.67-.82 1.13-1.96.99-3.11-1 .04-2.17.67-2.88 1.5-.63.73-1.18 1.89-1.03 3.02 1.12.09 2.25-.59 2.92-1.41z"/>
                                        </svg>
                                        <div class="btn-content">
                                            <span>{{ !empty($mobile_app->apple_btn_text1) ? $mobile_app->apple_btn_text1 : 'Available on the' }}</span>
                                            <p>{{ !empty($mobile_app->apple_btn_text2) ? $mobile_app->apple_btn_text2 : 'App Store' }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ $mobile_app->play_store }}" class="homec-btn homec-btn-primary-overlay homec-btn__download">
                                    <div class="homec-btn__inside">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 28px; height: 28px; fill: #ffffff; flex-shrink: 0;">
                                            <path d="M3.609 1.814L13.792 12 3.61 22.186a1.26 1.26 0 0 1-.61-.986V2.8a1.26 1.26 0 0 1 .609-.986zm11.6 11.6l2.368 2.368-12.784 7.228 10.416-9.596zm0-2.828L4.793 1.002l12.784 7.228-2.368 2.356zm1.414 1.414l3.528 2.002a1.258 1.258 0 0 1 0 2.196l-3.528 2.002-2.364-2.364 2.364-2.356z"/>
                                        </svg>
                                        <div class="btn-content">
                                            <span>{{ !empty($mobile_app->google_btn_text1) ? $mobile_app->google_btn_text1 : 'GET IT ON' }}</span>
                                            <p>{{ !empty($mobile_app->google_btn_text2) ? $mobile_app->google_btn_text2 : 'Google Play' }}</p>
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
    @endif


@endsection
