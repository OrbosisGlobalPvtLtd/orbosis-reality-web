
@extends('layout')

@section('title')
    <title>{{__('user.My Profile')}}</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.My Profile')}}">
    <meta name="description" content="{{__('user.My Profile')}}">
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
                            <li class="active"><a href="{{ route('user.my-profile') }}">{{__('user.My Profile')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.My Profile')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <!-- Modal Personal Info -->
		<div class="homec-modal modal fade" id="profile_view" tabindex="-1" aria-labelledby="logoutmodal" aria-hidden="true" >
			<div class="homec-modal__width homec-modal__width--profile modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<button type="button" class="homec-moal__close" data-bs-dismiss="modal" aria-label="Close">
						<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.96538 11.4998C8.84252 11.3642 8.73942 11.243 8.62945 11.1289C5.9368 8.31163 3.24501 5.49253 0.546342 2.68062C0.107304 2.2226 -0.122954 1.71338 0.0660637 1.06407C0.359901 0.0591085 1.48284 -0.323477 2.28531 0.307878C2.42192 0.415649 2.5422 0.546769 2.66335 0.6734C5.31733 3.44669 7.97132 6.22088 10.6227 8.99687C10.7336 9.11272 10.8212 9.25282 10.9501 9.42166C11.1253 9.24743 11.2482 9.13068 11.3651 9.00854C14.0491 6.20292 16.7349 3.39909 19.4147 0.58898C19.8485 0.134548 20.3288 -0.124101 20.956 0.0600065C21.9346 0.347394 22.3212 1.5634 21.6975 2.40222C21.6012 2.53154 21.4844 2.6447 21.3727 2.76055C18.7101 5.54552 16.0467 8.33138 13.3807 11.1128C13.2707 11.2277 13.1264 11.3067 12.9743 11.4208C13.1539 11.622 13.2544 11.7414 13.3618 11.8546C16.0553 14.6719 18.7471 17.4901 21.4449 20.3029C21.8942 20.7717 22.1314 21.2944 21.9269 21.9607C21.6202 22.9576 20.4783 23.3222 19.693 22.6747C19.5702 22.5732 19.4619 22.4511 19.3511 22.3344C16.6876 19.5503 14.0242 16.7653 11.3599 13.9803C11.2499 13.8654 11.1357 13.7558 11.0051 13.6247C10.8788 13.7495 10.7636 13.8564 10.6545 13.9696C7.94812 16.7976 5.24087 19.6212 2.54306 22.4547C2.10918 22.9109 1.61515 23.104 1.02662 22.9325C0.0841064 22.6586 -0.300803 21.4902 0.265392 20.6549C0.37193 20.4978 0.508538 20.3604 0.639133 20.2229C3.30171 17.4371 5.96515 14.653 8.62859 11.868C8.7377 11.754 8.84252 11.6345 8.96538 11.4998Z" fill="#EB5757"></path>
						</svg>
					</button>
					<div class="homec-modal__inner">
						<h3 class="ecom-wc__form-title ecom-wc__form-title__one">{{__('user.Edit Profile')}} <span>{{__('user.To become a best real estate agent on this platform please fill out the form below')}}</span></h3>
						<!-- Sign in Form -->
						<form class="ecom-wc__form-main p-0" method="post" action="{{ route('user.update-profile') }}" enctype="multipart/form-data">
                            @csrf
 							<div class="row">
								<div class="col-12">
									<div class="homec-profile__edit mg-top-20">
										@if ($user->image)
                                        <img id="preview-img" src="{{ asset($user->image) }}" alt="agent">
                                        @else
                                        <img id="preview-img" src="{{ asset($default_user_avatar) }}" alt="agent">
                                        @endif
										<label for="file-input"><span class="homec-pimg"><svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5147 11.5C17.7284 12.7137 18.9234 13.9087 20.1296 15.115C19.9798 15.2611 19.8187 15.4109 19.6651 15.5683C17.4699 17.7635 15.271 19.9587 13.0758 22.1539C12.9334 22.2962 12.7948 22.4386 12.6524 22.5735C12.6187 22.6034 12.5663 22.6296 12.5213 22.6296C11.3788 22.6334 10.2362 22.6297 9.09365 22.6334C9.01498 22.6334 9 22.6034 9 22.536C9 21.4009 9 20.2621 9.00375 19.1271C9.00375 19.0746 9.02997 19.0109 9.06368 18.9772C10.4123 17.6249 11.7609 16.2763 13.1095 14.9277C14.2295 13.8076 15.3459 12.6913 16.466 11.5712C16.4884 11.5487 16.4997 11.5187 16.5147 11.5Z" fill="white"></path><path d="M20.9499 14.2904C19.7436 13.0842 18.5449 11.8854 17.3499 10.6904C17.5634 10.4694 17.7844 10.2446 18.0054 10.0199C18.2639 9.76139 18.5261 9.50291 18.7884 9.24443C19.118 8.91852 19.5713 8.91852 19.8972 9.24443C20.7251 10.0611 21.5492 10.8815 22.3771 11.6981C22.6993 12.0165 22.7105 12.4698 22.3996 12.792C21.9238 13.2865 21.4443 13.7772 20.9686 14.2717C20.9648 14.2792 20.9536 14.2867 20.9499 14.2904Z" fill="white"></path></svg></span></label>
										<input id="file-input" type="file" name="image" onchange="previewThumnailImage(event)">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group homec-form-input">
										<label class="ecom-wc__form-label mg-btm-10">{{__('user.Name')}}*</label>
										<div class="form-group__input">
											<input class="ecom-wc__form-input" type="text" name="name" value="{{ html_decode($user->name) }}">
										</div>
									</div>
								</div>

                                <div class="col-12">
									<div class="form-group homec-form-input">
										<label class="ecom-wc__form-label mg-btm-10">{{__('user.Designation')}}*</label>
										<div class="form-group__input">
											<input class="ecom-wc__form-input" type="text" name="designation" value="{{ html_decode($user->designation) }}">
										</div>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group homec-form-input">
										<label class="ecom-wc__form-label mg-btm-10">{{__('user.Phone Number')}}*</label>
										<div class="form-group__input">
											<input class="ecom-wc__form-input" type="text" name="phone" value="{{ html_decode($user->phone) }}">
										</div>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group homec-form-input">
										<label class="ecom-wc__form-label mg-btm-10">{{__('user.Address')}}*</label>
										<div class="form-group__input">
											<input class="ecom-wc__form-input" type="text" name="address" value="{{ html_decode($user->address) }}">
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group homec-form-input">
										<label class="ecom-wc__form-label mg-btm-10">{{__('user.About Me')}}*</label>
										<div class="form-group__input">
											<textarea class="ecom-wc__form-input" type="text" name="about_me">{{ html_decode($user->about_me) }}</textarea>
										</div>
									</div>
								</div>
								<h4 class="homec-modal-form__middle">{{__('user.Social Link')}}</h4>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group homec-form-input">
											<label class="ecom-wc__form-label mg-btm-10">{{__('user.Facebook')}}</label>
											<div class="form-group__input">
												<input class="ecom-wc__form-input" type="text" name="facebook" value="{{ html_decode($user->facebook) }}">
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group homec-form-input">
											<label class="ecom-wc__form-label mg-btm-10">{{__('user.Twitter')}}</label>
											<div class="form-group__input">
												<input class="ecom-wc__form-input" type="text" name="twitter" value="{{ html_decode($user->twitter) }}">
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group homec-form-input">
											<label class="ecom-wc__form-label mg-btm-10">{{__('user.Instagram')}}</label>
											<div class="form-group__input">
												<input class="ecom-wc__form-input" type="text" name="instagram" value="{{ html_decode($user->instagram) }}">
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group homec-form-input">
											<label class="ecom-wc__form-label mg-btm-10">{{__('user.Linkedin')}}</label>
											<div class="form-group__input">
												<input class="ecom-wc__form-input" type="text" name="linkedin" value="{{ html_decode($user->linkedin) }}">
											</div>
										</div>
									</div>
								</div>

							</div>
							<!-- Form Group -->
							<div class="form-group form-mg-top25">
								<div class="ecom-wc__button ecom-wc__button--bottom">
									<button class="homec-btn homec-btn__second" type="submit"><span>{{__('user.Update Profile')}}</span></button>
								</div>
							</div>
						</form>
						<!-- End Sign in Form -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal  Personal Info -->

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
								<div class="col-lg-9 col-md-8 col-12">
									<div class="homec-dashboard__inner homec-border">
                                        <div class="row mg-top-30">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="homec-dashboard__heading">{{__('user.Personal Information')}}</h3>
                                                <a class="homec-btn homec-btn__second"  data-bs-toggle="modal" data-bs-target="#profile_view"><span>{{__('user.Edit Profile')}}</span></a>
                                            </div>
                                        </div>

                                        <div class="row mg-top-30">
                                            <div class="col-lg-6 col-12">
                                                <div class="homec-agent-detail__img">
                                                    @if ($user->image)
                                                    <img src="{{ asset($user->image) }}" alt="agent">
                                                    @else
                                                    <img src="{{ asset($default_user_avatar) }}" alt="agent">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="homec-agent-detail__body">
                                                    <h3 class="homec-agent-detail__title">{{ html_decode($user->name) }}</h3>
                                                    @if ($user->designation)
                                                    <p>{{ html_decode($user->designation) }}</p>
                                                    @endif

                                                </div>
                                                <ul class="homec-agent-detail__list mg-top-30">
                                                    <li><img src="{{ asset('frontend/img/agent-phone.svg') }}"> {{ html_decode($user->phone) }}</li>


                                                    <li><img src="{{ asset('frontend/img/agent-email.svg') }}"> <a href="mailto:{{ html_decode($user->email) }}">{{ html_decode($user->email) }}</a></li>

                                                    <li><img src="{{ asset('frontend/img/agent-location.svg') }}"> {{ html_decode($user->address) }} </li>

                                                </ul>
                                                <ul class="homec-agent__social homec-agent__social--inline list-none mg-top-30">
                                                    @if ($user->linkedin)
                                                        <li><a href="{{ html_decode($user->linkedin) }}"><i class="fab fa-linkedin-in"></i></a></li>
                                                    @endif

                                                    @if ($user->twitter)
                                                        <li><a href="{{ html_decode($user->twitter) }}"><i class="fab fa-twitter"></i></a></li>
                                                    @endif

                                                    @if ($user->instagram)
                                                        <li><a href="{{ html_decode($user->instagram) }}"><i class="fab fa-instagram"></i></a></li>
                                                    @endif

                                                    @if ($user->facebook)
                                                        <li><a href="{{ html_decode($user->facebook) }}"><i class="fab fa-facebook-f"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="homec-agent-detail__sticky">
                                        <div class="homec-agent-detail__inside">
                                            <div class="homec-agent-detail__sticky--heading">
                                                <h2 class="homec-agent-detail__sticky--title">{{__('user.About Me')}}</h2>
                                            </div>
                                            <p class="homec-agent-detail__sticky--text">{{ html_decode($user->about_me) }}</p>
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

    <script>
    "use strict";

        function previewThumnailImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('preview-img');
                output.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection
