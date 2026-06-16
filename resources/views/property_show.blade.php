@extends('layout')

@section('title')
    <title>{{ html_decode($property->seo_title) }}</title>
@endsection

@section('meta')
    <meta name="title" content="{{ html_decode($property->seo_title) }}">
    <meta name="description" content="{{ html_decode($property->seo_meta_description) }}">
    <meta name="keywords" content="{{ html_decode($property->seo_title) }}">
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

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
                            <li class="active"><a href="{{ route('properties',['purpose' => 'any']) }}">{{__('user.Properties')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Property Details')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <section class="pd-top-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
						<div class="homec-property-slides">
							<div class="homec-property-main">
								<div class="flexslider" id="f1">
									<ul class="slides">
									    @foreach($sliders as $index => $slider)
										<li>
											<div class="homec-image-gallery">
												<!-- Amount Card -->
												<div class="homec-amount-card homec-amount-card__sticky">
<h4 class="homec-amount-card__amount">
{{ $setting->currency_icon }}{{ number_format($property->total_price, 2) }}
<!-- {{ html_decode(num_format($property->price)) }} -->
@if ($property->purpose == 'rent')
<span>{{ $property->rent_period }}</span>
@endif
</h4>
					
                    							</div>
												<!-- End Amount Card -->
												<div class="homec-overlay"></div>
												<img src="{{ ($slider->image)? asset($slider->image) : asset($setting->default_placeholder)}}" alt="#">
												<div class="homec-image-gallery__bottom">
													<div class="homec-image-gallery__content">
														<h3 class="homec-image-gallery__title">{{ $property->title }}</h3>
														<p class="homec-image-gallery__text">
														<img src="{{ asset('frontend/img/map-icon.svg')}}" alt="#">
														{{ $property->address }} </p>
													</div>
												</div>
											</div>
										</li>
										@endforeach

									</ul>
								</div>
								<div class="homec-property-thumbs--top">
    								<div class="homec-property-thumbs mg-top-10">
    									<div class="flexslider carousel" id="f2">
    										<ul class="slides">
    										    @foreach($sliders as $index => $slider)
    											<li>
    												<div class="single-thumbs">
    													<img src="{{ ($slider->image)? asset($slider->image) : asset($setting->default_placeholder)}}" alt="thumbs">
    												</div>
    											</li>
    											@endforeach

    										</ul>
    									</div>
    								</div>
								</div>
							</div>
						</div>
					</div>
            </div>
            <div class="row pd-top-10 pd-btm-50">
                <div class="col-12">
                    <div class="pd-features">
                        <!-- Pd Features -->
                        <div class="pd-features__single mg-top-30">
                            <div class="pd-features__icon">
                                <img src="{{ asset('frontend/img/pd-icon-1.svg') }}">
                            </div>
                            <h4 class="pd-features__title">{{__('user.Area')}}</h4>
                            <p class="pd-features__text">{{ html_decode($property->total_area) }}{{__('user.m2')}}</p>
                        </div>
                        <!-- End Pd Features -->
                        <!-- Pd Features -->
                        <div class="pd-features__single mg-top-30">
                            <div class="pd-features__icon">
                                <img src="{{ asset('frontend/img/pd-icon-2.svg') }}">
                            </div>
                            <h4 class="pd-features__title">{{__('user.Unit')}}</h4>
                            <p class="pd-features__text">{{ $property->total_unit }} {{__('user.Unit')}}</p>
                        </div>
                        <!-- End Pd Features -->
                         <!-- Pd Features -->
                         <div class="pd-features__single mg-top-30">
                            <div class="pd-features__icon">
                                <img src="{{ asset('frontend/img/pd-icon-3.svg') }}">
                            </div>
                            <h4 class="pd-features__title">{{__('user.Bedroom')}}</h4>
                            <p class="pd-features__text">{{ $property->total_bedroom }} {{__('user.Bedroom')}}</p>
                        </div>
                        <!-- End Pd Features -->
                         <!-- Pd Features -->
                         <div class="pd-features__single mg-top-30">
                            <div class="pd-features__icon">
                                <img src="{{ asset('frontend/img/pd-icon-4.svg') }}">
                            </div>
                            <h4 class="pd-features__title">{{__('user.Bath Room')}}</h4>
                            <p class="pd-features__text">{{ $property->total_bathroom }} {{__('user.Bath Room')}}</p>
                        </div>
                        <!-- End Pd Features -->
                         <!-- Pd Features -->
                         <div class="pd-features__single mg-top-30">
                            <div class="pd-features__icon">
                                <img src="{{ asset('frontend/img/pd-icon-5.svg') }}">
                            </div>
                            <h4 class="pd-features__title">{{__('user.Garage')}}</h4>
                            <p class="pd-features__text">{{ $property->total_garage }} {{__('user.Garage')}}</p>
                        </div>
                        <!-- End Pd Features -->
                         <!-- Pd Features -->
                         <div class="pd-features__single mg-top-30">
                            <div class="pd-features__icon">
                                <img src="{{ asset('frontend/img/pd-icon-6.svg') }}">
                            </div>
                            <h4 class="pd-features__title">{{__('user.Kitchen')}}</h4>
                            <p class="pd-features__text">{{ $property->total_kitchen }} {{__('user.Kitchen')}}</p>
                        </div>
                        <!-- End Pd Features -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="pd-top-0 homec-bg-third-color pd-btm-80 homec-bg-cover homec-property-single-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ol-12">
                    <div class="list-group homec-list-tabs homec-list-tabs--v2" id="list-tab" role="tablist">
                        <a class="list-group-item active" data-bs-toggle="list" href="#homec-pd-tab1" role="tab">{{__('user.Property Details')}}</a>
                        <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab2" role="tab">{{__('user.Property Plan')}}</a>
                        <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab3" role="tab">{{__('user.Video')}} </a>
                        <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab4" role="tab">{{__('user.Locations')}} </a>
                        <a class="list-group-item" data-bs-toggle="list" href="#homec-pd-tab5" role="tab">{{__('user.Review')}}</a>
                    </div>

                    <div class="homec-pdetails-tab">
                        <div class="tab-content" id="nav-tabContent">
                            <!--  Property Details -->
                            <div class="tab-pane fade show active" id="homec-pd-tab1" role="tabpanel">
                                <div class="homec-pdetails-tab__inner">
                                    {!! html_decode(clean($property->description)) !!}
                                    <!-- Homec Features -->
                                    @if ($additional_informations->count() > 0)
                                        <div class="homec-ptdetails-features mg-top-30">
                                            <h4 class="homec-ptdetails-features__title">{{__('user.Additional Information')}}</h4>
                                            <ul class="homec-ptdetails-features__list">
                                                @foreach ($additional_informations as $additional_information)
                                                <li><b>{{ html_decode($additional_information->add_key) }}:</b> <span>{{ html_decode($additional_information->add_value) }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <!-- End Homec Features -->
                                    @if ($nearest_locations->count() > 0)
                                        <!-- Homec Features -->
                                        <div class="homec-ptdetails-features mg-top-30">
                                            <h4 class="homec-ptdetails-features__title">{{__('user.Nearest Location')}}</h4>
                                            <ul class="homec-ptdetails-features__list">
                                                @foreach ($nearest_locations as $nearest_location)
                                                <li><b>{{ $nearest_location->location->location }}:</b> <span>{{ html_decode($nearest_location->distance) }}{{__('user.KM')}}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End Homec Features -->
                                    @endif

                                    @if ($aminities->count() > 0)
                                        <!-- Homec Features -->
                                        <div class="homec-ptdetails-features mg-top-30">
                                            <h4 class="homec-ptdetails-features__title">{{__('user.Aminities')}}</h4>
                                            <ul class="homec-ptdetails-features__list">
                                                @foreach ($aminities as $aminity)
                                                <li><b><i class="fas fa-check"></i> {{ $aminity->aminity->aminity }}</b></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- End Homec Features -->
                                    @endif
                                </div>
                            </div>
                            <!--  End Property Details -->
                            <!--  Floor Plans -->
                            <div class="tab-pane fade" id="homec-pd-tab2" role="tabpanel">
                                <div class="homec-pdetails-tab__inner">
                                    <div class="homec-accordion accordion accordion-flush" id="homec-accordion">

                                        @foreach ($property_plans as $plan_index => $property_plan)
                                            <!-- Single Accordion -->
                                            <div class="accordion-item homec-accordion__single homec-accordion__single--floor mg-top-20">
                                                <h2 class="accordion-header" id="homect-1-{{ $plan_index }}">
                                                    <button class="accordion-button collapsed homec-accordion__heading homec-accordion__heading--floor" type="button" data-bs-toggle="collapse" data-bs-target="#ac-collapseOne-{{ $plan_index }}" >{{ html_decode($property_plan->title) }}</button>
                                                </h2>
                                                <div id="ac-collapseOne-{{ $plan_index }}" class="accordion-collapse collapse {{ $plan_index == 0 ? 'show' : '' }}" aria-labelledby="homect-1-{{ $plan_index }}" data-bs-parent="#homec-accordion">
                                                    <div class="accordion-body homec-accordion__body homec-accordion__body--floor">
                                                        <div class="floor-plan-img">
                                                            <img src="{{ ($property_plan->image)? asset($property_plan->image) : asset($setting->default_placeholder)}}">
                                                        </div>
                                                        <div class="floor-plan-content">
                                                            <p>{{ html_decode($property_plan->description) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Accordion -->
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--  End Floor Plans -->
                            <!--  Property Video -->
                            <div class="tab-pane fade" id="homec-pd-tab3" role="tabpanel">
                                <div class="homec-pdetails-tab__inner">
                                    <p>{{ html_decode($property->video_description) }}</p>
                                    <!-- Homec Features -->
                                    <div class="homec-ptdetails-video">
                                        <div class="homec-overlay"></div>
                                       <img src="{{ ($property->video_thumbnail)? asset($property->video_thumbnail) : asset($setting->default_placeholder)}}">
                                       <div class="homec-ptdetails-video__video">
                                            <a data-video-id="{{ $property->video_id }}" class="js-video-btn homec-btn homec-btn__second homec-btn__video">
                                                <div class="homec-btn__inside">
                                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M24 45.6001C35.9293 45.6001 45.6001 35.9296 45.6001 24C45.6001 12.0707 35.9296 2.39995 24 2.39995C12.0707 2.39995 2.39995 12.0707 2.39995 24C2.39995 35.9293 12.0707 45.6001 24 45.6001ZM24 48C37.2547 48 48 37.2547 48 24C48 10.7451 37.2547 0 24 0C10.7451 0 0 10.7451 0 24C0 37.2547 10.7451 48 24 48Z" fill="#111111"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M30.2363 24L19.1998 16.6424V31.3579L30.2363 24ZM32.4661 22.6023C33.4637 23.2673 33.4637 24.733 32.4661 25.3981L19.4115 34.1013C18.2951 34.8456 16.7996 34.0451 16.7996 32.7033V15.297C16.7996 13.9552 18.2951 13.1549 19.4115 13.8993L32.4661 22.6023Z" fill="#111111"/>
                                                    </svg>
                                                    <span>{{__('user.Play Video')}}</span>
                                                </div>
                                            </a>
                                       </div>

                                    </div>
                                    <!-- End Homec Features -->
                                </div>

                            </div>
                            <!--  End Property Video -->
                            <!--  Property Map -->
                            <div class="tab-pane fade" id="homec-pd-tab4" role="tabpanel">
                                <div class="homec-pdetails-tab__inner m-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="homec-location-card mg-top-20">
                                                <div class="homec-location-card__icon">
                                                    <svg width="31" height="35" viewBox="0 0 31 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M21.1 22.9899C24.8026 17.1798 24.3372 17.9046 24.4439 17.7531C25.7919 15.8518 26.5044 13.6139 26.5044 11.2814C26.5044 5.09565 21.4848 0 15.291 0C9.11739 0 4.0776 5.08559 4.0776 11.2814C4.0776 13.6124 4.80505 15.9088 6.19728 17.8358L9.48193 22.9899C5.97009 23.5296 0 25.1379 0 28.6791C0 29.9701 0.842569 31.8097 4.85656 33.2433C7.65937 34.2443 11.365 34.7956 15.291 34.7956C22.6324 34.7956 30.582 32.7247 30.582 28.6791C30.582 25.1373 24.6189 23.5307 21.1 22.9899ZM7.90029 16.7144C7.88908 16.6969 7.87739 16.6798 7.86515 16.6629C6.70664 15.0691 6.11641 13.1802 6.11641 11.2814C6.11641 6.18314 10.2216 2.0388 15.291 2.0388C20.3499 2.0388 24.4656 6.18498 24.4656 11.2814C24.4656 13.1833 23.8865 15.0081 22.7907 16.5599C22.6925 16.6894 23.2048 15.8935 15.291 28.3114L7.90029 16.7144ZM15.291 32.7568C7.27213 32.7568 2.0388 30.3997 2.0388 28.6791C2.0388 27.5227 4.72785 25.6213 10.6866 24.8801L14.4313 30.7561C14.6185 31.0499 14.9427 31.2277 15.2909 31.2277C15.6392 31.2277 15.9635 31.0498 16.1506 30.7561L19.8952 24.8801C25.8541 25.6213 28.5432 27.5227 28.5432 28.6791C28.5432 30.3851 23.357 32.7568 15.291 32.7568Z"/>
                                                        <path d="M15.2923 6.18457C12.4818 6.18457 10.1953 8.47109 10.1953 11.2816C10.1953 14.0921 12.4818 16.3786 15.2923 16.3786C18.1028 16.3786 20.3893 14.0921 20.3893 11.2816C20.3893 8.47109 18.1028 6.18457 15.2923 6.18457ZM15.2923 14.3398C13.606 14.3398 12.2341 12.9679 12.2341 11.2816C12.2341 9.59528 13.606 8.22337 15.2923 8.22337C16.9786 8.22337 18.3505 9.59528 18.3505 11.2816C18.3505 12.9679 16.9786 14.3398 15.2923 14.3398Z" />
                                                    </svg>
                                                </div>
                                                <h4 class="homec-location-card__title">{{__('user.Address')}}</h4>
                                                <p  class="homec-location-card__desc">{{ html_decode($property->address) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="homec-location-card mg-top-20">
                                                <p  class="homec-location-card__text">{{ html_decode($property->address_description) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if($setting->live_map == 'yes' && !empty($property->lat) && !empty($property->lon))
                                        <div class="homec-gmap-canvas mg-top-30" id="map">
                                        </div>
                                    @else
                                        <div class="homec-gmap-canvas mg-top-30">
                                            {!! html_decode($property->google_map) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--  End Property Map -->
                            <!--  Property Review -->
                            <div class="tab-pane fade" id="homec-pd-tab5" role="tabpanel">
                                <div class="homec-pdetails-tab__inner">
                                   <div class="homec-pdetails-tab--review">

                                        @foreach ($reviews as $review_item)
                                        <div class="homec-testimonial homec-testimonial--review homec-border mg-top-30">
                                            <div class="homec-rating--main mg-btm-15">
                                                <!-- Author Rating -->
                                                <ul class="homec-rating list-none">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($review_item->rating < $i)
                                                        <li><i class="fa-regular fa-star"></i></li>
                                                        @else
                                                        <li><i class="fa-solid fa-star"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                                <span class="homec-primary-color">{{ $review_item->created_at->format('M d Y') }}</span>
                                            </div>
                                            <!-- Testimonial Text -->
                                            <p class="homec-testimonial__text">“{{ html_decode($review_item->review) }}”</p>
                                            <div class="homec-testimonial__bottom">
                                                <!-- Testimonial Author -->
                                                <div class="homec-testimonial__author">
                                                    @if ($review_item->user->image)
                                                    <img src="{{ asset($review_item->user->image) }}" alt="image">
                                                    @else
                                                    <img src="{{ asset($default_user_avatar) }}" alt="default_user_avatar">
                                                    @endif

                                                    <div class="homec-testimonial__author--info">
                                                        <h5 class="homec-testimonial__author--title">{{ html_decode($review_item->user->name) }}</h5>
                                                        <p class="homec-testimonial__author--position">{{ html_decode($review_item->user->designation) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="row mg-top-40">
                                            {{ $reviews->links('custom_pagination') }}
                                        </div>

                                   </div>

                                   @auth('web')
                                    <div class="col-12 d-flex justify-content-center mg-top-40">
                                            <div class="homec-comments-form homec-comments-form--reviews">
                                                <h2 class="homec-comments-form__title m-0">{{__('user.Submit your review')}}</h2>
                                                <p class="homec-comments-form__text">{{__('user.Your email address will not be published. Required fields are marked')}} *</p>
                                                <form id="reviewForm">

                                                    @csrf
                                                    <input type="hidden" name="agent_id" value="{{ $property->agent_id }}">
                                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                                    <input type="hidden" id="property_rating" name="rating" value="5">

                                                    <div class="row">
                                                        <div class=" col-12">
                                                            <div class="form-group homec-form-input homec-form-input--review">
                                                                <ul class="homec-rating list-none">
                                                                    <li><i onclick="propertyReview(1)" data-rating="1" class="property_rat fa-solid fa-star"></i></li>
                                                                    <li><i onclick="propertyReview(2)" data-rating="2" class="property_rat fa-solid fa-star"></i></li>
                                                                    <li><i onclick="propertyReview(3)" data-rating="3" class="property_rat fa-solid fa-star"></i></li>
                                                                    <li><i onclick="propertyReview(4)" data-rating="4" class="property_rat fa-solid fa-star"></i></li>
                                                                    <li><i onclick="propertyReview(5)" data-rating="5" class="property_rat fa-solid fa-star"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group homec-form-input">
                                                                <textarea class="ecom-wc__form-input" name="review" placeholder="{{__('user.Type here')}}"></textarea>
                                                            </div>
                                                        </div>

                                                        @if($recaptcha_setting->status==1)
                                                            <div class="col-12">
                                                                <div class="form-group homec-form-input">
                                                                    <div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <div class="col-12 d-flex mg-top-20">
                                                            <button type="submit" class="homec-btn homec-btn__second"><span>{{__('user.Submit Now')}}</span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                            <!--  End Property Review -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="my-4">
                        <button id="run" class="homec-btn homec-btn__second homec-property-ag__button"><span>{{ __('user.Book Now') }}</span></button>
                    </div>
                    <!-- Property Agent Card -->
                    <div class="homec-property-ag homec-property-ag--side homec-bg-cover homec-agent-side-cover">
                        <h3 class="homec-property-ag__title">{{__('user.Property Agent')}}</h3>
                        <!-- Property Profile -->
                        <div class="homec-property-ag__author">
                            <div class="homec-property-ag__author--img">
                                @if ($property_agent->image)
                                <img src="{{ asset($property_agent->image) }}" alt="image">
                                @else
                                <img src="{{ asset($default_user_avatar) }}" alt="image">
                                @endif

                            </div>

                            <div class="homec-property-ag__author--content">
                                <h4 class="homec-property-ag__author--title position_relitive">
                                <a class="verifies_df" href="{{ route('agent', ['agent_type' => $property_agent->agent_type, 'user_name' => $property_agent->user_name]) }}">{{ $property_agent->name }}
                                    @php
                                        $kyc = Modules\Kyc\Entities\KycInformation::where('user_id',$property_agent->id)->where('status',1)->first();
                                    @endphp
                                    @if($kyc)

                                            <span class="varified-badge" >
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z"></path></svg>
                                            </span>
                                    @endif



                                </a>
                                <span><a href="tel:{{ $property_agent->phone }}">{{__('user.Call')}} : {{ $property_agent->phone }}</a></span>
                                </h4>
                            </div>
                        </div>

                        <!-- End Property Profile -->
                        <form id="agentEmailForm" class="homec-property-ag__form" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="{{__('user.Name')}}">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="{{__('user.Email')}}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="{{__('user.Subject')}}">
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="{{__('user.Type message')}}"></textarea>
                            </div>
                            @if($recaptcha_setting->status==1)
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ $recaptcha_setting->site_key }}"></div>
                                </div>
                            @endif

                            <input type="hidden" name="agent_email" value="{{ $property_agent->email }}">
                            <button id="agentEmailBtnId" type="submit" class="homec-btn homec-btn__second homec-property-ag__button homc-white-bg-button"><span>{{__('user.Send Message Now')}}</span></button>
                        </form>
                    </div>
                    <!-- End Property Agent Card -->

                  <!-- calculet Property Agent Card -->
                    <div class="calculate-box">
						<div class="calculate-box-text">
							<h4>{{__('user.Calculate Your Mortgage')}}</h4>

							<p>{{__('user.You can calculate monthly loan amount using this calcutator')}}</p>
						</div>

						<div class="calculate-box-lone-amount">

							<label> {{__('user.Loan Amount')}} </label>
							<input class="form-control" id="loan-amount" placeholder="0">
						</div>
						<div class="calculate-box-lone-amount-two">
							<div class="calculate-box-lone-amount-text-one">
								<p>{{__('user.Percentage rate')}}</p>
							</div>
							<div class="calculate-box-lone-amount-text">
								<div class="left">
                                <input class="low" id="amt" name="amt" type="text"  placeholder="0"    value="0">
								</div>
								<div class="right">
                                <input  id="amt" name="amt" type="text"  placeholder="0"    value="100%">
								</div>
							</div>
                        <div class="chrome">
                      <input id="annualInterest" min="0" max="100" type="range" value="0" />
                    </div>

					<div class="calculate-box-lone-amount-two lculate-box-lone-amount-three ">
                        <div class="calculate-box-lone-amount-text-one">
                            <p>{{__('user.Loan Term (Years)')}}</p>
                        </div>
                        <div class="calculate-box-lone-amount-text">
                            <div class="left">
                            <input class="year" id="yearn-range" type="text"  placeholder="0"    value="Y0">
                            </div>
                            <div class="right">
                            <input class="year" id="yearn-range" type="text"  placeholder="0"    value="Y5">
                            </div>
                        </div>
                        <div class="chrome">
                            <input id="tearmYear"  type="range" min="0" max="5" step="1" list="data" value="0" />
                        </div>
					</div>

                    <div class="calculate-box-lone-amount-btn">
                        <a href="javascript:;" id="sbt" class="homec-btn"><span>{{__('user.Calculate')}}</span></a>
                        <a href="javascript:;" id="resetBtn" class="reset-btn">
                            <span><i class="fa-solid fa-rotate-right"></i></span>
                            {{__('user.Reset Form')}}
                        </a>
                    </div>
                    <div class="calculate-payment">
                        <div class="calculate-payment-left">
                            <h5>{{__('user.Monthly payment')}}</h5>
                        </div>
                        <div class="calculate-payment-right">
                        <h2>{{ $currency_icon }}</h2><h2 id="monthlyPayment">0</h2>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

        <!-- Modal book Info -->
		<div class="homec-modal modal fade" id="profile_view" tabindex="-1" aria-labelledby="logoutmodal" aria-hidden="true" >
			<div class="homec-modal__width homec-modal__width--profile modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<button type="button" class="homec-moal__close" data-bs-dismiss="modal" aria-label="Close">
						<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.96538 11.4998C8.84252 11.3642 8.73942 11.243 8.62945 11.1289C5.9368 8.31163 3.24501 5.49253 0.546342 2.68062C0.107304 2.2226 -0.122954 1.71338 0.0660637 1.06407C0.359901 0.0591085 1.48284 -0.323477 2.28531 0.307878C2.42192 0.415649 2.5422 0.546769 2.66335 0.6734C5.31733 3.44669 7.97132 6.22088 10.6227 8.99687C10.7336 9.11272 10.8212 9.25282 10.9501 9.42166C11.1253 9.24743 11.2482 9.13068 11.3651 9.00854C14.0491 6.20292 16.7349 3.39909 19.4147 0.58898C19.8485 0.134548 20.3288 -0.124101 20.956 0.0600065C21.9346 0.347394 22.3212 1.5634 21.6975 2.40222C21.6012 2.53154 21.4844 2.6447 21.3727 2.76055C18.7101 5.54552 16.0467 8.33138 13.3807 11.1128C13.2707 11.2277 13.1264 11.3067 12.9743 11.4208C13.1539 11.622 13.2544 11.7414 13.3618 11.8546C16.0553 14.6719 18.7471 17.4901 21.4449 20.3029C21.8942 20.7717 22.1314 21.2944 21.9269 21.9607C21.6202 22.9576 20.4783 23.3222 19.693 22.6747C19.5702 22.5732 19.4619 22.4511 19.3511 22.3344C16.6876 19.5503 14.0242 16.7653 11.3599 13.9803C11.2499 13.8654 11.1357 13.7558 11.0051 13.6247C10.8788 13.7495 10.7636 13.8564 10.6545 13.9696C7.94812 16.7976 5.24087 19.6212 2.54306 22.4547C2.10918 22.9109 1.61515 23.104 1.02662 22.9325C0.0841064 22.6586 -0.300803 21.4902 0.265392 20.6549C0.37193 20.4978 0.508538 20.3604 0.639133 20.2229C3.30171 17.4371 5.96515 14.653 8.62859 11.868C8.7377 11.754 8.84252 11.6345 8.96538 11.4998Z" fill="#EB5757"></path>
						</svg>
					</button>
					<div class="homec-modal__inner">
                        <h4 class="homec-submit-form__title mt-5">{{__('user.Booking Details')}}</h4>
                        <form action="{{ route('booking.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="property_id" value="{{$property->id}}">
                            <input type="hidden" name="agent_id" value="{{$property->agent_id}}">
                            <div class="row">
                                <div class="col-6">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Date')}} <span class="text-danger">*</span></h4>
                                        <div class="form-group homec-form-input">
                                            <input type="date" name="booking_date" placeholder="booking_date"  class="form-control" value="{{ old('booking_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Time')}} <span class="text-danger">*</span></h4>
                                        <div class="form-group homec-form-input">
                                            <input type="time" name="booking_time" placeholder="booking time"  class="form-control" value="{{ old('booking_time') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Number Of Guests')}} <span class="text-danger">*</span></h4>
                                        <div class="form-group homec-form-input">
                                            <input type="number" name="guests" id="slug" placeholder="5" value="{{ old('guests') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Name')}} <span class="text-danger">*</span></h4>
                                        <div class="form-group homec-form-input">
                                            <input type="text" name="name" id="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Country')}} *</h4>
                                        <div class="form-group homec-form-input">
                                            <select  name="country" class="homec-form-select homec-border home_form_select2" id="country_id">
                                                <option value="">{{__('user.Select')}}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->name }}" data-value="{{$country->id}}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.City')}} *</h4>
                                        <div class="form-group homec-form-input" id="country_selector">
                                            <select  name="city" class="homec-form-select homec-border home_form_select2">
                                                <option value="">{{__('user.Select')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Zip Code')}} <span class="text-danger">*</span></h4>
                                        <div class="form-group homec-form-input">
                                            <input type="text" name="zip_code" placeholder="3434" id="zip_code" value="{{ old('zip_code') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Email')}} <span class="text-danger">*</span></h4>
                                        <div class="form-group homec-form-input">
                                            <input type="text" name="email" placeholder="john@gmail.com" id="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Phone')}} <span class="text-danger">*</span></h4>                                                        </h4>
                                        <div class="form-group homec-form-input">
                                            <input type="text" name="phone" placeholder="+8805050030505" id="phone" value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Questions Or Comments')}} <span class="text-danger">*</span>
                                        </h4>
                                        <div class="form-group homec-form-input">
                                            <textarea name="comment" id="comment" placeholder="Thank you for your message" cols="30" rows="10" required>{{ old('comment') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mg-top-40">
                                        <button type="submit" class="homec-btn homec-btn__second"><span>{{__('user.Confirm Booking')}}</span></button>
                                    </div>
                                </div>

                            </div>
                        </form>


					</div>
				</div>
			</div>
		</div>
		<!-- End Modal book Info -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.en.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#run').on('click', function() {
                $('#profile_view').modal('show');

                $('#profile_view').one('shown.bs.modal', function() {
                    $('#country_id').select2({
                        dropdownParent: $(this)
                    });
                });

                // Destroy Select2 on modal hidden
                $('#profile_view').on('hidden.bs.modal', function() {
                    $('#country_id').select2('destroy');
                });
            });
        });
    </script>



    <script>

    @if($setting->live_map == 'yes' && !empty($property->lat) && !empty($property->lon))
        $(document).ready(function() {

            var editLat = "{{$property->lat}}";
    var editLon = "{{$property->lon}}";

    var initialLat = editLat ? parseFloat(editLat) : 23.822350;
    var initialLon = editLon ? parseFloat(editLon) : 90.365417;

    var map = L.map('map').setView([initialLat, initialLon], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add marker with detailed page content
    var marker = L.marker([initialLat, initialLon]).addTo(map);

    // Property details for the popup content
    let propertyTitle = `{{$property->title}}`;
    let propertyImage = "{{$property->thumbnail_image ? asset($property->thumbnail_image) : 'default-image-url.jpg'}}";
    let propertyLink = "{{ url('/property/' . $property->slug) }}";

    // Create the detailed popup content with better alignment
    const popupContent = `
        <div class="popup-content" style="width: 250px; text-align: center;">
            <a href="${propertyLink}" style="text-decoration: none; color: inherit;">
                <img height="100px" width="100%" style="object-fit: cover; border-radius: 8px;" src="${propertyImage}" class="card-img-top" alt="${propertyTitle}">
                <div style="margin-top: 8px;">
                    <p style="font-weight: bold; margin: 0;">${propertyTitle}</p>
                </div>
            </a>
        </div>
    `;

    // Bind the popup to the marker, but only show it when the marker is clicked
    marker.bindPopup(popupContent, { minWidth: 150, closeButton: true });

    // Handle tab switch for map resizing
    $('a[data-bs-toggle="list"]').on('shown.bs.tab', function (e) {
        if ($(e.target).attr('href') === '#homec-pd-tab4') {
            map.invalidateSize();
        }
    });

        });

     @endif


        document.getElementById("myinput").oninput = function() {
            var value = (this.value-this.min)/(this.max-this.min)*100
            this.style.background = 'linear-gradient(to right, #7166F0 0%, ' + value + '%, #fff ' + value + '%, white 100%)'
        };
        document.getElementById("myinput2").oninput = function() {
            var value = (this.value-this.min)/(this.max-this.min)*100
            this.style.background = 'linear-gradient(to right, #7166F0 0%, ' + value + '%, #fff ' + value + '%, white 100%)'
        };
    </script>


    <script>
        (function($) {
            "use strict";
            $(document).ready(function () {
                $("#agentEmailForm").on('submit', function(e){
                    e.preventDefault();
                    var isDemo = "{{ env('APP_MODE') }}"
                    if(isDemo == 'DEMO'){
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }
                    $("#agentEmailBtnId").attr('disabled', true);
                    $.ajax({
                        type: 'POST',
                        data: $('#agentEmailForm').serialize(),
                        url: "{{ route('send-mail-to-agent') }}",
                        success: function (response) {
                            if(response.status == 1){
                                toastr.success(response.message)
                                $("#agentEmailForm").trigger("reset");
                                $("#agentEmailBtnId").attr('disabled', false);
                            }
                        },
                        error: function(response) {
                            $("#agentEmailBtnId").attr('disabled', false);
                            if(response.responseJSON.errors.name)toastr.error(response.responseJSON.errors.name[0])
                            if(response.responseJSON.errors.email)toastr.error(response.responseJSON.errors.email[0])
                            if(response.responseJSON.errors.subject)toastr.error(response.responseJSON.errors.subject[0])
                            if(response.responseJSON.errors.message)toastr.error(response.responseJSON.errors.message[0])
                            if(response.responseJSON.errors.agent_email)toastr.error(response.responseJSON.errors.agent_email[0])

                            if(!response.responseJSON.errors.name && !response.responseJSON.errors.email && !response.responseJSON.errors.subject && !response.responseJSON.errors.message && !response.responseJSON.errors.agent_email){
                                toastr.error("{{__('user.Please complete the recaptcha to submit the form')}}")
                            }
                        }
                    });
                })


                $("#reviewForm").on('submit', function(e){
                    e.preventDefault();
                    var isDemo = "{{ env('APP_MODE') }}"
                    if(isDemo == 'DEMO'){
                        toastr.error('This Is Demo Version. You Can Not Change Anything');
                        return;
                    }
                    $.ajax({
                        type: 'POST',
                        data: $('#reviewForm').serialize(),
                        url: "{{ route('store-property-review') }}",
                        success: function (response) {
                            if(response.status == 1){
                                toastr.success(response.message)
                                $("#reviewForm").trigger("reset");
                            }
                        },
                        error: function(response) {
                            if(response.responseJSON.errors.review)toastr.error(response.responseJSON.errors.review[0])

                            if(!response.responseJSON.errors.review){
                                toastr.error("{{__('user.Please complete the recaptcha to submit the form')}}")
                            }
                        }
                    });
                })


            });
        })(jQuery);


        function propertyReview(rating){
            $(".property_rat").each(function(){
                var property_rat = $(this).data('rating')
                if(property_rat > rating){
                    $(this).removeClass('fa-solid fa-star').addClass('fa-regular fa-star');
                }else{
                    $(this).removeClass('fa-regular fa-star').addClass('fa-solid fa-star');
                }
            })
            $("#property_rating").val(rating);
        }



        document.addEventListener("DOMContentLoaded", function () {
            const calculateButton = document.getElementById("sbt");
            const resetBtn = document.getElementById("resetBtn");
            calculateButton.addEventListener("click", calculateMonthlyPayment);
            resetBtn.addEventListener("click", clearAll);

            function calculateMonthlyPayment() {
                const loanAmount = parseFloat(document.getElementById("loan-amount").value);

                const annualInterestRate = parseFloat(document.getElementById("annualInterest").value);

                const loanTermYears = parseInt(document.getElementById("tearmYear").value);

                const monthlyInterestRate = (annualInterestRate / 100) / 12;
                const numberOfPayments = loanTermYears * 12;

                if (monthlyInterestRate === 0) {
                    const monthlyPayment = loanAmount / numberOfPayments;
                    document.getElementById("monthlyPayment").value = monthlyPayment.toFixed(2);
                } else {
                    const denominator = Math.pow(1 + monthlyInterestRate, numberOfPayments) - 1;
                    const monthlyPayment = (loanAmount * monthlyInterestRate) / denominator;
                    document.getElementById("monthlyPayment").textContent  = monthlyPayment.toFixed(2);
                }
            }
            function clearAll()
            {
                document.getElementById("loan-amount").value = 0;
                document.getElementById("annualInterest").value = 0;
                document.getElementById("tearmYear").value = 0;
                document.getElementById("monthlyPayment").textContent = 0;
            }

            const rangeSlider = document.getElementById('annualInterest');
            const percentageInput = document.getElementById('amt');
            rangeSlider.addEventListener('input', updatePercentage);

            function updatePercentage() {
                const sliderValue = rangeSlider.value;
                percentageInput.value = sliderValue + '%';
            }
            updatePercentage();

            const tearmYear = document.getElementById('tearmYear');
            const yearRange = document.getElementById('yearn-range');
            tearmYear.addEventListener('input', updateYear);
            function updateYear() {
                const YearValue = tearmYear.value;
                yearRange.value = 'Y'+YearValue;
            }
            updateYear();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#datetimepicker').datepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true,
                todayBtn: true,
                todayHighlight: true,
                showMeridian: true,
                minuteStep: 1
            });
        });

        $("#country_id").change(function (){

            const selectedOption = this.options[this.selectedIndex];
            const dataValue = selectedOption.getAttribute('data-value');
            let id = dataValue;

            let route = "{{ url('/property/city/list/') }}/" + id;
            ajax_switch_country(route)
        });

        function ajax_switch_country(route) {
            $.get({
                url: route,
                dataType: 'json',
                data: {},
                beforeSend: function () {
                },
                success: function (response) {
                    $('#country_selector').html(response.template);
                },
                complete: function () {
                },
            });
        }

    </script>

@endsection
