@extends('layout')
@section('title')
    <title>{{__('user.Payment')}}</title>
@endsection
@section('meta')
    <meta name="title" content="{{__('user.Payment')}}">
    <meta name="description" content="{{__('user.Payment')}}">
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
                            <li class="active"><a href="javascript:;">{{__('user.Payment')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Payment')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    <section class="pd-top-80 pd-btm-80 payment-package-bg">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-8 col-12">
                    <h3 class="homec-package-detail__heading">{{__('user.PACKAGE DETAILS')}}</h3>
                    <div class="homec-package-detail">
                        <table class="homec-package-detail__table">
                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Package')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{ $pricing_plan->plan_name }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Price')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{ num_format($pricing_plan->plan_price) }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Expired')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{ date('d M Y', strtotime($plan_expired_date)) }}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Agency Profile')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->max_agent_add > 0)
                                    {{__('user.Available')}}
                                    @else
                                    {{__('user.Unavailable')}}
                                    @endif
                                </span></td>
                            </tr>


                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Agent')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    {{ $pricing_plan->max_agent_add }}
                                </span></td>
                            </tr>



                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Property')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->number_of_property == -1)
                                        {{__('user.Unlimited')}}
                                    @else
                                        {{ $pricing_plan->number_of_property }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Featured Property')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->featured_property == 'enable')
                                    {{__('user.Available')}}
                                    @else
                                    {{__('user.Unavailable')}}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Featured Property')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->featured_property_qty == -1)
                                        {{__('user.Unlimited')}}
                                    @else
                                        {{ $pricing_plan->featured_property_qty }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Top Property')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->top_property == 'enable')
                                    {{__('user.Available')}}
                                    @else
                                    {{__('user.Unavailable')}}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Top Property')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->top_property_qty == -1)
                                        {{__('user.Unlimited')}}
                                    @else
                                        {{ $pricing_plan->top_property_qty }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Urgent Property')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->urgent_property == 'enable')
                                    {{__('user.Available')}}
                                    @else
                                    {{__('user.Unavailable')}}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Urgent Property')}}</h4></td>
                                <td><span class="homec-package-detail__value">
                                    @if ($pricing_plan->urgent_property_qty == -1)
                                        {{__('user.Unlimited')}}
                                    @else
                                        {{ $pricing_plan->urgent_property_qty }}
                                    @endif
                                </span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Aminities')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{__('user.Unlimited')}}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Image Gallery')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{__('user.Unlimited')}}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Nearest Location')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{__('user.Unlimited')}}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Property Plan')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{__('user.Unlimited')}}</span></td>
                            </tr>

                            <tr>
                                <td><h4 class="homec-package-detail__title">{{__('user.Additional Information')}}</h4></td>
                                <td><span class="homec-package-detail__value">{{__('user.Unlimited')}}</span></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="homec-payment-method">
                        <div class="payment-popup__top payment-popup__top--digital">
                            <!-- Payment Popup -->
                            <div class="payment-popup">
                                <h4 class="payment-popup__title">{{__('user.Stripe Payment')}}</h4>
                                <div class="payment-popup__inner">
                                    <div class="payment-popup__header">
                                        <h4 class="payment-popup__heading">{{__('user.Total')}} <b>{{ num_format($pricing_plan->plan_price) }}</b></h4>
                                    </div>
                                    <!-- Sign in Form -->

                                        <form role="form" action="{{ route('pay-with-stripe', $pricing_plan->plan_slug) }}" method="POST" class="require-validation ecom-wc__form-main p-0" data-cc-on-file="false" data-stripe-publishable-key="{{ $stripe->stripe_key }}" id="payment-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group homec-form-input">
                                                        <input class="ecom-wc__form-input card-number" type="text" name="card_number" placeholder="{{__('user.Card Number')}}" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group homec-form-input">
                                                        <input class="ecom-wc__form-input card-expiry-month" type="text" name="month" placeholder="{{__('user.Month')}}" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group homec-form-input">
                                                        <input class="ecom-wc__form-input card-expiry-year" type="text" name="year" placeholder="{{__('user.Year')}}" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group homec-form-input">
                                                        <input class="ecom-wc__form-input card-cvc" type="text" name="cvc" placeholder="{{__('user.CVV')}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 mg-top-20">
                                                    <button type="submit" class="homec-btn homec-btn__second  homec-btn--payment"><span>{{__('user.Payment Now')}}</span></button>
                                                </div>

                                                <div class="col-12 error d-none">
                                                    <div class="payment-popup__error">{{__('user.Please provide your valid card information')}}</div>
                                                </div>

                                            </div>
                                    </form>
                                    <!-- End Sign in Form -->
                                </div>
                            </div>
                            <!-- End Payment Popup -->
                        </div>
                        <div class="payment-popup__top payment-popup__top--bank">
                            <!-- Payment Popup -->
                            <div class="payment-popup">
                                <h4 class="payment-popup__title">{{__('user.Bank Payment')}}</h4>
                                <div class="payment-popup__inner">
                                    <div class="payment-popup__header">
                                        <h4 class="payment-popup__heading">{{__('user.Total')}} <b>{{ num_format($pricing_plan->plan_price) }}</b></h4>
                                    </div>
                                    <ul class="payment-popup__bank-list">
                                        <p>{!! clean(nl2br($bankPayment->account_info)) !!}</p>
                                    </ul>
                                    <!-- Sign in Form -->
                                    <form class="ecom-wc__form-main p-0"  method="post" action="{{ route('bank-payment', $pricing_plan->plan_slug) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group homec-form-input">
                                                    <textarea class="ecom-wc__form-input" type="text" name="tnx_info" placeholder="{{__('user.Transaction information')}}"></textarea>
                                                </div>

                                            </div>
                                            <div class="col-12 mg-top-20">
                                                <button type="submit" class="homec-btn homec-btn__second  homec-btn--payment"><span>{{__('user.Payment Now') }}</span></button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Sign in Form -->
                                </div>
                            </div>
                            <!-- End Payment Popup -->
                        </div>
                        <ul class="homec-payment-method__list">

                            @if ($stripe->status == 1)
                            <li>
                                <a href="javascript:;">
                                    <input class="form-check-input payment-stripe-button " type="radio" value="" id="payment-7" name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-7"><img src="{{ asset($stripe->image) }}"></label>
                                </a>
                            </li>
                            @endif

                            @if ($paypal->status == 1)
                            <li>
                                <a href="{{ route('pay-with-paypal', $pricing_plan->plan_slug) }}">
                                    <label class="form-check-label homec-payment-method__label" for="payment-1"><img src="{{ asset($paypal->image) }}"></label>
                                </a>
                            </li>
                            @endif

                            @if ($razorpay->status == 1)
                            <li>
                                <a href="javascript:;" id="razorpayBtn">
                                    <input class="form-check-input " type="radio" value="" id="payment-2"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-2"><img src="{{ asset($razorpay->image) }}"></label>
                                </a>
                            </li>

                            <form action="{{ route('pay-with-razorpay', $pricing_plan->plan_slug) }}" method="POST" class="d-none">
                                @csrf
                                @php
                                    $payable_amount = $pricing_plan->plan_price * $razorpay->currency_rate;
                                    $payable_amount = round($payable_amount, 2);
                                @endphp
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="{{ $razorpay->key }}"
                                        data-currency="{{ $razorpay->currency_code }}"
                                        data-amount= "{{ $payable_amount * 100 }}"
                                        data-buttontext="{{__('user.Pay')}} {{ $payable_amount }} {{ $razorpay->currency_code }}"
                                        data-name="{{ $razorpay->name }}"
                                        data-description="{{ $razorpay->description }}"
                                        data-image="{{ asset($razorpay->image) }}"
                                        data-prefill.name=""
                                        data-prefill.email=""
                                        data-theme.color="{{ $razorpay->color }}">
                                </script>
                            </form>

                            @endif

                            @if ($flutterwave->status == 1)
                            <li>
                                <a onclick="flutterwavePayment()" href="javascript:;">
                                    <input class="form-check-input " type="radio" value="" id="payment-3"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-3"><img src="{{ asset($flutterwave->logo) }}"></label>
                                </a>
                            </li>
                            @endif

                            @if ($mollie->mollie_status ==1)
                            <li>
                                <a href="{{ route('pay-with-mollie',$pricing_plan->plan_slug) }}">
                                    <label class="form-check-label homec-payment-method__label" for="payment-4"><img src="{{ ($mollie->mollie_image)? asset($mollie->mollie_image) : asset($setting->default_placeholder)}}"></label>
                                </a>
                            </li>
                            @endif

                            @if ($paystack->paystack_status == 1)
                            <li>
                                <a onclick="payWithPaystack()" href="javascript:;">
                                    <input class="form-check-input " type="radio" value="" id="payment-5"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-5"><img src="{{ ($paystack->paystack_image)? asset($paystack->paystack_image) : asset($setting->default_placeholder)}}"></label>
                                </a>
                            </li>
                            @endif

                            @if ($instamojoPayment->status == 1)
                            <li>
                                <a href="{{ route('pay-with-instamojo', $pricing_plan->plan_slug) }}">
                                    <label class="form-check-label homec-payment-method__label" for="payment-51"><img src="{{ ($instamojoPayment->image)? asset($instamojoPayment->image) : asset($setting->default_placeholder)}}"></label>
                            </li>
                            @endif

                            @if ($bankPayment->status == 1)
                            <li>
                                <a href="#">
                                    <input class="form-check-input payment-bank-button" type="radio" value="" id="payment-6"  name="payment-method">
                                    <label class="form-check-label homec-payment-method__label" for="payment-6"><img src="{{ ($bankPayment->image)? asset($bankPayment->image) : asset($setting->default_placeholder)}}"></label>
                                </a>
                            </li>
                            @endif

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

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

    {{-- start stripe payment --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                    'input[type=text]', 'input[type=file]',
                                    'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;
                $errorMessage.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('d-none');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

            $("#razorpayBtn").on("click", function(){
                $(".razorpay-payment-button").click();
            })

            /*====================================
                Payment Button
            ======================================*/

            // Add event listener to the bank button
            $('.payment-stripe-button').on( "click", function(){
                $('.payment-popup__top--digital').toggleClass('active');
            });

            // Add event listener to the body
            $('body').on("click", function(e){
                // Check if the clicked element is not the payment button or any of its children
                if (!$(e.target).is('.payment-popup') && !$(e.target).is('.payment-stripe-button') && !$.contains($('.payment-stripe-button')[0], e.target)) {
                    // If not, remove the 'active' class from the payment popup
                    $('.payment-popup__top--digital').removeClass('active');
                }
            });


            // Add event listener to the modal body
            $('.payment-popup__top--digital').on("click", function(e){
                // Stop the event from propagating up to the body element
                e.stopPropagation();
            });

            // Add event listener to the bank button
            $('.payment-bank-button').on("click", function(){
                $('.payment-popup__top--bank').toggleClass('active');
            });

            // Add event listener to the body
            $('body').on("click", function(e){
                // Check if the clicked element is not the bank button or any of its children
                if (!$(e.target).is('.payment-bank-button') && !$.contains($('.payment-bank-button')[0], e.target)) {
                    // If not, remove the 'active' class from the bank popup
                    $('.payment-popup__top--bank').removeClass('active');
                }
            });


            // Add event listener to the modal body
            $('.payment-popup__top--bank').on("click", function(e){
                // Stop the event from propagating up to the body element
                e.stopPropagation();
            });


        });
    </script>
    {{-- end stripe payment --}}

    {{-- start flutterwave payment --}}
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    @php
        $payable_amount = $pricing_plan->plan_price * $flutterwave->currency_rate;
        $payable_amount = round($payable_amount, 2);

    @endphp

    <script>
        function flutterwavePayment() {
            var isDemo = "{{ env('APP_MODE') }}"
            if(isDemo == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }

            FlutterwaveCheckout({
                public_key: "{{ $flutterwave->public_key }}",
                tx_ref: "{{ substr(rand(0,time()),0,10) }}",
                amount: {{ $payable_amount }},
                currency: "{{ $flutterwave->currency_code }}",
                country: "{{ $flutterwave->country_code }}",
                payment_options: " ",
                customer: {
                email: "{{ $user->email }}",
                phone_number: "{{ $user->phone }}",
                name: "{{ $user->name }}",
                },
                callback: function (data) {
                    var tnx_id = data.transaction_id;
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'post',
                        data : {tnx_id,_token},
                        url: "{{ url('pay-with-flutterwave') }}" + "/" + "{{ $pricing_plan->plan_slug }}",
                        success: function (response) {
                            if(response.status == 'success'){
                                toastr.success(response.message);
                                window.location.href = "{{ route('user.dashboard') }}";
                            }else{
                                toastr.error(response.message);
                                window.location.reload();
                            }
                        },
                        error: function(err) {

                        }
                    });
                },
                customizations: {
                title: "{{ $flutterwave->title }}",
                logo: "{{ asset($flutterwave->logo) }}",
                },
            });
        }
    </script>
    {{-- end flutterwave payment --}}


