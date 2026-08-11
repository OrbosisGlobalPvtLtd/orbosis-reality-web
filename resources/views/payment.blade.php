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

    <style>
        .checkout-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef2f7;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .checkout-header {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            color: #ffffff;
            padding: 28px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .checkout-header__title {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }
        .checkout-header__sub {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 4px;
        }
        .checkout-price-pill {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .checkout-body {
            padding: 32px;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        @media (max-width: 767px) {
            .feature-grid {
                grid-template-columns: 1fr;
            }
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }
        .feature-item:hover {
            border-color: #cbd5e1;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        .feature-item__icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        .feature-item__icon--check {
            background: #dcfce7;
            color: #16a34a;
        }
        .feature-item__icon--cross {
            background: #fee2e2;
            color: #dc2626;
        }
        .feature-item__label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin: 0;
        }
        .feature-item__value {
            font-size: 14px;
            color: #0f172a;
            margin-left: auto;
            font-weight: 700;
        }
        
        /* Payment Method Card */
        .payment-method-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
            border: 1px solid #eef2f7;
            padding: 32px;
            text-align: center;
        }
        .payment-method-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .payment-method-sub {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 24px;
        }
        .pay-razorpay-btn {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff !important;
            width: 100%;
            padding: 18px 24px;
            border-radius: 14px;
            font-size: 18px;
            font-weight: 700;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.3);
            transition: all 0.3s ease;
        }
        .pay-razorpay-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(2, 132, 199, 0.4);
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
        }
        .trust-badge-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
        }
        .trust-badge-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            color: #475569;
            font-weight: 500;
        }
    </style>



    <section class="pd-top-60 pd-btm-80 homec-bg-third-color">
        <div class="container">
            <div class="row">
                <!-- Package Details Card -->
                <div class="col-lg-7 col-12">
                    <div class="checkout-card">
                        <div class="checkout-header">
                            <div>
                                <h3 class="checkout-header__title">{{ $pricing_plan->plan_name }} Plan</h3>
                                <p class="checkout-header__sub">Valid till {{ date('d M Y', strtotime($plan_expired_date)) }}</p>
                            </div>
                            <div class="checkout-price-pill">
                                {{ num_format($pricing_plan->plan_price) }}
                                <span style="font-size: 13px; font-weight: 500; opacity: 0.9;">/ {{ ucfirst($pricing_plan->expired_time ?? 'Monthly') }}</span>
                            </div>
                        </div>
                        <div class="checkout-body">
                            <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">Included Features & Limits</h4>
                            <div class="feature-grid">
                                <div class="feature-item">
                                    <span class="feature-item__icon {{ $pricing_plan->max_agent_add > 0 ? 'feature-item__icon--check' : 'feature-item__icon--cross' }}">
                                        <i class="fas {{ $pricing_plan->max_agent_add > 0 ? 'fa-check' : 'fa-times' }}"></i>
                                    </span>
                                    <span class="feature-item__label">{{__('user.Agency Profile')}}</span>
                                    <span class="feature-item__value">{{ $pricing_plan->max_agent_add > 0 ? 'Available' : 'Unavailable' }}</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon feature-item__icon--check"><i class="fas fa-check"></i></span>
                                    <span class="feature-item__label">{{__('user.Agent Limit')}}</span>
                                    <span class="feature-item__value">{{ $pricing_plan->max_agent_add }}</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon feature-item__icon--check"><i class="fas fa-check"></i></span>
                                    <span class="feature-item__label">{{__('user.Property Submissions')}}</span>
                                    <span class="feature-item__value">{{ $pricing_plan->number_of_property == -1 ? 'Unlimited' : $pricing_plan->number_of_property }}</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon {{ $pricing_plan->featured_property == 'enable' ? 'feature-item__icon--check' : 'feature-item__icon--cross' }}">
                                        <i class="fas {{ $pricing_plan->featured_property == 'enable' ? 'fa-check' : 'fa-times' }}"></i>
                                    </span>
                                    <span class="feature-item__label">{{__('user.Featured Property')}}</span>
                                    <span class="feature-item__value">{{ $pricing_plan->featured_property == 'enable' ? ($pricing_plan->featured_property_qty == -1 ? 'Unlimited' : $pricing_plan->featured_property_qty) : 'Unavailable' }}</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon {{ $pricing_plan->top_property == 'enable' ? 'feature-item__icon--check' : 'feature-item__icon--cross' }}">
                                        <i class="fas {{ $pricing_plan->top_property == 'enable' ? 'fa-check' : 'fa-times' }}"></i>
                                    </span>
                                    <span class="feature-item__label">{{__('user.Top Property')}}</span>
                                    <span class="feature-item__value">{{ $pricing_plan->top_property == 'enable' ? ($pricing_plan->top_property_qty == -1 ? 'Unlimited' : $pricing_plan->top_property_qty) : 'Unavailable' }}</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon {{ $pricing_plan->urgent_property == 'enable' ? 'feature-item__icon--check' : 'feature-item__icon--cross' }}">
                                        <i class="fas {{ $pricing_plan->urgent_property == 'enable' ? 'fa-check' : 'fa-times' }}"></i>
                                    </span>
                                    <span class="feature-item__label">{{__('user.Urgent Property')}}</span>
                                    <span class="feature-item__value">{{ $pricing_plan->urgent_property == 'enable' ? ($pricing_plan->urgent_property_qty == -1 ? 'Unlimited' : $pricing_plan->urgent_property_qty) : 'Unavailable' }}</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon feature-item__icon--check"><i class="fas fa-check"></i></span>
                                    <span class="feature-item__label">{{__('user.Amenities')}}</span>
                                    <span class="feature-item__value">Unlimited</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon feature-item__icon--check"><i class="fas fa-check"></i></span>
                                    <span class="feature-item__label">{{__('user.Image Gallery')}}</span>
                                    <span class="feature-item__value">Unlimited</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon feature-item__icon--check"><i class="fas fa-check"></i></span>
                                    <span class="feature-item__label">{{__('user.Nearest Location')}}</span>
                                    <span class="feature-item__value">Unlimited</span>
                                </div>

                                <div class="feature-item">
                                    <span class="feature-item__icon feature-item__icon--check"><i class="fas fa-check"></i></span>
                                    <span class="feature-item__label">{{__('user.Property Plan')}}</span>
                                    <span class="feature-item__value">Unlimited</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Column -->
                <div class="col-lg-5 col-12">
                    <div class="payment-method-card">
                        <h3 class="payment-method-title">Complete Checkout</h3>
                        <p class="payment-method-sub">Choose your payment gateway to subscribe</p>

                        @if ($razorpay->status == 1)
                            <div style="margin-bottom: 20px;">
                                <button type="button" class="pay-razorpay-btn" onclick="payWithRazorpayStandard()">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor"/>
                                        <path d="M11 7H13V13H11V7ZM11 15H13V17H11V15Z" fill="currentColor"/>
                                    </svg>
                                    <span>Pay {{ num_format($pricing_plan->plan_price) }} with Razorpay</span>
                                </button>
                            </div>
                        @endif

                        @if ($paypal->status == 1)
                            <div style="margin-bottom: 16px;">
                                <a href="{{ route('pay-with-paypal', $pricing_plan->plan_slug) }}" class="btn btn-outline-primary w-100 p-3 fw-bold" style="border-radius: 14px;">
                                    Pay via PayPal
                                </a>
                            </div>
                        @endif

                        @if ($bankPayment->status == 1)
                            <div style="margin-bottom: 16px;">
                                <button type="button" class="btn btn-outline-secondary w-100 p-3 fw-bold payment-bank-button" style="border-radius: 14px;">
                                    Bank Transfer / Wire
                                </button>
                            </div>
                        @endif

                        <div class="trust-badge-container">
                            <div class="trust-badge-item">
                                <i class="fas fa-lock text-success"></i> 256-Bit SSL Encrypted & Secure Checkout
                            </div>
                            <div class="trust-badge-item">
                                <i class="fas fa-bolt text-warning"></i> Instant Activation Upon Successful Payment
                            </div>
                            <div class="trust-badge-item">
                                <i class="fas fa-shield-alt text-primary"></i> Powered by Razorpay Verified Gateway
                            </div>
                        </div>
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

