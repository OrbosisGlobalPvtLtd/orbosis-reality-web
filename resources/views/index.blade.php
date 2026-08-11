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

    @if ($intro_content->visibility)
        @php
            $home1_intro = $intro_content->home1_intro;
            $slider_properties = $home1_intro->slider_properties;
        @endphp
		
		<!-- Professional Hero Carousel Styles -->
		<style>
			.hero-carousel {
				position: relative;
				width: 100%;
				height: 100vh;
				min-height: 100vh;
				max-height: 100vh;
				overflow: hidden;
				margin: 0 !important;
				padding: 0 !important;
				margin-bottom: 0 !important;
			}

			.hero-carousel .carousel-inner {
				height: 100vh;
				min-height: 100vh;
			}

			.hero-carousel .carousel-item {
				height: 100vh;
				min-height: 100vh;
				position: relative;
				background-size: cover;
				background-position: center;
				background-repeat: no-repeat;
			}

			.hero-carousel .carousel-item img {
				width: 100%;
				height: 100%;
				object-fit: cover;
				display: block;
			}

			.hero-overlay {
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.1) 100%);
				z-index: 1;
			}

			.hero-carousel .carousel-caption {
				position: absolute;
				bottom: 100px;
				left: 30px;
				right: auto;
				top: auto;
				transform: none;
				background: rgba(255, 255, 255, 0.08);
				backdrop-filter: blur(25px);
				border-radius: 24px;
				padding: 45px;
				max-width: 540px;
				width: 100%;
				z-index: 2;
				box-shadow: 0 40px 120px rgba(0, 0, 0, 0.3), inset 0 1px 0 0 rgba(255, 255, 255, 0.6);
				border: 1.5px solid rgba(255, 255, 255, 0.95);
				text-align: left;
				animation: cardSlideUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s both;
			}

			@keyframes cardSlideUp {
				from {
					opacity: 0;
					transform: translateY(80px) scale(0.95);
					filter: blur(15px);
				}
				to {
					opacity: 1;
					transform: translateY(0) scale(1);
					filter: blur(0);
				}
			}

			.hero-carousel .carousel-caption:hover {
				transform: translateY(-20px) scale(1.03);
				box-shadow: 0 60px 180px rgba(0, 0, 0, 0.4), inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
			}

			.price-badge {
				display: inline-flex;
				align-items: center;
				gap: 10px;
				background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
				color: white;
				padding: 16px 28px;
				border-radius: 14px;
				margin-bottom: 28px;
				font-weight: 900;
				font-size: 20px;
				box-shadow: 0 15px 40px rgba(99, 102, 241, 0.5), 0 0 20px rgba(236, 72, 153, 0.3);
				border: 1px solid rgba(255, 255, 255, 0.3);
				animation: priceBadgeSlide 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s both;
			}

			@keyframes priceBadgeSlide {
				from {
					opacity: 0;
					transform: translateY(-30px) rotate(-5deg);
				}
				to {
					opacity: 1;
					transform: translateY(0) rotate(0deg);
				}
			}

			.price-badge:hover {
				transform: scale(1.12) translateY(-8px);
				box-shadow: 0 25px 60px rgba(99, 102, 241, 0.7), 0 0 30px rgba(236, 72, 153, 0.5);
			}
            
			.hero-title {
				font-size: 40px;
				font-weight: 950;
				color: #fbfbfb;
				margin: 0 0 22px 0;
				line-height: 1.25;
				letter-spacing: -0.5px;
				text-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
				animation: titleSlide 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s both;
			}

			@keyframes titleSlide {
				from {
					opacity: 0;
					transform: translateX(-50px);
					filter: blur(10px);
				}
				to {
					opacity: 1;
					transform: translateX(0);
					filter: blur(0);
				}
			}

			.location-section {
				display: flex;
				align-items: flex-start;
				gap: 14px;
				margin-bottom: 24px;
				animation: locationSlide 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.5s both;
			}

			@keyframes locationSlide {
				from {
					opacity: 0;
					transform: translateY(30px);
				}
				to {
					opacity: 1;
					transform: translateY(0);
				}
			}

			.location-icon {
				color: #6366f1;
				flex-shrink: 0;
				margin-top: 6px;
				width: 20px;
				height: 20px;
				filter: drop-shadow(0 2px 4px rgba(99, 102, 241, 0.3));
			}

			.location-address {
				margin: 0;
				color: #fafbfb;
				font-size: 16px;
				line-height: 1.5;
				font-weight: 600;
			}

			.features-grid {
				display: grid;
				grid-template-columns: repeat(3, 1fr);
				gap: 22px;
				padding-top: 28px;
				border-top: 2px solid rgba(226, 232, 240, 0.7);
				animation: featuresSlide 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.5s both;
			}

			@keyframes featuresSlide {
				from {
					opacity: 0;
					transform: translateY(40px);
				}
				to {
					opacity: 1;
					transform: translateY(0);
				}
			}

			.feature-item {
				display: flex;
				flex-direction: column;
				align-items: center;
				gap: 12px;
				text-align: center;
				transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
				padding: 18px 14px;
				border-radius: 14px;
				background: rgba(255, 255, 255, 0.85);
				backdrop-filter: blur(12px);
				border: 1.5px solid rgba(255, 255, 255, 0.7);
				box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
			}

			.feature-item:hover {
				background: rgba(99, 102, 241, 0.15);
				transform: translateY(-12px) scale(1.08);
				box-shadow: 0 15px 35px rgba(99, 102, 241, 0.3);
				border-color: rgba(99, 102, 241, 0.5);
			}

			.feature-icon {
				color: #6366f1;
				width: 24px;
				height: 24px;
				flex-shrink: 0;
				filter: drop-shadow(0 2px 4px rgba(99, 102, 241, 0.2));
			}

			.feature-text {
				font-size: 16px;
				font-weight: 800;
				color: #1e293b;
				text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
			}

			.hero-carousel .carousel-control-prev,
			.hero-carousel .carousel-control-next {
				width: 70px;
				height: 70px;
				background: rgba(255, 255, 255, 0.197);
				backdrop-filter: blur(25px);
				border: 2px solid rgba(255, 255, 255, 0.9);
				border-radius: 50%;
				top: 50%;
				transform: translateY(-50%);
				opacity: 1;
				z-index: 10;
				box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2), inset 0 1px 0 0 rgba(255, 255, 255, 0.5);
				transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
			}

			.hero-carousel .carousel-control-prev:hover,
			.hero-carousel .carousel-control-next:hover {
				background: white;
				border-color: #6366f1;
				transform: translateY(-50%) scale(1.3);
				box-shadow: 0 18px 50px rgba(99, 102, 241, 0.6), inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
			}

			.hero-carousel .carousel-control-prev-icon,
			.hero-carousel .carousel-control-next-icon {
				filter: invert(0.3);
				width: 28px;
				height: 28px;
			}

			.hero-carousel .carousel-control-prev {
				left: 30px;
			}

			.hero-carousel .carousel-control-next {
				right: 30px;
			}

			.hero-carousel .carousel-indicators {
				position: absolute;
				bottom: 10px;
				left: 37%;
				transform: translateX(-50%);
				z-index: 10;
				gap: 14px;
				background: rgba(255, 255, 255, 0.1);
				backdrop-filter: blur(15px);
				padding: 12px 20px;
				border-radius: 50px;
				border: 1px solid rgba(255, 255, 255, 0.2);
			}

			.hero-carousel .carousel-indicators button {
				width: 16px;
				height: 16px;
				background: rgba(255, 255, 255, 0.7);
				opacity: 0.8;
				border: 2px solid rgba(255, 255, 255, 0.5);
				border-radius: 50%;
				box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2);
				transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
				cursor: pointer;
			}

			.hero-carousel .carousel-indicators button:hover {
				background: rgba(255, 255, 255, 1);
				opacity: 1;
				transform: scale(1.5);
				box-shadow: 0 6px 20px rgba(255, 255, 255, 0.6);
				border-color: rgba(99, 102, 241, 0.5);
			}

			.hero-carousel .carousel-indicators button.active {
				background: white;
				opacity: 1;
				width: 48px;
				border-radius: 10px;
				box-shadow: 0 8px 25px rgba(255, 255, 255, 0.7);
				transform: scale(1.1);
				border-color: rgba(99, 102, 241, 0.8);
			}

			.hero-carousel .carousel-item {
				transition: opacity 0.8s ease-in-out !important;
			}

		@media (max-width: 768px) {
			.hero-carousel .carousel-caption {
				padding: 30px;
				max-width: calc(100% - 40px);
				bottom: 40px;
				left: 20px;
				right: 20px;
				margin: 0 auto;
			}

				.hero-title {
					font-size: 26px;
					margin-bottom: 16px;
				}

				.price-badge {
					font-size: 16px;
					padding: 12px 18px;
					margin-bottom: 18px;
				}

				.features-grid {
					gap: 12px;
					padding-top: 16px;
				}

				.hero-carousel .carousel-control-prev,
				.hero-carousel .carousel-control-next {
					width: 50px;
					height: 50px;
					display: none;
				}

				.hero-carousel .carousel-indicators {
					bottom: 20px;
					gap: 8px;
					padding: 8px 15px;
				}

				.hero-carousel .carousel-indicators button {
					width: 10px;
					height: 10px;
				}

				.hero-carousel .carousel-indicators button.active {
					width: 28px;
				}
			}
		</style>

		<!-- Hero Carousel Bootstrap 5 -->
		<div id="hero-carousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="1000">
			<!-- Indicators -->
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"></button>
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"></button>
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"></button>
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="3"></button>
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="4"></button>
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="5"></button>
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="6"></button>
				<button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="7"></button>
			</div>

			<!-- Carousel Inner -->
			<div class="carousel-inner">
				<!-- Slide 1: Modern Luxury Apartment -->
				<div class="carousel-item active">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.21 PM (3).jpeg') }}" class="d-block w-100" alt="Modern Luxury Apartment">
					<div class="hero-overlay"></div>
				</div>

				<!-- Slide 2: Spacious Villa with Garden -->
				<div class="carousel-item">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.20 PM.jpeg') }}" class="d-block w-100" alt="Spacious Villa">
					<div class="hero-overlay"></div>
				</div>

				<!-- Slide 3: Contemporary Studio -->
				<div class="carousel-item">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.20 PM (3).jpeg') }}" class="d-block w-100" alt="Contemporary Studio">
					<div class="hero-overlay"></div>
				</div>

				<!-- Slide 4: Luxury Penthouse -->
				<div class="carousel-item">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.20 PM (2).jpeg') }}" class="d-block w-100" alt="Luxury Penthouse">
					<div class="hero-overlay"></div>
				</div>

				<!-- Slide 5: Cozy Bedroom Apartment -->
				<div class="carousel-item">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.20 PM (1).jpeg') }}" class="d-block w-100" alt="Cozy Apartment">
					<div class="hero-overlay"></div>
				</div>

				<!-- Slide 6: Modern Town House -->
				<div class="carousel-item">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.21 PM (1).jpeg') }}" class="d-block w-100" alt="Modern Town House">
					<div class="hero-overlay"></div>
				</div>

				<!-- Slide 7: Elite Skyline Residence -->
				<div class="carousel-item">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.21 PM.jpeg') }}" class="d-block w-100" alt="Elite Residence">
					<div class="hero-overlay"></div>
				</div>

				<!-- Slide 8: Premium Urban Living -->
				<div class="carousel-item">
					<img src="{{ asset('frontend/img/WhatsApp Image 2026-03-20 at 3.39.20 PM.jpeg') }}" class="d-block w-100" alt="Premium Urban">
					<div class="hero-overlay"></div>
				</div>
			</div>

			<!-- Navigation Controls -->
			<button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>

			<button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
    @endif


        @if ($location->visibility)
            <!-- Property Listing -->
            <section class="pd-top-120 pd-btm-120">
                <div class="container homec-listing__container">
                    <div class="row">
                        <div class="col-12">
                            <!-- Section TItle -->
                            <div class="homec-section__head text-center mg-btm-60">
                                <span class="homec-section__badge homec-primary-color homec-section__badge--small m-0"  data-aos="fade-in" data-aos-delay="300">{{ $location->title }}</span>
                                <h2 class="homec-section__title"  data-aos="fade-in" data-aos-delay="400">{{ $location->description }}</h2>
                            </div>
                            <!-- Homec Search -->
                            <div class="homec-search-form mg-top-10" data-aos="fade-up" data-aos-delay="500">
                                <form class="homec-search-form__form homec-search-form__form--city" action="{{ route('properties') }}">
                                    <div class="homec-search-form__group">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_275_829" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                            <path d="M0 2.9405e-05H24V24H0V2.9405e-05Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_275_829)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 24C12.2351 24 12.4546 23.8825 12.585 23.6869C13.1198 22.8847 13.7306 22.0293 14.3771 21.124C14.5713 20.852 14.7687 20.5756 14.9682 20.2947C15.8268 19.086 16.717 17.8062 17.5208 16.4992C19.1133 13.9099 20.4375 11.1064 20.4375 8.43752C20.4375 3.78447 16.653 2.9405e-05 12 2.9405e-05C7.34694 2.9405e-05 3.5625 3.78447 3.5625 8.43752C3.5625 11.1064 4.88667 13.9099 6.47921 16.4992C7.28303 17.8062 8.17317 19.086 9.03176 20.2947C9.23131 20.5756 9.42873 20.852 9.62293 21.124C10.2694 22.0293 10.8802 22.8847 11.415 23.6869C11.5454 23.8825 11.7649 24 12 24ZM7.67704 15.7625C6.10551 13.2073 4.96875 10.6905 4.96875 8.43752C4.96875 4.56111 8.12359 1.40628 12 1.40628C15.8764 1.40628 19.0312 4.56111 19.0312 8.43752C19.0312 10.6905 17.8945 13.2073 16.3229 15.7625C15.5447 17.0278 14.6771 18.2763 13.8218 19.4803C13.6277 19.7535 13.4339 20.0249 13.2418 20.2939C12.8133 20.894 12.3936 21.4818 12 22.0486C11.6064 21.4818 11.1867 20.894 10.7582 20.2939C10.5661 20.0249 10.3723 19.7534 10.1782 19.4803C9.32291 18.2763 8.45524 17.0278 7.67704 15.7625Z" fill="#7E8BA0"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.78125 8.4375C7.78125 10.7642 9.67325 12.6562 12 12.6562C14.3267 12.6562 16.2187 10.7642 16.2187 8.4375C16.2187 6.11076 14.3267 4.21876 12 4.21876C9.67325 4.21876 7.78125 6.11076 7.78125 8.4375ZM12 11.25C10.4499 11.25 9.1875 9.9876 9.1875 8.4375C9.1875 6.88741 10.4499 5.62501 12 5.62501C13.5501 5.62501 14.8125 6.88741 14.8125 8.4375C14.8125 9.9876 13.5501 11.25 12 11.25Z" fill="#7E8BA0"/>
                                            </g>
                                        </svg>
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <select name="location" class="select2">
                                                <option value="">{{__('user.Select Location')}}</option>
                                                @foreach ($location->location_for_filter as $location_for_filter)
                                                <option value="{{ $location_for_filter->slug }}">{{ $location_for_filter->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="homec-btn">
                                        <span class="homec-btn__inside">
                                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.45185 16.8948C10.3289 16.8949 12.1522 16.2686 13.633 15.1152L19.2197 20.7019C19.637 21.105 20.3021 21.0934 20.7051 20.6761C21.0983 20.269 21.0983 19.6236 20.7051 19.2165L15.1184 13.6298C17.9805 9.9456 17.314 4.63881 13.6298 1.77676C9.94555 -1.08529 4.63881 -0.418815 1.77676 3.26541C-1.08529 6.94964 -0.418815 12.2564 3.26541 15.1185C4.74865 16.2707 6.57361 16.8958 8.45185 16.8948ZM3.96301 3.95978C6.44215 1.48059 10.4616 1.48054 12.9408 3.95969C15.42 6.43883 15.4201 10.4583 12.9409 12.9375C10.4618 15.4167 6.44229 15.4167 3.9631 12.9376C3.96305 12.9376 3.96305 12.9376 3.96301 12.9375C1.48386 10.4764 1.46926 6.47159 3.93034 3.99245C3.94121 3.98153 3.95209 3.97065 3.96301 3.95978Z"></path>
                                            </svg>
                                            <span>{{__('user.Search')}}</span>
                                        </span>
                                    </button>
                                </form>
                            </div>
                            <!-- End Homec Search -->
                        </div>
                    </div>
                    <style>
                        .homec-location-card {
                            border-radius: 12px;
                            overflow: hidden;
                            position: relative;
                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                            height: 280px;
                            width: 100%;
                        }
                        .homec-location-card:hover {
                            transform: translateY(-6px);
                            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
                        }
                        .homec-location-card a {
                            display: block;
                            width: 100%;
                            height: 100%;
                        }
                        .homec-location-card__img {
                            position: relative;
                            width: 100%;
                            height: 100%;
                            overflow: hidden;
                        }
                        .homec-location-card__img img {
                            width: 100% !important;
                            height: 100% !important;
                            object-fit: cover !important;
                            transition: transform 0.5s ease !important;
                        }
                        .homec-location-card:hover .homec-location-card__img img {
                            transform: scale(1.08) !important;
                        }
                        .homec-location-card .homec-listing__title {
                            position: absolute;
                            left: 0;
                            bottom: 0;
                            width: 100%;
                            padding: 20px;
                            margin: 0;
                            z-index: 2;
                            color: #ffffff;
                            word-wrap: break-word;
                            transition: color 0.3s ease;
                            font-size: 24px;
                            font-weight: 600;
                        }
                        .homec-location-card .homec-listing__title span {
                            display: block;
                            font-size: 15px;
                            font-weight: 400;
                            color: #f2c94c;
                            margin-bottom: 4px;
                        }
                        .homec-location-card:hover .homec-listing__title {
                            color: #f2c94c;
                        }
                        .homec-location-card:hover .homec-listing__title span {
                            color: #ffffff;
                        }
                    </style>

                    <div class="row">
                        @php
                            $home_locations = $location->locations;
                        @endphp

                        @foreach ($home_locations as $loc_index => $home_location)
                            @php
                                $loc_img = ($home_location->image && file_exists(public_path($home_location->image))) 
                                    ? asset($home_location->image) 
                                    : asset('uploads/website-images/city-2026-01-10-06-50-10-1272.webp');
                            @endphp
                            <div class="col-xl-3 col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="{{ 300 + ($loc_index % 4) * 100 }}">
                                <!-- Homec Location Card -->
                                <div class="homec-location-card">
                                    <a href="{{ route('properties', ['location' => $home_location->slug]) }}">
                                        <div class="homec-location-card__img">
                                            <img src="{{ $loc_img }}" alt="{{ $home_location->name }}">
                                            <div class="homec-overlay homec-listing__overlay"></div>
                                            <h4 class="homec-listing__title">
                                                <span>{{ $home_location->totalProperty }}+ {{__('user.Property')}}</span>
                                                {{ $home_location->name }}
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                                <!-- End Homec Location Card -->
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12  d-flex justify-content-center mg-top-40" data-aos="fade-up" data-aos-delay="700">
                            <!-- Section TItle -->
                            <a href="{{ route('properties') }}" class="homec-btn"><span>{{__('user.Search Property')}}</span></a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Property Listing -->
        @endif

        @if ($about_us->visibility)
            @php
                $home1_content = $about_us->home1_content;
                $bg_img = ($home1_content->background_image && file_exists(public_path($home1_content->background_image))) 
                    ? asset($home1_content->background_image) 
                    : asset('uploads/website-images/about-us-bg-2026-03-20-08-00-49-1074.webp');
                $auth_img = ($home1_content->author_image && file_exists(public_path($home1_content->author_image))) 
                    ? asset($home1_content->author_image) 
                    : asset('uploads/website-images/john-doe-2023-04-02-12-13-26-4519.jpg');
            @endphp
            <style>
                .homec-image-group__main {
                    position: relative;
                    border-radius: 20px;
                    overflow: hidden;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
                }
                .homec-image-group__main img.about-main-img {
                    width: 100%;
                    height: 480px;
                    object-fit: cover;
                }
                .orbosis-ceo-badge {
                    display: flex !important;
                    align-items: center !important;
                    gap: 14px !important;
                    background: #ffffff !important;
                    padding: 10px 22px 10px 10px !important;
                    border-radius: 60px !important;
                    box-shadow: 0 15px 35px rgba(0,0,0,0.18) !important;
                    position: absolute !important;
                    bottom: 25px !important;
                    right: 25px !important;
                    z-index: 10 !important;
                    border: 1.5px solid rgba(255, 255, 255, 0.9) !important;
                    width: auto !important;
                    height: auto !important;
                }
                .orbosis-ceo-badge__avatar {
                    width: 50px !important;
                    height: 50px !important;
                    border-radius: 50% !important;
                    overflow: hidden !important;
                    flex-shrink: 0 !important;
                    border: 2px solid #6366f1 !important;
                }
                .orbosis-ceo-badge__avatar img {
                    width: 100% !important;
                    height: 100% !important;
                    object-fit: cover !important;
                    border-radius: 50% !important;
                }
                .orbosis-ceo-badge__info {
                    display: flex !important;
                    flex-direction: column !important;
                    justify-content: center !important;
                }
                .orbosis-ceo-badge__name {
                    margin: 0 !important;
                    font-size: 15px !important;
                    font-weight: 700 !important;
                    color: #0f172a !important;
                    line-height: 1.2 !important;
                    white-space: nowrap !important;
                }
                .orbosis-ceo-badge__role {
                    margin: 2px 0 0 0 !important;
                    font-size: 12px !important;
                    font-weight: 600 !important;
                    color: #6366f1 !important;
                    white-space: nowrap !important;
                }

                .homec-section__badge {
                    display: inline-block !important;
                    width: auto !important;
                    max-width: fit-content !important;
                    margin: 0 auto 12px auto !important;
                    padding: 6px 20px !important;
                    border-radius: 30px !important;
                    font-size: 13px !important;
                    font-weight: 700 !important;
                    letter-spacing: 0.5px !important;
                    text-transform: uppercase !important;
                    background: #e0e7ff !important;
                    color: #4338ca !important;
                    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.12) !important;
                }
            </style>
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
                                    <img src="{{ $bg_img }}" alt="about_bg" class="about-main-img">
                                    <div class="homec-experiences">
                                        <h4 class="homec-experiences__title">{{ $home1_content->experience_text_1 }} <span>{{ $home1_content->experience_text_2 }}</span></h4>
                                    </div>
                                    <div class="orbosis-ceo-badge">
                                        <div class="orbosis-ceo-badge__avatar">
                                            <img src="{{ $auth_img }}" alt="CEO Avatar" onerror="this.onerror=null; this.src='{{ asset('uploads/website-images/john-doe-2023-04-02-12-13-26-4519.jpg') }}';">
                                        </div>
                                        <div class="orbosis-ceo-badge__info">
                                            <h5 class="orbosis-ceo-badge__name">{{ $home1_content->author_name }}</h5>
                                            <span class="orbosis-ceo-badge__role">{{ $home1_content->author_designation }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Homec Image Group -->
                        </div>
                        <div class="col-lg-6 col-12 mg-top-30">
                            <div class="homec-about-content homec-about-content--v2">
                                <!-- Section Title -->
                                <div class="homec-section__head">
                                    <div class="homec-section__shape">
                                        <span class="homec-section__badge homec-section__badge--shape" data-aos="fade-down" data-aos-delay="300">{{ $home1_content->short_title }}</span>
                                    </div>
                                    <h2 class="homec-section__title" data-aos="fade-in" data-aos-delay="400">{{ $home1_content->long_title }}</h2>
                                </div>
                                <div class="homec-about-content__inner mg-top-20" data-aos="fade-in" data-aos-delay="500">
                                    <p class="homec-about-content__text">{{ $home1_content->description_1 }}</p>
                                    <div class="homec-focus-content homec-focus-content--v2 homec-border mg-top-20">
                                        <p>{{ $home1_content->description_2 }}</p>
                                    </div>
                                    <div class="homec-dflex-space">
                                        <div class="homec-funfact__single homec-funfact__single--v2">
                                            <div class="homec-funfact__icon">
                                                <img src="{{ asset($home1_content->item1->icon ?? 'uploads/website-images/trusted20230409043810.svg') }}" alt="icon">
                                            </div>
                                            <h3 class="homec-funfact__number"><span class="counter">{{ $home1_content->item1->title }}</span>{{ $home1_content->item1->title2 }}</h3>
                                            <p class="homec-funfact__text">{{ $home1_content->item1->description }}</p>
                                        </div>
                                        <div class="homec-funfact__single homec-funfact__single--v2">
                                            <div class="homec-funfact__icon">
                                                <img src="{{ asset($home1_content->item2->icon ?? 'uploads/website-images/247-support20230409043819.svg') }}" alt="icon">
                                            </div>
                                            <h3 class="homec-funfact__number"><span class="counter">{{ $home1_content->item2->title }}</span>{{ $home1_content->item2->title2 }}</h3>
                                            <p class="homec-funfact__text">{{ $home1_content->item2->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About Area -->
        @endif

        @if ($featured_property->visibility)
            <style>
                .homec-property-listing-bg {
                    background: #f8fafc !important;
                    position: relative;
                }
                .homec-property-listing-bg .homec-section__title {
                    color: #0f172a !important;
                }
                .homec-property-listing-bg .homec-section__badge {
                    color: #6366f1 !important;
                    background: #e0e7ff !important;
                }
            </style>
            <!-- Properties Listing -->
            <section class="homec-properties pd-top-90 pd-btm-100 homec-property-listing-bg">
                <div class="homec-shape">
                    <div class="homec-shape-single homec-shape-7"><img src="{{ asset('frontend/img/anim-shape-4.svg') }}" alt="shape"></div>
                    <div class="homec-shape-single homec-shape-8"><img src="{{ asset('frontend/img/anim-shape-5.svg') }}" alt="shape"></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- Section TItle -->
                            <div class="homec-section__head text-center mg-btm-30">
                                <span class="homec-section__badge homec-section__badge--small homec-primary-color m-0" data-aos="fade-in" data-aos-delay="300">{{ $featured_property->title }}</span>
                                <h2 class="homec-section__title" data-aos="fade-in" data-aos-delay="400">{{ $featured_property->description }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $featured_properties = $featured_property->properties;
                        @endphp
                        <style>
                            .homec-property {
                                border-radius: 12px;
                                overflow: hidden;
                                box-shadow: 0 6px 20px rgba(0,0,0,0.06);
                                background: #ffffff;
                                transition: transform 0.3s ease, box-shadow 0.3s ease;
                            }
                            .homec-property:hover {
                                transform: translateY(-5px);
                                box-shadow: 0 12px 30px rgba(0,0,0,0.12);
                            }
                            .homec-property__head {
                                height: 230px;
                                position: relative;
                                overflow: hidden;
                            }
                            .homec-property__head img {
                                width: 100% !important;
                                height: 100% !important;
                                object-fit: cover !important;
                                transition: transform 0.5s ease !important;
                            }
                            .homec-property:hover .homec-property__head img {
                                transform: scale(1.08) !important;
                            }
                        </style>
                        @foreach ($featured_properties as $featured_property)
                            @php
                                $prop_thumb = ($featured_property->thumbnail_image && file_exists(public_path($featured_property->thumbnail_image))) 
                                    ? asset($featured_property->thumbnail_image) 
                                    : asset('uploads/website-images/luxury_villa.png');
                            @endphp
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                                <!-- Single property-->
                                <div class="homec-property">
                                    <!-- Property Head-->
                                    <div class="homec-property__head">
                                        <img src="{{ $prop_thumb }}" alt="{{ $featured_property->title }}">
                                        <!-- Top Sticky -->
                                        <div class="homec-property__hsticky">
                                          <div class="homec-heart-df">
                                            <a href="javascript:;" class="homec-heart add-to-wishlist" data-property-id="{{ $featured_property->id }}">
                                                    <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5745 3.73257L11.1008 4.69447L11.6272 3.73258C11.9704 3.10535 12.5438 2.26267 13.3886 1.60933C14.2595 0.935774 15.2355 0.6 16.3044 0.6C19.29 0.6 21.6017 3.03446 21.6017 6.3966C21.6017 8.18186 20.8932 9.70959 19.5597 11.3187C18.211 12.9462 16.2694 14.6033 13.8617 16.6552L14.2508 17.1119L13.8617 16.6552L13.8611 16.6557C13.0479 17.3487 12.1237 18.1363 11.1625 18.9769L11.1623 18.977C11.1457 18.9916 11.1241 18.9999 11.1008 18.9999C11.0776 18.9999 11.056 18.9916 11.0394 18.9771L11.0391 18.9768C10.0784 18.1367 9.15452 17.3493 8.34203 16.6569L8.34054 16.6556L8.34053 16.6556C5.93251 14.6035 3.99081 12.9463 2.64202 11.3188C1.30844 9.70958 0.6 8.18186 0.6 6.3966C0.6 3.03446 2.91167 0.6 5.89732 0.6C6.96614 0.6 7.94219 0.935773 8.81311 1.60933C9.6579 2.26267 10.2313 3.10532 10.5745 3.73257Z" stroke-width="1.2"/>
                                                    </svg>
                                                </a>
                                                <a href="javascript:;" class="homec-heart add-to-compare" data-property-id="{{ $featured_property->id }}" title="{{__('user.Compare')}}">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5"/>
                                                    </svg>
                                                </a>
                                          </div>
                                            <span class="homec-property__salebadge">

                                                @if ($featured_property->purpose == 'rent')
                                                    {{__('user.For Rent')}}
                                                @else
                                                    {{__('user.For Sale')}}
                                                @endif
                                            </span>
                                            <span class="homec-property__salebadge" style="
                                                @if(($featured_property->availability_status ?? 'available') == 'available')
                                                    background-color: #d4edda; color: #155724;
                                                @elseif($featured_property->availability_status == 'booked')
                                                    background-color: #fff3cd; color: #856404;
                                                @elseif($featured_property->availability_status == 'sold')
                                                    background-color: #f8d7da; color: #721c24;
                                                @elseif($featured_property->availability_status == 'rented')
                                                    background-color: #cce5ff; color: #004085;
                                                @endif
                                                margin-left: 5px; font-weight: 600;
                                            ">
                                                {{ ucfirst($featured_property->availability_status ?? 'available') }}
                                            </span>
                                        </div>
                                        <!-- End Top Sticky -->
                                    </div>
                                    <!-- Property Body-->
                                    <div class="homec-property__body">
                                        <div class="homec-property__topbar">
                                            <div class="homec-property__price">{{ html_decode(num_format($featured_property->price)) }}
                                                @if ($featured_property->purpose == 'rent')
                                                <span>/{{ $featured_property->rent_period }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <h3 class="homec-property__title"><a href="{{ route('property', html_decode($featured_property->slug)) }}">{{ html_decode($featured_property->title) }}</a></h3>
                                        <div class="homec-property__text">
                                            <img src="{{ asset('frontend/img/location-icon.svg') }}" alt="address"><p>{{ html_decode($featured_property->address) }}</p>
                                        </div>
                                        <!-- Property List-->
                                        <ul class="homec-property__list homec-border-top list-none">
                                            <li><img src="{{ asset('frontend/img/room-icon2.svg') }}" alt="total_bedroom">{{ $featured_property->total_bedroom }} {{__('user.Bed')}}</li>
                                            <li><img src="{{ asset('frontend/img/bath-icon2.svg') }}" alt="total_bathroom">{{ $featured_property->total_bathroom }} {{__('user.Bath')}}</li>
                                            <li><img src="{{ asset('frontend/img/size-icon2.svg') }}" alt="total_area">{{ html_decode($featured_property->total_area) }} {{__('user.m2')}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single property-->
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12  d-flex justify-content-center mg-top-40"  data-aos="fade-up" data-aos-delay="600">
                            <!-- Section TItle -->
                            <a href="{{ route('properties',['featured_property' => 'enable']) }}" class="homec-btn"><span>{{__('user.See Featured  Properties')}}</span></a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Properties Listing -->
        @endif


        @if ($setting->agent_can_add_property)
            @if ($setting->agent_can_add_property == 'enable')
                @if ($pricing_plan->visibility)
                    <!-- Pricing -->
                    <section class="pd-top-90 pd-btm-120 homec-bg-third-color">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Section TItle -->
                                    <div class="homec-section__head text-center mg-btm-30">
                                        <span class="homec-section__badge homec-section__badge--small homec-primary-color m-0" data-aos="fade-in" data-aos-delay="300">{{ $pricing_plan->title }}</span>
                                        <h2 class="homec-section__title" data-aos="fade-in" data-aos-delay="400">{{ $pricing_plan->description }}</h2>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                @foreach ($pricing_plan->pricing_plans as $index => $pricing_plan_item)
                                    <div class="col-lg-3 col-md-4 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                                        <!-- Pricing Single -->
                                        <div class="homec-psingle {{ ++$index % 2 == 0 ? 'homec-psingle__active' : '' }} ">
                                            <div class="homec-psingle__head">
                                                <h4 class="homec-psingle__title">{{ $pricing_plan_item->plan_name }}</h4>
                                                <div class="homec-psingle__amount">
                                                    <span class="homec-psingle__currency"></span>{{ num_format($pricing_plan_item->plan_price) }}<span>/
                                                        @if ($pricing_plan_item->expired_time == 'monthly')
                                                        {{__('user.Monthly')}}
                                                        @elseif ($pricing_plan_item->expired_time == 'yearly')
                                                        {{__('user.Yearly')}}
                                                        @elseif ($pricing_plan_item->expired_time == 'lifetime')
                                                        {{__('user.Lifetime')}}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="homec-psingle__body">
                                                <ul class="homec-psingle__list">

                                                    @if ($pricing_plan_item->max_agent_add > 0)
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Agency Profile')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Agency Profile')}}</li>
                                                    @endif

                                                    <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan_item->max_agent_add }} {{__('user.Agent')}}</li>

                                                    @if ($pricing_plan_item->number_of_property == -1)
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Property Submission')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan_item->number_of_property }} {{__('user.Property Submission')}}</li>
                                                    @endif

                                                    @if ($pricing_plan_item->featured_property == 'enable')
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Featured Property')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Featured Property')}}</li>
                                                    @endif

                                                    @if ($pricing_plan_item->featured_property_qty == -1)
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Featured Property')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan_item->featured_property_qty }} {{__('user.Featured Property')}}</li>
                                                    @endif

                                                    @if ($pricing_plan_item->top_property == 'enable')
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Top Property')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Top Property')}}</li>
                                                    @endif

                                                    @if ($pricing_plan_item->top_property_qty == -1)
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Top Property')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan_item->top_property_qty }} {{__('user.Top Property')}}</li>
                                                    @endif

                                                    @if ($pricing_plan_item->urgent_property == 'enable')
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Urgent Property')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-remove-color"><i class="fas fa-remove"></i></span>{{__('user.Urgent Property')}}</li>
                                                    @endif

                                                    @if ($pricing_plan_item->urgent_property_qty == -1)
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Unlimited')}} {{__('user.Urgent Property')}}</li>
                                                    @else
                                                        <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{ $pricing_plan_item->urgent_property_qty }} {{__('user.Urgent Property')}}</li>
                                                    @endif

                                                    <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Aminities')}}</li>

                                                    <li><span class="homec-psingle__icon homec-check-color"><i class="fas fa-check"></i></span>{{__('user.Nearest Location')}}</li>


                                                </ul>
                                                <div class="homec-psingle__button">
                                                    @if ($pricing_plan_item->plan_type == 'free')
                                                    <a href="{{ route('free-enroll', $pricing_plan_item->plan_slug) }}" class="homec-btn homec-btn__thrid"><span>{{__('user.Trail Now')}}</span></a>
                                                    @else
                                                    <a href="{{ route('payment', $pricing_plan_item->plan_slug) }}" class="homec-btn homec-btn__thrid"><span>{{__('user.Enroll Now')}}</span></a>
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
                @endif
            @endif
        @endif

        @if ($why_choose_us->visibility)
            <style>
                .homec-why-card {
                    background: rgba(255, 255, 255, 0.08);
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    border-radius: 16px;
                    padding: 28px 22px;
                    height: 100%;
                    transition: transform 0.3s ease, background 0.3s ease;
                }
                .homec-why-card:hover {
                    transform: translateY(-8px);
                    background: rgba(255, 255, 255, 0.16);
                    border-color: rgba(255, 255, 255, 0.35);
                }
                .homec-why-card__icon-wrap {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 20px;
                }
                .homec-why-card__icon {
                    width: 58px;
                    height: 58px;
                    background: #ffffff;
                    border-radius: 14px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
                }
                .homec-why-card__icon img {
                    width: 32px;
                    height: 32px;
                    object-fit: contain;
                }
                .homec-why-card__num {
                    font-size: 20px;
                    font-weight: 800;
                    color: #f59e0b;
                    background: rgba(245, 158, 11, 0.15);
                    border: 1px solid rgba(245, 158, 11, 0.3);
                    padding: 3px 12px;
                    border-radius: 20px;
                }
                .homec-why-card__title {
                    color: #ffffff;
                    font-size: 18px;
                    font-weight: 700;
                    margin-bottom: 10px;
                    line-height: 1.35;
                }
                .homec-why-card__text {
                    color: rgba(255, 255, 255, 0.85);
                    font-size: 14px;
                    line-height: 1.6;
                    margin: 0;
                }
            </style>
            <!-- Features -->
            <section class="homec-bg-primary-color pd-top-90 pd-btm-90">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-12 mg-btm-40">
                            <div class="homec-section__head section-white text-center">
                                <span class="homec-section__badge homec-section__badge--small text-white m-0" style="background: rgba(255,255,255,0.2) !important; color: #ffffff !important;" data-aos="fade-in" data-aos-delay="300">{{ $why_choose_us->title }}</span>
                                <h2 class="homec-section__title text-white mg-top-10" data-aos="fade-in" data-aos-delay="400">{{ $why_choose_us->description }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($why_choose_us->items as $why_choose_index => $why_choose_item)
                            @php
                                $w_icon = ($why_choose_item->icon && file_exists(public_path($why_choose_item->icon))) 
                                    ? asset($why_choose_item->icon) 
                                    : asset('uploads/website-images/trusted20230409043232.svg');
                            @endphp
                            <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="{{ 300 + $why_choose_index * 100 }}">
                                <div class="homec-why-card">
                                    <div class="homec-why-card__icon-wrap">
                                        <div class="homec-why-card__icon">
                                            <img src="{{ $w_icon }}" alt="{{ $why_choose_item->title }}">
                                        </div>
                                        <span class="homec-why-card__num">0{{ $why_choose_index + 1 }}</span>
                                    </div>
                                    <h4 class="homec-why-card__title">{{ $why_choose_item->title }}</h4>
                                    <p class="homec-why-card__text">{{ $why_choose_item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- End Features -->
        @endif

       {{-- @if ($setting->agent_can_add_property && $setting->agent_can_add_property == 'enable')
            @if (isset($agent) && $agent->visibility && isset($agent->agents) && count($agent->agents) > 0)
                <!-- Agents -->
                    <section class="homec-about homec-bg-third-color pd-top-120 pd-btm-120">
                        <div class="homec-shape">
                            <div class="homec-shape-single homec-shape-1"><img src="{{ asset('frontend/img/anim-shape-1.svg') }}" alt="icon"></div>
                            <div class="homec-shape-single homec-shape-2"><img src="{{ asset('frontend/img/anim-shape-2.svg') }}" alt="icon"></div>
                            <div class="homec-shape-single homec-shape-3"><img src="{{ asset('frontend/img/anim-shape-3.svg') }}" alt="icon"></div>
                            <div class="homec-shape-single homec-shape-4"><img src="{{ asset('frontend/img/anim-shape-1.svg') }}" alt="icon"></div>
                            <div class="homec-shape-single homec-shape-5"><img src="{{ asset('frontend/img/anim-shape-2.svg') }}" alt="icon"></div>
                            <div class="homec-shape-single homec-shape-6"><img src="{{ asset('frontend/img/anim-shape-3.svg') }}" alt="icon"></div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8  col-md-8 col-12">
                                    <div class="homec-section__head text-center mg-btm-30">
                                        <span class="homec-section__badge homec-section__badge--small homec-primary-color  m-0" data-aos="fade-in" data-aos-delay="300">{{ $agent->title }}</span>
                                        <h2 class="homec-section__title" data-aos="fade-in" data-aos-delay="400">{{ $agent->description }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                @foreach ($agent->agents as $agent_index => $single_agent )
                                    <div class="col-lg-4 col-md-6 col-12 mg-top-30" data-aos="fade-in" data-aos-delay="400">
                                        <!-- Single agent-->
                                        <div class="homec-agent homec-agent__v2">
                                            <!-- Agent Head-->
                                            <div class="homec-agent__head">
                                                @if ($single_agent->image)
                                                <img src="{{ asset($single_agent->image) }}" alt="agent">
                                                @else
                                                <img src="{{ asset($default_user_avatar) }}" alt="agent">
                                                @endif

                                            </div>
                                            <!-- Agent Body -->
                                            <div class="homec-agent__body">
                                                <a class="homec-agent__body--btn" href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => html_decode($single_agent->user_name)]) }}">{{__('user.See Properties')}}</a>
                                                <ul class="homec-agent__social list-none">
                                                    @if ($single_agent->linkedin)
                                                        <li><a href="{{ html_decode($single_agent->linkedin) }}"><i class="fab fa-linkedin-in"></i></a></li>
                                                    @endif

                                                    @if ($single_agent->twitter)
                                                    <li><a href="{{ html_decode($single_agent->twitter) }}"><i class="fab fa-twitter"></i></a></li>
                                                    @endif

                                                    @if ($single_agent->instagram)
                                                    <li><a href="{{ html_decode($single_agent->instagram) }}"><i class="fab fa-instagram"></i></a></li>
                                                    @endif

                                                    @if ($single_agent->facebook)
                                                    <li><a href="{{ html_decode($single_agent->facebook) }}"><i class="fab fa-facebook-f"></i></a></li>
                                                    @endif
                                                </ul>
                                                <h4 class="homec-agent__title position_relitive">

                                                    <a href="{{ route('agent', ['agent_type' => 'agent', 'user_name' => html_decode($single_agent->user_name)]) }}">{{ html_decode($single_agent->name) }}

                                                        @php
                                                        $kyc = Modules\Kyc\Entities\KycInformation::where('user_id',$single_agent->id)->where('status',1)->first();
                                                        @endphp
                                                        @if($kyc)

                                                        <span class="varified-badge">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z">

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
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <!-- End Agents -->
            @endif
        @endif --}}
        @if ($faq->visibility)
            <style>
                .homec-faq-section {
                    background: #f8fafc;
                    padding: 80px 0;
                    position: relative;
                }
                .homec-faq-title {
                    font-size: 32px;
                    font-weight: 800;
                    color: #0f172a;
                    line-height: 1.35;
                    margin-top: 12px;
                    margin-bottom: 30px;
                    text-align: center;
                }
                .homec-faq-accordion .accordion-item {
                    border: 1px solid #e2e8f0;
                    border-radius: 14px !important;
                    overflow: hidden;
                    margin-bottom: 16px;
                    background: #ffffff;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
                    transition: all 0.3s ease;
                }
                .homec-faq-accordion .accordion-item:hover {
                    box-shadow: 0 10px 25px rgba(0,0,0,0.07);
                    border-color: #cbd5e1;
                }
                .homec-faq-accordion .accordion-item.active,
                .homec-faq-accordion .accordion-item:has(.accordion-button:not(.collapsed)) {
                    border-left: 4px solid #6366f1 !important;
                    border-color: #c7d2fe;
                }
                .homec-faq-accordion .accordion-button {
                    font-size: 17px;
                    font-weight: 700;
                    color: #0f172a;
                    background: #ffffff;
                    padding: 20px 24px;
                    box-shadow: none !important;
                    border: none;
                }
                .homec-faq-accordion .accordion-button:not(.collapsed) {
                    color: #6366f1;
                    background: #ffffff;
                }
                .homec-faq-accordion .accordion-body {
                    font-size: 15px;
                    line-height: 1.65;
                    color: #475569;
                    padding: 0 24px 22px 24px;
                    background: #ffffff;
                }
                @media (max-width: 768px) {
                    .homec-faq-title {
                        font-size: 24px;
                    }
                    .homec-faq-section {
                        padding: 50px 0;
                    }
                    .homec-faq-accordion .accordion-button {
                        font-size: 15px;
                        padding: 14px 16px;
                    }
                }
            </style>
            <!-- Faq Area -->
            <section class="homec-faq-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-12">
                            <div class="homec-section__head text-center">
                                <span class="homec-section__badge m-0">{{ $faq->content->short_title ?? 'Frequently Asked Questions' }}</span>
                                <h2 class="homec-faq-title">{{ $faq->content->long_title ?? 'Everything You Need To Know About Buying Property in Indore' }}</h2>
                            </div>
                            <div class="accordion accordion-flush homec-faq-accordion" id="homec-accordion">
                                @foreach ($faq->faqs as $faq_index => $faq_item)
                                    <!-- Single Accordion -->
                                    <div class="accordion-item {{ $faq_index == 0 ? 'active' : '' }}" data-aos="fade-up" data-aos-delay="{{ 300 + $faq_index * 100 }}">
                                        <h2 class="accordion-header" id="homect-1-{{ $faq_index }}">
                                            <button class="accordion-button {{ $faq_index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#ac-collapse1-{{ $faq_index }}">{{ $faq_item->question }}</button>
                                        </h2>
                                        <div id="ac-collapse1-{{ $faq_index }}" class="accordion-collapse collapse {{ $faq_index == 0 ? 'show' : '' }}" data-bs-parent="#homec-accordion">
                                            <div class="accordion-body">{!! nl2br($faq_item->ans ?? $faq_item->answer ?? '') !!}</div>
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
        @endif

        @if ($blog->visibility)
            <style>
                .homec-blog-card {
                    background: #ffffff;
                    border-radius: 16px;
                    overflow: hidden;
                    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                }
                .homec-blog-card:hover {
                    transform: translateY(-6px);
                    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
                }
                .homec-blog-card__img {
                    height: 220px;
                    position: relative;
                    overflow: hidden;
                }
                .homec-blog-card__img img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.5s ease;
                }
                .homec-blog-card:hover .homec-blog-card__img img {
                    transform: scale(1.08);
                }
                .homec-blog-card__badge {
                    position: absolute;
                    top: 15px;
                    left: 15px;
                    background: #6366f1;
                    color: #ffffff;
                    font-size: 11px;
                    font-weight: 700;
                    padding: 4px 12px;
                    border-radius: 20px;
                    text-transform: uppercase;
                }
                .homec-blog-card__body {
                    padding: 24px;
                    display: flex;
                    flex-direction: column;
                    flex-grow: 1;
                }
                .homec-blog-card__title {
                    font-size: 18px;
                    font-weight: 700;
                    color: #0f172a;
                    line-height: 1.4;
                    margin-bottom: 12px;
                }
                .homec-blog-card__title a {
                    color: #0f172a;
                    text-decoration: none;
                    transition: color 0.2s ease;
                }
                .homec-blog-card__title a:hover {
                    color: #6366f1;
                }
                .homec-blog-card__desc {
                    font-size: 14px;
                    color: #64748b;
                    line-height: 1.6;
                    margin-bottom: 20px;
                    flex-grow: 1;
                }
                .homec-blog-card__footer {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    border-top: 1px solid #f1f5f9;
                    padding-top: 16px;
                }
                .homec-blog-card__readmore {
                    font-size: 14px;
                    font-weight: 700;
                    color: #6366f1;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                }
            </style>
            <!-- Blog Area -->
            <section id="blog" class="pd-top-90 pd-btm-110" style="background: #ffffff;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="homec-section__head text-center mg-btm-40">
                                <span class="homec-section__badge m-0">Indore Real Estate Insights</span>
                                <h2 class="homec-section__title mg-top-10">Latest News & Market Trends in Indore MP</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($blog->blogs as $blog_index => $single_blog)
                            @php
                                $b_thumb = ($single_blog->image && file_exists(public_path($single_blog->image))) 
                                    ? asset($single_blog->image) 
                                    : asset('uploads/custom-images/blog--2023-05-07-10-36-45-7664.jpg');
                            @endphp
                            <div class="col-lg-4 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="{{ 300 + $blog_index * 100 }}">
                                <div class="homec-blog-card">
                                    <div class="homec-blog-card__img">
                                        <img src="{{ $b_thumb }}" alt="Indore Blog" onerror="this.onerror=null; this.src='{{ asset('uploads/custom-images/blog--2023-05-07-10-36-45-7664.jpg') }}';">
                                        <span class="homec-blog-card__badge">Indore Real Estate</span>
                                    </div>
                                    <div class="homec-blog-card__body">
                                        <h4 class="homec-blog-card__title">
                                            <a href="{{ route('blog', $single_blog->slug) }}">{{ $single_blog->title }}</a>
                                        </h4>
                                        <p class="homec-blog-card__desc">{{ !empty($single_blog->description) ? Str::limit(strip_tags($single_blog->description), 110) : 'Explore latest property rates, investment hotspots, and legal documentation guides for buying and renting properties in Indore MP.' }}</p>
                                        <div class="homec-blog-card__footer">
                                            <a href="{{ route('blog', $single_blog->slug) }}" class="homec-blog-card__readmore">
                                                Read Article
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
@endsection