{{-- paystack start --}}

    <script src="https://js.paystack.co/v1/inline.js"></script>
    @php
        $public_key = $paystack->paystack_public_key;
        $currency = $paystack->paystack_currency_code;
        $currency = strtoupper($currency);

        $ngn_amount = $pricing_plan->plan_price * $paystack->paystack_currency_rate;
        $ngn_amount = $ngn_amount * 100;
        $ngn_amount = round($ngn_amount);
    @endphp
    <script>
        function payWithPaystack(){
            var isDemo = "{{ env('APP_MODE') }}"
            if(isDemo == 'DEMO'){
                toastr.error('This Is Demo Version. You Can Not Change Anything');
                return;
            }

            var handler = PaystackPop.setup({
                key: '{{ $public_key }}',
                email: '{{ $user->email }}',
                amount: '{{ $ngn_amount }}',
                currency: "{{ $currency }}",
                callback: function(response){
                let reference = response.reference;
                let tnx_id = response.transaction;
                let _token = "{{ csrf_token() }}";
                $.ajax({
                    type: "get",
                    data: {reference, tnx_id, _token},
                    url: "{{ url('pay-with-paystack') }}" + "/" + "{{ $pricing_plan->plan_slug }}",
                    success: function(response) {
                        if(response.status == 'success'){
                            toastr.success(response.message);
                            window.location.href = "{{ route('user.dashboard') }}";
                        }else{
                            toastr.error(response.message);
                            window.location.reload();
                        }
                    },
                    error: function(response){
                            toastr.error('Server Error');
                            window.location.reload();
                    }
                });
                },
                onClose: function(){
                    alert('window closed');
                }
            });
            handler.openIframe();

        }
    </script>

{{-- end paystack --}}
@endsection
