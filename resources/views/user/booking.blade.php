
@extends('layout')

@section('title')
    <title>{{__('user.Booking History')}}</title>
@endsection

@section('meta')
    <meta name="title" content="{{__('user.Booking History')}}">
    <meta name="description" content="{{__('user.Booking History')}}">
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
                            <li class="active"><a href="{{ route('user.property-booking') }}">{{__('user.Booking History')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Booking History')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->
    @foreach ($booking as $bookings)
        <!-- Modal  -->
        <div class="homec-modal modal fade" id="invoice_view-{{ $bookings->id }}" tabindex="-1" aria-labelledby="logoutmodal" aria-hidden="true" >
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

                        <div class="homec-invoices  homec-invoice-table--v2 mg-top-30">
                            <table class="homec-package-detail__table">
                                <tr>
    <td>
        <h4 class="homec-package-detail__title">
            {{ __('user.Property Name') }}
        </h4>
    </td>
    <td>
        <span class="homec-package-detail__value">
            {{ optional($bookings->property_name)->title ?? 'NA' }}
        </span>
    </td>
</tr>
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Name')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{ $bookings->name }}</span></td>
                                </tr>
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Date')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{ \Carbon\Carbon::parse($bookings->booking_date)->format('j M Y') }} </span></td>
                                </tr>
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Time')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{ \Carbon\Carbon::parse($bookings->booking_time)->format('g:i A') }}</span></td>
                                </tr>
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Guests')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{$bookings->guests}}</span></td>
                                </tr>
                               
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.City')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{$bookings->city}}</span></td>
                                </tr>
                               
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Zip Code')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{$bookings->zip_code}}</span></td>
                                </tr>
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Email')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{$bookings->email}}</span></td>
                                </tr>
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Phone')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{$bookings->phone}}</span></td>
                                </tr>
                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Comment')}}</h4></td>
                                    <td><span class="homec-package-detail__value">{{$bookings->comment}}</span></td>
                                </tr>

                                <tr>
                                    <td><h4 class="homec-package-detail__title">{{__('user.Status')}}</h4></td>
                                    <td><span class="homec-package-detail__value">
                                        @if ($bookings->status == 1)
                                            Confirmed
                                        @else
                                            Pending
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
        @foreach ($booking as $books)
        <!-- Modal  -->
        <div class="homec-modal modal fade" id="invoice_view-edit{{ $books->id }}" tabindex="-1" aria-labelledby="logoutmodal" aria-hidden="true" >
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

                        <div class="homec-invoices  homec-invoice-table--v2 mg-top-30">
                            <form action="{{ route('user.property-booking.edit',$books->id) }}" method="POST">
                                @csrf
                                <div class="col-lg-12 col-md-12 col-12">
                                    <!-- Single Form Element -->
                                    <div class="mg-top-20">
                                        <h4 class="homec-submit-form__heading">{{__('user.Change Booking Status')}} *</h4>
                                        <div class="form-group homec-form-input">
                                            <select class="homec-form-select homec-border" name="status">
                                                <option value="">{{__('user.Select')}}</option>
                                                <option @if($books->status == '0')selected @endif value="0">Pending</option>
                                                <option @if($books->status == '1')selected @endif value="1">Confirmed</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mg-top-40">
                                        <button type="submit" class="homec-btn homec-btn__second"><span>{{__('user.Submit')}}</span></button>
                                    </div>
                                </div>
                            </form>

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
										<h3 class="homec-dashboard__heading m-0">{{__('user.Booking')}}</h3>
                                        @foreach ($booking as $index => $book)
                                            <!-- Single Properties -->
                                            <div class="homec-dashboard-property mg-top-30">
                                                @if ($book->status == 1)
                                                    <div class="homec-dashboard-property__label">{{__('user.Confirmed')}}</div>
                                                @else
                                                    <div class="homec-dashboard-property__label red" style="background-color: red;">{{__('user.Pending')}}</div>
                                                @endif


                                                <!-- Property IMG -->
                                             <div class="homec-dashboard-property__img">

    <img src="{{ $book->property_name?->thumbnail_image 
        ? asset($book->property_name->thumbnail_image) 
        : asset($setting->default_placeholder) }}">

    <div class="homec-dashboard-property__content">

        <h3 class="homec-dashboard-property__title">
            {{ $book->property_name?->title ?? 'NA' }}
        </h3>

        <div class="homec-property__text">
            <strong>Name:</strong> {{ $book->name ?? 'NA' }}
        </div>

        <div class="homec-property__text">
            <strong>Booking Time:</strong>
            {{ $book->booking_date && $book->booking_time 
                ? \Carbon\Carbon::parse($book->booking_date)->format('j M Y').' '.\Carbon\Carbon::parse($book->booking_time)->format('g:i A')
                : 'NA' }}
        </div>

    </div>
                                        </div>
                                                <!-- Property Button -->
                                                <div class="homec-dashboard-property__buttons">

                                                    <a data-bs-toggle="modal" data-bs-target="#invoice_view-{{ $book->id }}" class="homec-dashboard-property__btn"><svg width="23" height="14" viewBox="0 0 23 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.6793 0.0471191C7.48656 0.0471191 3.68437 2.341 0.878736 6.06688C0.649796 6.37213 0.649796 6.79859 0.878736 7.10384C3.68437 10.8342 7.48656 13.1281 11.6793 13.1281C15.872 13.1281 19.6742 10.8342 22.4799 7.10833C22.7088 6.80308 22.7088 6.37662 22.4799 6.07137C19.6742 2.341 15.872 0.0471191 11.6793 0.0471191ZM11.9801 11.1933C9.19687 11.3684 6.8985 9.07452 7.07357 6.28684C7.21722 3.98847 9.08016 2.12553 11.3785 1.98188C14.1617 1.80681 16.4601 4.10069 16.285 6.88837C16.1369 9.18225 14.2739 11.0452 11.9801 11.1933ZM11.8409 9.06554C10.3416 9.15981 9.1026 7.92533 9.20136 6.426C9.27767 5.18704 10.2832 4.18599 11.5222 4.10518C13.0215 4.01091 14.2605 5.24539 14.1617 6.74472C14.0809 7.98818 13.0754 8.98923 11.8409 9.06554Z"/>

                                                    </svg>
                                                    </a>
                                                    <a data-bs-toggle="modal" data-bs-target="#invoice_view-edit{{ $book->id }}" class="homec-dashboard-property__btn  homec-dashboard-property__btn--edit"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.5401 12.732C11.3622 12.9097 11.1425 13.0456 10.9043 13.125L8.6037 13.8918C8.43767 13.9472 8.26451 13.9753 8.08933 13.9753C7.65479 13.9753 7.24626 13.8061 6.93903 13.4988C6.50051 13.0602 6.34998 12.4224 6.54609 11.8341L7.31296 9.53366C7.39231 9.2954 7.52823 9.07547 7.7059 8.8978L12.6748 3.92896H2.95305C1.85675 3.92896 0.964844 4.82086 0.964844 5.91716V17.4849C0.964844 18.5812 1.85675 19.4731 2.95305 19.4731H14.5208C15.6171 19.4731 16.509 18.5812 16.509 17.4849V7.76315L11.5401 12.732Z"/>
                                                        <path d="M8.47256 9.66509C8.41302 9.72463 8.3682 9.79718 8.34159 9.87704L7.57472 12.1775C7.50976 12.3724 7.56048 12.5872 7.70569 12.7324C7.85094 12.8777 8.06574 12.9284 8.26058 12.8634L10.5611 12.0966C10.641 12.07 10.7135 12.0251 10.7731 11.9656L17.5468 5.19185L15.2463 2.89136L8.47256 9.66509Z"/>
                                                        <path d="M18.1844 1.22954C17.8315 0.876613 17.2593 0.876613 16.9064 1.22954L16.0117 2.12419L18.3123 4.42472L19.2069 3.53007C19.5598 3.17714 19.5598 2.60494 19.2069 2.25202L18.1844 1.22954Z"/>
                                                    </svg>
                                                    </a>
                                                    <a href="javascript:;" onclick="deleteProperty({{ $book->id }})" class="homec-dashboard-property__btn homec-dashboard-property__btn--delete"><svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.86625 0.952615C4.86628 0.803061 4.92128 0.659637 5.01915 0.55386C5.11703 0.448082 5.24978 0.388606 5.38824 0.388501L10.6078 0.388184C10.7462 0.38853 10.879 0.448171 10.9768 0.554033C11.0746 0.659895 11.1296 0.803342 11.1297 0.952933V2.34732H4.86625V0.952615ZM13.4482 19.9103C13.4348 20.1302 13.3442 20.3363 13.1949 20.4863C13.0455 20.6364 12.8487 20.7191 12.6447 20.7176H3.29125C3.08734 20.717 2.89117 20.6331 2.74216 20.4827C2.59315 20.3323 2.50232 20.1266 2.48791 19.9069L1.68751 7.2596H14.3024L13.4483 19.9102L13.4482 19.9103ZM15.5276 6.11414H0.46875V4.80382C0.468974 4.45629 0.596861 4.12307 0.824333 3.8773C1.05181 3.63154 1.36027 3.49333 1.682 3.49302L14.3142 3.49258C14.6359 3.49311 14.9442 3.63145 15.1717 3.87724C15.3991 4.12303 15.5269 4.4562 15.5272 4.8037V6.11402L15.5276 6.11414ZM5.57347 17.7026C5.57347 17.7778 5.58718 17.8523 5.61382 17.9217C5.64047 17.9912 5.67952 18.0543 5.72874 18.1075C5.77797 18.1607 5.83642 18.2029 5.90074 18.2317C5.96506 18.2604 6.03399 18.2753 6.10361 18.2753C6.17323 18.2753 6.24217 18.2604 6.30649 18.2317C6.37081 18.2029 6.42925 18.1607 6.47848 18.1075C6.52771 18.0543 6.56676 17.9912 6.5934 17.9217C6.62005 17.8523 6.63376 17.7778 6.63376 17.7026V9.67202C6.63264 9.521 6.57633 9.37657 6.47709 9.27018C6.37785 9.16379 6.24371 9.10407 6.10389 9.10402C5.96407 9.10397 5.82989 9.16359 5.73058 9.2699C5.63127 9.37621 5.57486 9.5206 5.57365 9.67163V17.7026H5.57347ZM9.35602 17.7026C9.35602 17.8545 9.41188 18.0002 9.51132 18.1076C9.61075 18.215 9.74562 18.2753 9.88624 18.2753C10.0269 18.2753 10.1617 18.215 10.2612 18.1076C10.3606 18.0002 10.4165 17.8545 10.4165 17.7026V9.67202C10.4153 9.52098 10.359 9.37652 10.2598 9.27012C10.1605 9.16372 10.0264 9.10399 9.88651 9.10394C9.74667 9.10389 9.61248 9.16352 9.51315 9.26984C9.41383 9.37617 9.35742 9.52058 9.3562 9.67163L9.35602 17.7026Z"/>
                                                    </svg>
                                                    </a>

                                                    <form class="d-none" action="{{ route('user.property-booking.remove',$book->id) }}" method="POST" id="remove_property-{{ $book->id }}">
                                                        @csrf
                                                        @method('DELETE')

                                                    </form>

                                                </div>
                                            </div>
                                            <!-- End Single Properties -->
                                        @endforeach

                                        {{-- <div class="row mg-top-40">
											<div class="col-12">
												{{ $properties->links('custom_pagination') }}
											</div>
										</div> --}}
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
        function deleteProperty(id){
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
                    $("#remove_property-"+id).submit();
                }

            })
        }
    </script>

@endsection
