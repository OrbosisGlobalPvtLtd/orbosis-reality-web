@extends('layout')
@section('title')
    <title>{{__('user.FAQ')}}</title>
@endsection
@section('meta')
    <meta name="title" content="{{__('user.FAQ')}}">
    <meta name="description" content="{{__('user.FAQ')}}">
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
                            <li class="active"><a href="{{ route('faq') }}">{{__('user.FAQ')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.FAQ')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->


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


     	<!-- Download App -->
		<section class="download-app homec-bg-cover homec-bg-primary-color pd-top-15 pd-btm-15" style="background-image:url({{ asset($mobile_app->app_bg) }})">
			<div class="homec-shape">
				<div class="homec-shape-single homec-shape-11"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="shape"></div>
				<div class="homec-shape-single homec-shape-12"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="shape"></div>
				<div class="homec-shape-single homec-shape-13"><img src="{{ asset('frontend/img/anim-shape-10.svg') }}" alt="shape"></div>
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