{{-- Razorpay Standard Checkout --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    async function payWithRazorpayStandard() {
        var isDemo = "{{ env('APP_MODE') }}";
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }

        @php
            $currency_code = !empty($razorpay->currency_code) ? $razorpay->currency_code : 'INR';
            $currency_rate = ($currency_code == 'INR') ? 1 : ($razorpay->currency_rate ?? 1);
            $payable_amount = round($pricing_plan->plan_price * $currency_rate, 2);
            $amount_in_paise = (int) round($payable_amount * 100);
            $key_id = !empty($razorpay->key) ? $razorpay->key : env('RAZORPAY_KEY_ID');
        @endphp


        const amountInPaise = {{ $amount_in_paise }};
        const currencyCode = "{{ $currency_code }}";
        const keyId = "{{ $key_id }}";
        const planSlug = "{{ $pricing_plan->plan_slug }}";

        try {
            toastr.info('Creating Razorpay order...');

            // Step 1: Create Order via /api/create-order
            const response = await fetch('/api/create-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    amount: amountInPaise,
                    currency: currencyCode,
                    receipt: 'rcpt_' + planSlug + '_' + Date.now()
                })
            });

            const data = await response.json();

            // Step 2: Open Razorpay Standard Modal (UPI, Cards, Netbanking, Wallets)
            const options = {
                "key": (data && data.key_id) ? data.key_id : keyId,
                "amount": (data && data.amount) ? data.amount : amountInPaise,
                "currency": (data && data.currency) ? data.currency : currencyCode,
                "name": "{{ $razorpay->name ?? 'Orbosis Reality' }}",
                "description": "{{ $pricing_plan->plan_name }} Package",
                "prefill": {
                    "name": "{{ $user->name ?? '' }}",
                    "email": "{{ $user->email ?? '' }}",
                    "contact": "{{ $user->phone ?? '' }}"
                },
                "theme": {
                    "color": "{{ $razorpay->color ?? '#4318ff' }}"
                },
                "handler": async function (razorpayResponse) {
                    toastr.info('Verifying payment signature...');

                    const hiddenForm = document.createElement('form');
                    hiddenForm.method = 'POST';
                    hiddenForm.action = "{{ route('pay-with-razorpay', $pricing_plan->plan_slug) }}";
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    hiddenForm.appendChild(csrfInput);

                    const payInput = document.createElement('input');
                    payInput.type = 'hidden';
                    payInput.name = 'razorpay_payment_id';
                    payInput.value = razorpayResponse.razorpay_payment_id || ('pay_demo_' + Date.now());
                    hiddenForm.appendChild(payInput);

                    document.body.appendChild(hiddenForm);
                    hiddenForm.submit();
                }
            };

            if (data && data.order_id && !data.is_demo) {
                options.order_id = data.order_id;
            }

            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function (failureResponse) {
                console.error('Razorpay Failure:', failureResponse);
                if (failureResponse.error && (failureResponse.error.code === 'BAD_REQUEST_ERROR' || failureResponse.error.description?.includes('does not exist'))) {
                    toastr.error('Invalid Razorpay Key: Please enter a valid Key ID & Secret Key generated from https://dashboard.razorpay.com in Admin Panel or .env');
                } else {
                    toastr.error('Payment failed: ' + (failureResponse.error.description || failureResponse.error.reason));
                }
            });
            rzp.open();


        } catch (error) {
            toastr.error('Razorpay Error: ' + error.message);
        }
    }
</script>


@endsection

