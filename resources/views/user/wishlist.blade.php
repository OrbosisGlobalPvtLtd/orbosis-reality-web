
@extends('layout')

@section('title')
    <title>{{__('user.Wishlist')}}</title>
@endsection

@section('meta')
    <meta name="description" content="{{__('user.Wishlist')}}">
    <meta name="title" content="{{__('user.Wishlist')}}">
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
                            <li class="active"><a href="{{ route('user.wishlist') }}">{{__('user.Wishlist')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Wishlist')}}</h2>
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
										<h3 class="homec-dashboard__heading m-0">{{__('user.Wishlist')}}</h3>
                                        <div class="row">
                                            @foreach ($properties as $property_item)
                                                <div class="col-12 mg-top-30">
                                                    <!-- Single property-->
                                                    <div class="homec-property homec-property__list-style">
                                                        <!-- Property Head-->
                                                        <div class="homec-property__head">
                                                            <img src="{{ ($property_item->thumbnail_image)? asset($property_item->thumbnail_image) : asset($setting->default_placeholder)}}">
                                                            <!-- Top Sticky -->
                                                            <div class="homec-property__hsticky">
                                                                <div class="homec-heart-df">
                                                                <a href="javascript:;" onclick="deleteDocument({{ $property_item->id }})" class="homec-heart">
                                                                    <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M10.5745 3.73257L11.1008 4.69447L11.6272 3.73258C11.9704 3.10535 12.5438 2.26267 13.3886 1.60933C14.2595 0.935774 15.2355 0.6 16.3044 0.6C19.29 0.6 21.6017 3.03446 21.6017 6.3966C21.6017 8.18186 20.8932 9.70959 19.5597 11.3187C18.211 12.9462 16.2694 14.6033 13.8617 16.6552L14.2508 17.1119L13.8617 16.6552L13.8611 16.6557C13.0479 17.3487 12.1237 18.1363 11.1625 18.9769L11.1623 18.977C11.1457 18.9916 11.1241 18.9999 11.1008 18.9999C11.0776 18.9999 11.056 18.9916 11.0394 18.9771L11.0391 18.9768C10.0784 18.1367 9.15452 17.3493 8.34203 16.6569L8.34054 16.6556L8.34053 16.6556C5.93251 14.6035 3.99081 12.9463 2.64202 11.3188C1.30844 9.70958 0.6 8.18186 0.6 6.3966C0.6 3.03446 2.91167 0.6 5.89732 0.6C6.96614 0.6 7.94219 0.935773 8.81311 1.60933C9.6579 2.26267 10.2313 3.10532 10.5745 3.73257Z" stroke-width="1.2"/>
                                                                    </svg>
                                                                    </a>
                                                                    <a href="javascript:;" class="homec-heart add-to-compare" data-property-id="{{ $property_item->id }}">
                                                                        <span>
                                                                            <i class="fa-solid fa-shuffle"></i>
                                                                        </span>
                                                                    </a>
                                                                </div>

                                                                <span class="homec-property__salebadge">

                                                                    @if ($property_item->purpose == 'rent')
                                                                        {{__('user.For Rent')}}
                                                                    @else
                                                                        {{__('user.For Sale')}}
                                                                    @endif
                                                                </span>
                                                                <form class="d-none" action="{{ route('user.remove-wishlist', $property_item->id) }}" method="POST" id="remove_wishlist-{{ $property_item->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>

                                                            </div>
                                                            <!-- End Top Sticky -->
                                                        </div>
                                                        <!-- Property Body-->
                                                        <div class="homec-property__body">
                                                            <div class="homec-property__topbar">
                                                                <div class="homec-property__price">{{ html_decode(num_format($property_item->price)) }}
                                                                    @if ($property_item->purpose == 'rent')
                                                                    <span>/{{ $property_item->rent_period }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <h3 class="homec-property__title"><a href="{{ route('property', $property_item->slug) }}">{{ html_decode($property_item->title) }}</a></h3>
                                                            <div class="homec-property__text">
                                                                <img src="{{ asset('frontend/img/location-icon.svg') }}" alt="address"><p>{{ html_decode($property_item->address) }}</p>
                                                            </div>

                                                            <!-- Property List-->
                                                            <ul class="homec-property__list homec-border-top list-none">
                                                                <li><img src="{{ asset('frontend/img/room-icon2.svg') }}" alt="total_bedroom">{{ $property_item->total_bedroom }} {{__('user.Bed')}}</li>
                                                                <li><img src="{{ asset('frontend/img/bath-icon2.svg') }}" alt="total_bathroom">{{ $property_item->total_bathroom }} {{__('user.Bath')}}</li>
                                                                <li><img src="{{ asset('frontend/img/size-icon2.svg') }}" alt="total_area">{{ html_decode($property_item->total_area) }} {{__('user.m2')}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- End Single property-->
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="row mg-top-40">
											<div class="col-12">
												{{ $properties->links('custom_pagination') }}
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

    function deleteDocument(id){
        Swal.fire({
            title: "{{__('user.Are you realy want to delete this item ?')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{__('user.Yes, Delete It')}}",
            cancelButtonText: "{{__('user.Cancel')}}",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#remove_wishlist-"+id).submit();
            }

        })
    }
</script>
@endsection
