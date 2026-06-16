
@extends('layout')

@section('title')
    <title>{{__('user.Purchase History')}}</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.Purchase History')}}">
    <meta name="description" content="{{__('user.Purchase History')}}">
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
                            <li class="active"><a href="{{ route('user.orders') }}">{{__('user.Purchase History')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Purchase History')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

        @foreach ($orders as $order)
    	<!-- Modal  -->
		<div class="homec-modal modal fade" id="invoice_view-{{ $order->id }}" tabindex="-1" aria-labelledby="logoutmodal" aria-hidden="true" >
			<div class="homec-modal__width modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<button type="button" class="homec-moal__close" data-bs-dismiss="modal" aria-label="Close">
						<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.96538 11.4998C8.84252 11.3642 8.73942 11.243 8.62945 11.1289C5.9368 8.31163 3.24501 5.49253 0.546342 2.68062C0.107304 2.2226 -0.122954 1.71338 0.0660637 1.06407C0.359901 0.0591085 1.48284 -0.323477 2.28531 0.307878C2.42192 0.415649 2.5422 0.546769 2.66335 0.6734C5.31733 3.44669 7.97132 6.22088 10.6227 8.99687C10.7336 9.11272 10.8212 9.25282 10.9501 9.42166C11.1253 9.24743 11.2482 9.13068 11.3651 9.00854C14.0491 6.20292 16.7349 3.39909 19.4147 0.58898C19.8485 0.134548 20.3288 -0.124101 20.956 0.0600065C21.9346 0.347394 22.3212 1.5634 21.6975 2.40222C21.6012 2.53154 21.4844 2.6447 21.3727 2.76055C18.7101 5.54552 16.0467 8.33138 13.3807 11.1128C13.2707 11.2277 13.1264 11.3067 12.9743 11.4208C13.1539 11.622 13.2544 11.7414 13.3618 11.8546C16.0553 14.6719 18.7471 17.4901 21.4449 20.3029C21.8942 20.7717 22.1314 21.2944 21.9269 21.9607C21.6202 22.9576 20.4783 23.3222 19.693 22.6747C19.5702 22.5732 19.4619 22.4511 19.3511 22.3344C16.6876 19.5503 14.0242 16.7653 11.3599 13.9803C11.2499 13.8654 11.1357 13.7558 11.0051 13.6247C10.8788 13.7495 10.7636 13.8564 10.6545 13.9696C7.94812 16.7976 5.24087 19.6212 2.54306 22.4547C2.10918 22.9109 1.61515 23.104 1.02662 22.9325C0.0841064 22.6586 -0.300803 21.4902 0.265392 20.6549C0.37193 20.4978 0.508538 20.3604 0.639133 20.2229C3.30171 17.4371 5.96515 14.653 8.62859 11.868C8.7377 11.754 8.84252 11.6345 8.96538 11.4998Z" fill="#EB5757"></path>
						</svg>
					</button>
					<div class="homec-modal__inner">
						<div class="homec-header__logo">
							<a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="#"></a>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<ul class="homec-modal__list list-none">
									<li><span>{{__('user.Name')}}:</span> {{ html_decode($user->name) }}</li>
									<li><span>{{__('user.Phone')}}:</span> {{ html_decode($user->phone) }}</li>
									<li><span>{{__('user.Email')}}:</span> <a href="mailto:{{ html_decode($user->email) }}">{{ html_decode($user->email) }}</a></li>
									<li><span>{{__('user.Location')}}:</span> {{ html_decode($user->address) }} </li>
								</ul>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<ul class="homec-modal__list homec-modal__list--v2 list-none">
									<li><span>{{__('user.Order ID')}}:</span> {{ $order->order_id }}</li>
									<li><span>{{__('user.Amount')}}:</span> {{ num_format($order->plan_price) }}</li>
									<li><span>{{__('user.Payment')}}:</span> {{ $order->payment_method }}</li>
									<li><span>{{__('user.Transaction')}}: </span> {!! nl2br(html_decode($order->transaction_id)) !!}</li>
								</ul>
							</div>
						</div>
						<div class="homec-invoices  homec-invoice-table--v2 mg-top-30">
							<table class="homec-package-detail__table">
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Package')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{ $order->plan_name }}</span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Price')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{ num_format($order->plan_price) }}</span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Purchase')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{ date('d M Y', strtotime($order->created_at)) }}</span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Expired')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->expiration_date == 'lifetime')
                                            {{__('user.Lifetime')}}
                                        @else
                                            {{ date('d M Y', strtotime($order->expiration_date)) }}

                                        @endif
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Remaining day')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->order_status == 'active')
                                            @if ($order->expiration_date == 'lifetime')
                                                {{__('user.Lifetime')}}
                                            @else
                                                @php
                                                    $date1 = new DateTime(date('Y-m-d'));
                                                    $date2 = new DateTime($order->expiration_date);
                                                    $interval = $date1->diff($date2);
                                                    $remaining = $interval->days;
                                                @endphp

                                                @if ($remaining > 0)
                                                    {{ $remaining }} {{__('user.Days')}}
                                                @else
                                                    {{__('user.Expired')}}
                                                @endif

                                            @endif
                                        @else
                                            {{__('user.Expired')}}
                                        @endif

                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Agent')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        {{ $order->max_agent_add }}
                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Property')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->number_of_property == -1)
                                            {{__('user.Unlimited')}}
                                        @else
                                            {{ $order->number_of_property }}
                                        @endif
                                    </span></td>
                                </tr>



                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Featured Property')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->featured_property == 'enable')
                                        {{__('user.Available')}}
                                        @else
                                        {{__('user.Unavailable')}}
                                        @endif
                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Featured Property')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->featured_property_qty == -1)
                                            {{__('user.Unlimited')}}
                                        @else
                                            {{ $order->featured_property_qty }}
                                        @endif
                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Top Property')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->top_property == 'enable')
                                        {{__('user.Available')}}
                                        @else
                                        {{__('user.Unavailable')}}
                                        @endif
                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Top Property')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->top_property_qty == -1)
                                            {{__('user.Unlimited')}}
                                        @else
                                            {{ $order->top_property_qty }}
                                        @endif
                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Urgent Property')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->urgent_property == 'enable')
                                        {{__('user.Available')}}
                                        @else
                                        {{__('user.Unavailable')}}
                                        @endif
                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Urgent Property')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->urgent_property_qty == -1)
                                            {{__('user.Unlimited')}}
                                        @else
                                            {{ $order->urgent_property_qty }}
                                        @endif
                                    </span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Payment status')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($order->payment_status == 'success')
                                            <span class="badge bg-success">{{ $order->payment_status }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $order->payment_status }}</span>
                                        @endif
                                    </span></td>
                                </tr>


                            </table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal  -->
        @endforeach

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
										<h3 class="homec-dashboard__heading">{{__('user.Purchase History')}}</h3>
                                        <div class="homec-invoices">
                                            <table class="homec-invoice-table">
                                                <thead class="homec-invoice-table__head">
                                                    <tr>
                                                        <th class="homec-invoice-table__column1">{{__('user.Package')}}</th>
                                                        <th class="homec-invoice-table__column2">{{__('user.Purchase Date')}}</th>
                                                        <th class="homec-invoice-table__column3">{{__('user.Status')}}</th>
                                                        <th class="homec-invoice-table__column4">{{__('user.Amount')}}</th>
                                                        <th class="homec-invoice-table__column5">{{__('user.View')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="homec-invoice-table__body">
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <td class="homec-invoice-table__column1">
                                                                <p class="homec-invoice-table__text">{{ $order->plan_name }}</p>
                                                            </td>
                                                            <td class="homec-invoice-table__column2">
                                                                <p class="homec-invoice-table__text">{{ $order->created_at->format('M d Y') }}</p>
                                                            </td>
                                                            <td class="homec-invoice-table__column3">
                                                                <p class="homec-invoice-table__text">
                                                                    @if ($order->order_status == 'active')
                                                                    <span class="badge bg-success">{{ $order->order_status }}</span>
                                                                    @else
                                                                    <span class="badge bg-danger">{{ $order->order_status }}</span>
                                                                    @endif

                                                                </p>
                                                            </td>
                                                            <td class="homec-invoice-table__column4">
                                                                <p class="homec-invoice-table__text">{{ num_format($order->plan_price) }}</p>
                                                            </td>
                                                            <td class="homec-invoice-table__column5">
                                                                <button data-bs-toggle="modal" data-bs-target="#invoice_view-{{ $order->id }}"  class="homec-invoice-table--btn">{{__('user.View')}}</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
										<div class="row mg-top-40">
											<div class="col-12">
												{{ $orders->links('custom_pagination') }}
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
