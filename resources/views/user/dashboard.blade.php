
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
        <!-- <div class="homec-overlay"></div> -->
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
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

            <!-- Homec Dashboard -->
		<section class="homec-dashboard pd-top-100 pd-btm-100 homec-bg-third-color">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="homec-dashboard__middle">
							<div class="row">
								<div class="col-lg-3 col-md-4 col-12 mg-top-30">
									@include('user.sidebar')
								</div>
								<div class="col-lg-9 col-md-8 col-12 mg-top-30">
									<div class="homec-dashboard__inner homec-border">
										<h3 class="homec-dashboard__heading m-0">{{__('user.My Dashboard')}}</h3>
										<div class="row">
                                            @if ($setting->agent_can_add_property)
                                                @if ($setting->agent_can_add_property == 'enable')
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <!-- Homec Dashboard Single -->
                                                        <div class="homec-dashboard__single">
                                                            <!-- Dashboard Icon -->
                                                            <div class="homec-dashboard__icon">
                                                                <img src="{{ asset('frontend/img/dash-icon1.svg') }}">
                                                            </div>
                                                            <div class="homec-dashboard__label">{{__('user.Publish Property')}}</div>
                                                            <div class="homec-dashboard__title">{{ $publish_property }}</div>
                                                        </div>
                                                        <!-- End Homec Dashboard Single -->
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <!-- Homec Dashboard Single -->
                                                        <div class="homec-dashboard__single">
                                                            <!-- Dashboard Icon -->
                                                            <div class="homec-dashboard__icon">
                                                                <img src="{{ asset('frontend/img/dash-icon2.svg') }}">
                                                            </div>
                                                            <div class="homec-dashboard__label">{{__('user.Awaiting Property')}}</div>
                                                            <div class="homec-dashboard__title">{{ $awaiting_property }}</div>
                                                        </div>
                                                        <!-- End Homec Dashboard Single -->
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <!-- Homec Dashboard Single -->
                                                        <div class="homec-dashboard__single">
                                                            <!-- Dashboard Icon -->
                                                            <div class="homec-dashboard__icon">
                                                                <img src="{{ asset('frontend/img/dash-icon1.svg') }}">
                                                            </div>
                                                            <div class="homec-dashboard__label">{{__('user.Reject Property')}}</div>
                                                            <div class="homec-dashboard__title">{{ $reject_property }}</div>
                                                        </div>
                                                        <!-- End Homec Dashboard Single -->
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <!-- Homec Dashboard Single -->
                                                        <div class="homec-dashboard__single">
                                                            <!-- Dashboard Icon -->
                                                            <div class="homec-dashboard__icon">
                                                                <img src="{{ asset('frontend/img/dash-icon4.svg') }}">
                                                            </div>
                                                            <div class="homec-dashboard__label">{{__('user.My Order')}}</div>
                                                            <div class="homec-dashboard__title">{{ $total_purchase }}</div>
                                                        </div>
                                                        <!-- End Homec Dashboard Single -->
                                                    </div>
                                                @endif
                                            @endif
											<div class="col-lg-4 col-md-6 col-12">
												<!-- Homec Dashboard Single -->
												<div class="homec-dashboard__single">
													<!-- Dashboard Icon -->
													<div class="homec-dashboard__icon">
														<img src="{{ asset('frontend/img/dash-icon5.svg') }}">
													</div>
													<div class="homec-dashboard__label">{{__('user.Wishlist')}}</div>
													<div class="homec-dashboard__title">{{ $total_wishlist }}</div>
												</div>
												<!-- End Homec Dashboard Single -->
											</div>
											<div class="col-lg-4 col-md-6 col-12">
												<!-- Homec Dashboard Single -->
												<div class="homec-dashboard__single">
													<!-- Dashboard Icon -->
													<div class="homec-dashboard__icon">
														<img src="{{ asset('frontend/img/dash-icon3.svg') }}">
													</div>
													<div class="homec-dashboard__label">{{__('user.Total Review')}}</div>
													<div class="homec-dashboard__title">{{ $total_review }}</div>
												</div>
												<!-- End Homec Dashboard Single -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Dashboard -->

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
