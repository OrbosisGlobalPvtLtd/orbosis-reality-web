
@extends('layout')

@section('title')
    <title>{{ $agent->user_name }}</title>
@endsection

@section('meta')
    <meta name="title" content="{{ $agent->user_name }}">
    <meta name="description" content="{{ $agent->user_name }}">
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
                            <li class="active"><a href="{{ route('agents') }}">{{__('user.Our Agents')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{ html_decode($agent->name) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

     <!-- Agents -->
		<section class="pd-top-70 pd-btm-100">
			<div class="container">
				<div class="row">
                    <div class="col-lg-8 col-md-7 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
                        <div class="homec-agent-detail homec-border">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="homec-agent-detail__img">
                                        @if ($agent->image)
                                        <img src="{{ asset($agent->image) }}" alt="agent">
                                        @else
                                        <img src="{{ asset($default_user_avatar) }}" alt="agent">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="homec-agent-detail__body">
                                       <h4 class="homec-agent-detail__title position_relitive">{{ html_decode($agent->name) }}</h4>
                                       @php
                                       $kyc = Modules\Kyc\Entities\KycInformation::where('user_id',$agent->id)->where('status',1)->first();
                                       @endphp
                                       @if($kyc)
                                           <button class="detail-varified-badge-custom">
                                               <span>
                                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M10.007 2.10377C8.60544 1.65006 7.08181 2.28116 6.41156 3.59306L5.60578 5.17023C5.51004 5.35763 5.35763 5.51004 5.17023 5.60578L3.59306 6.41156C2.28116 7.08181 1.65006 8.60544 2.10377 10.007L2.64923 11.692C2.71404 11.8922 2.71404 12.1078 2.64923 12.308L2.10377 13.993C1.65006 15.3946 2.28116 16.9182 3.59306 17.5885L5.17023 18.3942C5.35763 18.49 5.51004 18.6424 5.60578 18.8298L6.41156 20.407C7.08181 21.7189 8.60544 22.35 10.007 21.8963L11.692 21.3508C11.8922 21.286 12.1078 21.286 12.308 21.3508L13.993 21.8963C15.3946 22.35 16.9182 21.7189 17.5885 20.407L18.3942 18.8298C18.49 18.6424 18.6424 18.49 18.8298 18.3942L20.407 17.5885C21.7189 16.9182 22.35 15.3946 21.8963 13.993L21.3508 12.308C21.286 12.1078 21.286 11.8922 21.3508 11.692L21.8963 10.007C22.35 8.60544 21.7189 7.08181 20.407 6.41156L18.8298 5.60578C18.6424 5.51004 18.49 5.35763 18.3942 5.17023L17.5885 3.59306C16.9182 2.28116 15.3946 1.65006 13.993 2.10377L12.308 2.64923C12.1078 2.71403 11.8922 2.71404 11.692 2.64923L10.007 2.10377ZM6.75977 11.7573L8.17399 10.343L11.0024 13.1715L16.6593 7.51465L18.0735 8.92886L11.0024 15.9999L6.75977 11.7573Z"></path></svg>
                                               </span>
                                           </button>
                                       @endif
                                       <p>{{ html_decode($agent->designation) }}</p>
                                    </div>
                                    <ul class="homec-agent-detail__list mg-top-30">
                                        <li><img src="{{ asset('frontend/img/agent-phone.svg') }}"> <a href="tel:{{ $agent->phone }}">{{ $agent->phone }}</a></li>
                                        <li><img src="{{ asset('frontend/img/agent-email.svg') }}"> <a href="mailto:{{ html_decode($agent->email) }}">{{ html_decode($agent->email) }}</a></li>
                                        <li><img src="{{ asset('frontend/img/agent-location.svg') }}"> {{ html_decode($agent->address) }} </li>
                                    </ul>
									<ul class="homec-agent__social homec-agent__social--inline list-none mg-top-30">
										@if ($agent->linkedin)
                                            <li><a href="{{ html_decode($agent->linkedin) }}"><i class="fab fa-linkedin-in"></i></a></li>
                                        @endif

                                        @if ($agent->twitter)
                                        <li><a href="{{ html_decode($agent->twitter) }}"><i class="fab fa-twitter"></i></a></li>
                                        @endif

                                        @if ($agent->instagram)
                                        <li><a href="{{ html_decode($agent->instagram) }}"><i class="fab fa-instagram"></i></a></li>
                                        @endif

                                        @if ($agent->facebook)
                                        <li><a href="{{ html_decode($agent->facebook) }}"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif
									</ul>
                                </div>
                            </div>
                            <div class="homec-agent-detail__sticky">
                                <div class="homec-agent-detail__inside">
                                    <div class="homec-agent-detail__sticky--heading">
                                        <h2 class="homec-agent-detail__sticky--title">{{__('user.About Me')}}</h2>
                                    </div>
                                    <p class="homec-agent-detail__sticky--text">{{ html_decode($agent->about_me) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="800">
                        <!-- Property Agent Card -->
                        <div class="homec-property-ag homec-bg-cover homec-agent-side-cover">
                            <h3 class="homec-property-ag__title">{{__('user.Property Agent')}}</h3>
                            <!-- Property Profile -->
                            <div class="homec-property-ag__author">
                                <div class="homec-property-ag__author--img">
                                    @if ($agent->image)
                                        <img src="{{ $agent->image }}" alt="agent">
                                        @else
                                        <img src="{{ $default_user_avatar }}" alt="agent">
                                        @endif
                                </div>

                                <div class="homec-property-ag__author--content">
                                    <h4 class="homec-property-ag__author--title">{{ html_decode($agent->name) }}<span>{{ html_decode($agent->designation) }}</span></h4>
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

                                <input type="hidden" name="agent_email" value="{{ $agent->email }}">
                                <button id="agentEmailBtnId" type="submit" class="homec-btn homec-btn__second homec-property-ag__button"><span>{{__('user.Send Message Now')}}</span></button>
                            </form>
                        </div>
                        <!-- End Property Agent Card -->
                    </div>
                </div>
				<div class="row mg-top-30">
					<div class="col-12" data-aos="fade-up" data-aos-delay="500">
						<!-- Proeprty Bar -->
						<div class="homec-property-bar">
							<div class="homec-property-bar__single">
								<form class="homec-form__form homec-form__form--bar" action="{{ route('agent') }}">

                                    <input type="hidden" value="{{ request()->get('agent_type') }}" name="agent_type">
                                    <input type="hidden" value="{{ request()->get('user_name') }}" name="user_name">

									<input type="text" name="search" value="{{ request()->get('search') }}" placeholder="{{__('user.Search Property')}}..." >
									<button type="submit" class="homec-btn"><span>{{__('user.Search Now')}}</span></button>
								</form>
								<!-- Show Results -->
								<div class="hoemc-showing-results">
									<p class="hoemc-showing-results__text">{{__('user.You can see list or grid view from right side')}}</p>
								</div>
								<!-- End Show Results -->
							</div>
							<div class="homec-property-bar__single">
								<div id="homec-tabs" class="list-group homec-gl-tabs" role="tablist">
									<a class="list-group-item active" data-bs-toggle="list" href="#homec-grid" role="tab">
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M7.31756 0.517578H3.14916C1.88457 0.517578 0.855469 1.54668 0.855469 2.81127V6.97916C0.855469 8.24375 1.88457 9.27285 3.14916 9.27285H7.31705C8.58164 9.27285 9.61075 8.24375 9.61075 6.97916V2.81127C9.61126 1.54668 8.58215 0.517578 7.31756 0.517578ZM8.08213 6.97967C8.08213 7.4012 7.73909 7.74424 7.31756 7.74424H3.14916C2.72763 7.74424 2.3846 7.4012 2.3846 6.97967V2.81178C2.3846 2.39025 2.72763 2.04722 3.14916 2.04722H7.31705C7.73858 2.04722 8.08162 2.39025 8.08162 2.81178L8.08213 6.97967ZM17.63 0.517578H13.4616C12.197 0.517578 11.1679 1.54668 11.1679 2.81127V6.97916C11.1679 8.24375 12.197 9.27285 13.4616 9.27285H17.63C18.8946 9.27285 19.9237 8.24375 19.9237 6.97916V2.81127C19.9237 1.54668 18.8951 0.517578 17.63 0.517578ZM18.3946 6.97967C18.3946 7.4012 18.0515 7.74424 17.63 7.74424H13.4616C13.0401 7.74424 12.697 7.4012 12.697 6.97967V2.81178C12.697 2.39025 13.0401 2.04722 13.4616 2.04722H17.63C18.0515 2.04722 18.3946 2.39025 18.3946 2.81178V6.97967ZM7.31756 10.3392H3.14916C1.88457 10.3392 0.855469 11.3683 0.855469 12.6329V16.8008C0.855469 18.0653 1.88457 19.0944 3.14916 19.0944H7.31705C8.58164 19.0944 9.61075 18.0653 9.61075 16.8008V12.6329C9.61126 11.3678 8.58215 10.3392 7.31756 10.3392ZM8.08213 16.8008C8.08213 17.2223 7.73909 17.5653 7.31756 17.5653H3.14916C2.72763 17.5653 2.3846 17.2223 2.3846 16.8008V12.6329C2.3846 12.2113 2.72763 11.8683 3.14916 11.8683H7.31705C7.73858 11.8683 8.08162 12.2113 8.08162 12.6329L8.08213 16.8008ZM17.63 10.3392H13.4616C12.197 10.3392 11.1679 11.3683 11.1679 12.6329V16.8008C11.1679 18.0653 12.197 19.0944 13.4616 19.0944H16.5759C16.998 19.0944 17.3405 18.7519 17.3405 18.3299C17.3405 17.9078 16.998 17.5653 16.5759 17.5653H13.4616C13.0401 17.5653 12.697 17.2223 12.697 16.8008V12.6329C12.697 12.2113 13.0401 11.8683 13.4616 11.8683H17.63C18.0515 11.8683 18.3946 12.2113 18.3946 12.6329V16.1264C18.3946 16.5484 18.7371 16.891 19.1591 16.891C19.5812 16.891 19.9237 16.5484 19.9237 16.1264V12.6329C19.9237 11.3678 18.8951 10.3392 17.63 10.3392Z"/>
										</svg>
									</a>
									<a class="list-group-item" data-bs-toggle="list" href="#homec-list" role="tab">
										<svg width="27" height="19" viewBox="0 0 27 19" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M23.3596 0.517578H6.84306C5.93088 0.517578 5.19141 1.25705 5.19141 2.16923C5.19141 3.08141 5.93088 3.82088 6.84306 3.82088H23.3596C24.2717 3.82088 25.0112 3.08141 25.0112 2.16923C25.0112 1.25705 24.2717 0.517578 23.3596 0.517578Z"/>
											<path d="M3.53912 2.17009C3.53726 1.73276 3.36203 1.31402 3.05188 1.00567C2.40768 0.365297 1.36725 0.365297 0.723052 1.00567C0.412851 1.31402 0.237621 1.73276 0.235814 2.17009C0.223479 2.27708 0.223479 2.38516 0.235814 2.49216C0.254499 2.59977 0.284951 2.70502 0.326655 2.80597C0.370992 2.90378 0.423483 2.99772 0.483562 3.08675C0.542867 3.17935 0.612081 3.26518 0.690018 3.34276C0.765169 3.4176 0.848216 3.48408 0.937766 3.54096C1.02474 3.60429 1.11903 3.65699 1.21855 3.69786C1.32802 3.75464 1.44472 3.79634 1.56539 3.82174C1.67239 3.83371 1.78047 3.83371 1.88747 3.82174C2.32361 3.8221 2.7422 3.64992 3.05188 3.34276C3.12982 3.26518 3.19903 3.17935 3.25834 3.08675C3.31842 2.99772 3.37091 2.90378 3.41524 2.80597C3.46794 2.70625 3.50949 2.60101 3.53912 2.49216C3.55145 2.38516 3.55145 2.27708 3.53912 2.17009Z"/>
											<path d="M3.53768 9.60173C3.54996 9.49473 3.54996 9.38665 3.53768 9.27966C3.50914 9.17307 3.46753 9.07046 3.4138 8.9741C3.37127 8.87278 3.31868 8.77595 3.2569 8.68506C3.19966 8.5935 3.13018 8.51014 3.05044 8.43731C2.40624 7.79694 1.36581 7.79694 0.721612 8.43731C0.411411 8.74566 0.236181 9.1644 0.234375 9.60173C0.237575 9.81938 0.279537 10.0347 0.358249 10.2376C0.399643 10.3353 0.449399 10.4293 0.506897 10.5184C0.569712 10.6082 0.641662 10.6912 0.721612 10.7661C0.794594 10.8457 0.8779 10.9152 0.96936 10.9726C1.05633 11.036 1.15058 11.0887 1.25014 11.1295C1.35084 11.1719 1.45618 11.2024 1.56395 11.2203C1.66961 11.244 1.77774 11.2551 1.88603 11.2534C1.99302 11.2657 2.1011 11.2657 2.2081 11.2534C2.31318 11.2354 2.41579 11.2049 2.51365 11.1625C2.6159 11.122 2.71294 11.0693 2.80269 11.0056C2.89415 10.9482 2.97746 10.8788 3.05044 10.7992C3.13003 10.7262 3.1995 10.6429 3.2569 10.5514C3.32038 10.4645 3.37308 10.3703 3.4138 10.2706C3.47022 10.161 3.51187 10.0444 3.53768 9.9238C3.55037 9.8168 3.55037 9.70872 3.53768 9.60173Z"/>
											<path d="M3.53778 17.0334C3.55001 16.9264 3.55001 16.8183 3.53778 16.7113C3.50924 16.6021 3.46764 16.4967 3.41391 16.3975C3.36957 16.2997 3.31708 16.2057 3.257 16.1167C3.1996 16.0252 3.13013 15.9419 3.05054 15.869C2.40635 15.2286 1.36591 15.2286 0.721713 15.869C0.642124 15.9419 0.572652 16.0252 0.515257 16.1167C0.455178 16.2057 0.402687 16.2997 0.35835 16.3975C0.31551 16.498 0.285006 16.6034 0.267509 16.7113C0.244231 16.8171 0.233186 16.9251 0.234476 17.0334C0.236334 17.4707 0.411564 17.8894 0.721713 18.1978C0.794696 18.2774 0.878001 18.3468 0.969461 18.4042C1.05643 18.4676 1.15068 18.5203 1.25024 18.5611C1.35094 18.6035 1.45629 18.634 1.56406 18.652C1.66971 18.6757 1.77784 18.6868 1.88613 18.685C1.99312 18.6974 2.1012 18.6974 2.2082 18.685C2.31329 18.667 2.41589 18.6365 2.51376 18.5942C2.616 18.5536 2.71304 18.5009 2.80279 18.4373C2.89425 18.3799 2.97756 18.3104 3.05054 18.2308C3.13013 18.1578 3.1996 18.0745 3.257 17.9831C3.32054 17.8962 3.37323 17.8019 3.41391 17.7023C3.47027 17.5926 3.51192 17.476 3.53778 17.3554C3.55048 17.2484 3.55048 17.1404 3.53778 17.0334Z"/>
											<path d="M25.0112 7.94922H6.84306C5.93088 7.94922 5.19141 8.68869 5.19141 9.60087C5.19141 10.513 5.93088 11.2525 6.84306 11.2525H25.0112C25.9234 11.2525 26.6629 10.513 26.6629 9.60087C26.6629 8.68869 25.9234 7.94922 25.0112 7.94922Z"/>
											<path d="M17.5788 15.3828H6.84306C5.93088 15.3828 5.19141 16.1223 5.19141 17.0345C5.19141 17.9466 5.93088 18.6861 6.84306 18.6861H17.5788C18.491 18.6861 19.2304 17.9466 19.2304 17.0345C19.2304 16.1223 18.491 15.3828 17.5788 15.3828Z"/>
										</svg>
									</a>
								</div>
							</div>
						</div>
						<!-- End Proeprty Bar -->
					</div>
				</div>
				<div class="row" data-aos="fade-up" data-aos-delay="600">
					<div class="col-12">
						<div class="tab-content" id="nav-tabContent">
							<!-- Grid Tab -->
							<div class="tab-pane fade show active" id="homec-grid" role="tabpanel">

                                @if ($properties->count() > 0)
                                    <div class="row">
                                        @foreach ($properties as $property_item)
                                            <div class="col-md-4 col-12 mg-top-30">
                                                <!-- Single property-->
                                                <div class="homec-property">
                                                    <!-- Property Head-->
                                                    <div class="homec-property__head">
                                                        <img src="{{ ($property_item->thumbnail_image)? asset($property_item->thumbnail_image) : asset($setting->default_placeholder)}}">
                                                        <!-- Top Sticky -->
                                                        <div class="homec-property__hsticky">
                                                            <a href="javascript:;" class="homec-heart add-to-wishlist" data-property-id="{{ $property_item->id }}">
                                                                <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.5745 3.73257L11.1008 4.69447L11.6272 3.73258C11.9704 3.10535 12.5438 2.26267 13.3886 1.60933C14.2595 0.935774 15.2355 0.6 16.3044 0.6C19.29 0.6 21.6017 3.03446 21.6017 6.3966C21.6017 8.18186 20.8932 9.70959 19.5597 11.3187C18.211 12.9462 16.2694 14.6033 13.8617 16.6552L14.2508 17.1119L13.8617 16.6552L13.8611 16.6557C13.0479 17.3487 12.1237 18.1363 11.1625 18.9769L11.1623 18.977C11.1457 18.9916 11.1241 18.9999 11.1008 18.9999C11.0776 18.9999 11.056 18.9916 11.0394 18.9771L11.0391 18.9768C10.0784 18.1367 9.15452 17.3493 8.34203 16.6569L8.34054 16.6556L8.34053 16.6556C5.93251 14.6035 3.99081 12.9463 2.64202 11.3188C1.30844 9.70958 0.6 8.18186 0.6 6.3966C0.6 3.03446 2.91167 0.6 5.89732 0.6C6.96614 0.6 7.94219 0.935773 8.81311 1.60933C9.6579 2.26267 10.2313 3.10532 10.5745 3.73257Z" stroke-width="1.2"/>
                                                                </svg>
                                                            </a>

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
                                                            <span class="homec-property__salebadge">

                                                                @if ($property_item->purpose == 'rent')
                                                                    {{__('user.For Rent')}}
                                                                @else
                                                                    {{__('user.For Sale')}}
                                                                @endif
                                                            </span>
                                                        </div>

                                                        <h3 class="homec-property__title"><a href="{{ route('property', html_decode($property_item->slug)) }}">{{ html_decode($property_item->title) }}</a></h3>
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
                                        {{ $properties->links('custom_pagination') }}
                                    </div>
                                @else
                                    <div class="row text-center text-danger mg-top-30">
                                        <div class="col-12">
                                            <h4>{{__('user.Property not found!')}}</h4>
                                        </div>
                                    </div>
                                @endif
							</div>
							<!-- End Grid Tab -->
							<!-- List Tab -->
							<div class="tab-pane fade" id="homec-list" role="tabpanel">
                                @if ($properties->count() > 0)
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
                                                            <a href="javascript:;" class="homec-heart add-to-wishlist" data-property-id="{{ $property_item->id }}">
                                                                <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.5745 3.73257L11.1008 4.69447L11.6272 3.73258C11.9704 3.10535 12.5438 2.26267 13.3886 1.60933C14.2595 0.935774 15.2355 0.6 16.3044 0.6C19.29 0.6 21.6017 3.03446 21.6017 6.3966C21.6017 8.18186 20.8932 9.70959 19.5597 11.3187C18.211 12.9462 16.2694 14.6033 13.8617 16.6552L14.2508 17.1119L13.8617 16.6552L13.8611 16.6557C13.0479 17.3487 12.1237 18.1363 11.1625 18.9769L11.1623 18.977C11.1457 18.9916 11.1241 18.9999 11.1008 18.9999C11.0776 18.9999 11.056 18.9916 11.0394 18.9771L11.0391 18.9768C10.0784 18.1367 9.15452 17.3493 8.34203 16.6569L8.34054 16.6556L8.34053 16.6556C5.93251 14.6035 3.99081 12.9463 2.64202 11.3188C1.30844 9.70958 0.6 8.18186 0.6 6.3966C0.6 3.03446 2.91167 0.6 5.89732 0.6C6.96614 0.6 7.94219 0.935773 8.81311 1.60933C9.6579 2.26267 10.2313 3.10532 10.5745 3.73257Z" stroke-width="1.2"/>
                                                                </svg>
                                                            </a>

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
                                                            <span class="homec-property__salebadge">

                                                                @if ($property_item->purpose == 'rent')
                                                                    {{__('user.For Rent')}}
                                                                @else
                                                                    {{__('user.For Sale')}}
                                                                @endif
                                                            </span>
                                                        </div>

                                                        <h3 class="homec-property__title"><a href="{{ route('property', html_decode($property_item->slug)) }}">{{ html_decode($property_item->title) }}</a></h3>
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
                                        {{ $properties->links('custom_pagination') }}
                                    </div>
                                @else
                                    <div class="row text-center text-danger mg-top-30">
                                        <div class="col-12">
                                            <h4>{{__('user.Property not found!')}}</h4>
                                        </div>
                                    </div>
                                @endif
							</div>
							<!-- End List Tab -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Agents -->

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

            });
        })(jQuery);

    </script>
@endsection
