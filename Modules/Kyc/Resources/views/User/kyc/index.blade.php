
@extends('layout')

@section('title')
    <title>{{__('admin.Manage Kyc')}}</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('admin.Manage Kyc')}}">
    <meta name="description" content="{{__('admin.Manage Kyc')}}">
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
                            <li class="active"><a href="{{ route('user.kyc') }}">{{__('admin.Manage Kyc')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('admin.Manage Kyc')}}</h2>
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
                                @if ($kyc)
                                    <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                                        <div class="homec-dashboard__inner homec-border">
                                            <h3 class="homec-dashboard__heading m-0">{{__('admin.Manage Kyc')}}</h3>
                                                <!-- Single Properties -->
                                                <div class="homec-dashboard-property mg-top-30">
                                                    @if ($kyc->status == 0)
                                                        <div class="homec-dashboard-property__label" style="background-color: red;">{{__('admin.Pending')}}</div>
                                                    @endif
                                                    @if ($kyc->status == 1)
                                                        <div class="homec-dashboard-property__label">{{__('admin.Approved')}}</div>
                                                    @endif
                                                    @if ($kyc->status == 2)
                                                        <div class="homec-dashboard-property__label"  style="background-color: red;">{{__('admin.Reject')}}</div>
                                                    @endif

                                                    <!-- Property IMG -->
                                                    <div class="homec-dashboard-property__img">
                                                        <img src="{{ asset($kyc->file) }}">
                                                        <!-- Property Content -->
                                                        <div class="homec-dashboard-property__content">
                                                            <h3 class="homec-dashboard-property__title">{{ $kyc->influncer->name}}</h3>
                                                            <div class="homec-property__text">
                                                                <strong>{{__('admin.Document Name')}} : </strong>  {{ $kyc->kyc_type->name}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Property Button -->
                                                </div>
                                                <!-- End Single Properties -->
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                                        <div class="homec-dashboard__inner homec-border">
                                            <h3 class="homec-dashboard__heading m-0">{{__('admin.Manage Kyc')}}</h3>
                                            <form action="{{ route('user.kyc-submit') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 mg-top-20">
                                                        <h4 class="homec-submit-form__heading">{{__('admin.Select Document Type')}} *</h4>
                                                        <div class="form-group homec-form-input">
                                                            <select name="kyc_id" class="homec-form-select homec-border">
                                                                <option value="">{{__('admin.Select Type')}}</option>
                                                                @foreach ($kycType as $type)
                                                                <option {{ $type->id == old('kyc_id') ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 pt-2">
                                                        <div class="form-group homec-form-input">
                                                            <label class="ecom-wc__form-label mg-btm-10">{{__('admin.File')}} *</label>
                                                            <div class="form-group__input">
                                                                <input class="ecom-wc__form-input pt-2" type="file" name="file">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 pt-2">
                                                        <div class="form-group homec-form-input">
                                                            <label class="ecom-wc__form-label mg-btm-10">{{__('admin.Message')}}*</label>
                                                            <div class="form-group__input">
                                                                <textarea class="ecom-wc__form-input" type="text" name="message"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group form-mg-top25">
                                                    <div class="ecom-wc__button ecom-wc__button--bottom">
                                                        <button class="homec-btn homec-btn__second" type="submit"><span>{{__('admin.Save')}}</span></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif


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
