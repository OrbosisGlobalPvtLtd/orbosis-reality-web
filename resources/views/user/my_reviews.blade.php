
@extends('layout')

@section('title')
    <title>{{__('user.My Reviews')}}</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.My Reviews')}}">
    <meta name="description" content="{{__('user.My Reviews')}}">
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
                            <li class="active"><a href="{{ route('user.my-reviews') }}">{{__('user.My Reviews')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.My Reviews')}}</h2>
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
										<h3 class="homec-dashboard__heading m-0">{{__('user.My Reviews')}}</h3>
                                        <div class="homec-pdetails-tab--review">
                                            @foreach ($reviews as $review)
                                                <div class="homec-testimonial homec-testimonial--review homec-border mg-top-30">
                                                    <div class="homec-rating--main mg-btm-15">
                                                        <!-- Author Rating -->
                                                        <ul class="homec-rating list-none">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($review->rating < $i)
                                                                <li><i class="fa-regular fa-star"></i></li>
                                                                @else
                                                                <li><i class="fa-solid fa-star"></i></li>
                                                                @endif
                                                            @endfor
                                                        </ul>
                                                        <span class="homec-primary-color">{{ $review->created_at->format('M d Y') }}</span>
                                                    </div>
                                                    <!-- Testimonial Text -->
                                                    <p class="homec-testimonial__text">“{{ html_decode($review->review) }}”</p>
                                                    <div class="homec-testimonial__bottom">
                                                        <!-- Testimonial Author -->
                                                        <div class="homec-testimonial__author">
                                                            <img src="{{ ($review->property->thumbnail_image)? asset($review->property->thumbnail_image) : asset($setting->default_placeholder)}}" alt="thumbnail_image">
                                                            <div class="homec-testimonial__author--info">
                                                                <h5 class="homec-testimonial__author--title"><a href="{{ route('property', $review->property->slug) }}">{{ $review->property->title }}</a></h5>
                                                                <p class="homec-testimonial__author--position">
                                                                    @if ($review->property->agent)
                                                                    {{ $review->property->agent->name }}
                                                                    @else
                                                                    {{__('user.Administrator')}}
                                                                    @endif

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
										<div class="row mg-top-40">
											<div class="col-12">
												{{ $reviews->links('custom_pagination') }}
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
