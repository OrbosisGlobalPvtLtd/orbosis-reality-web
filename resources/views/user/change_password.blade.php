
@extends('layout')

@section('title')
    <title>{{__('user.Change Password')}}</title>
@endsection

@section('meta')
    <meta name="description" content="{{__('user.Change Password')}}">
    <meta name="title" content="{{__('user.Change Password')}}">
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
                            <li class="active"><a href="{{ route('user.change-password') }}">{{__('user.Change Password')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Change Password')}}</h2>
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
										<div class="row">
											<div class="col-lg-7 col-12">
												<h3 class="ecom-wc__form-title homec-dashboard__password">{{__('user.Change Password')}} <span class="pd-btm-30">{{__('user.Do you want to change your previous password ? please fill out the form below')}}</span></h3>
												<!-- Sign in Form -->
												<form class="ecom-wc__form-main p-0" action="{{ route('user.update-password') }}" method="post">
                                                    @csrf
													<div class="row">
														<div class="col-12">
															<div class="form-group homec-form-input">
																<label class="ecom-wc__form-label mg-btm-10">{{__('user.Current Password')}}*</label>
																<div class="form-group__input">
																	<input class="ecom-wc__form-input" placeholder="●●●●●●" id="password-field1" type="password" name="current_password">
																</div>
															</div>
														</div>

                                                        <div class="col-12">
															<div class="form-group homec-form-input">
																<label class="ecom-wc__form-label mg-btm-10">{{__('user.Password')}}*</label>
																<div class="form-group__input">
																	<input class="ecom-wc__form-input" placeholder="●●●●●●" id="password-field" type="password" name="password">
																</div>
															</div>
														</div>


														<div class="col-12">
															<div class="form-group homec-form-input">
																<label class="ecom-wc__form-label mg-btm-10">{{__('user.Confirm Password')}}*</label>
																<div class="form-group__input">
																	<input class="ecom-wc__form-input" placeholder="●●●●●●" id="password-field" type="password" name="password_confirmation" >
																</div>
															</div>
														</div>
													</div>
													<!-- Form Group -->
													<div class="form-group form-mg-top25">
														<div class="ecom-wc__button ecom-wc__button--bottom">
															<button class="homec-btn homec-btn__second" type="submit"><span>{{__('user.Update Password')}}</span></button>
														</div>
													</div>
												</form>
												<!-- End Sign in Form -->
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
