<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('user.Razorpay Payment') }}</title>
    <link rel="icon" type="image/png" href="{{ asset($setting->favicon ?? '') }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .loading-card {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
            max-width: 90%;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loading-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        .loading-sub {
            font-size: 13px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

    <div class="loading-card">
        <div class="spinner"></div>
        <div class="loading-title">Initiating Secure Payment...</div>
        <div class="loading-sub">Please do not close or refresh this page.</div>
    </div>

    <!-- Hidden form submitted after Razorpay payment completion -->
    <form id="razorpayForm" action="{{ route('razorpay-webview-payment', $pricing_plan->plan_slug) }}" method="GET" style="display: none;">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>

    @php
        $currency_rate = $razorpay->currency_rate ?? 1;
        $payable_amount = round($pricing_plan->plan_price * $currency_rate, 2);
        $amount_in_paise = (int) round($payable_amount * 100);
        $key_id = !empty($razorpay->key) ? $razorpay->key : env('RAZORPAY_KEY_ID');
        $currency_code = !empty($razorpay->currency_code) ? $razorpay->currency_code : 'INR';
    @endphp

    <script>
        document.addEventListener("DOMContentLoaded", async function () {
            const amountInPaise = {{ $amount_in_paise }};
            const currencyCode = "{{ $currency_code }}";
            const keyId = "{{ $key_id }}";
            const planSlug = "{{ $pricing_plan->plan_slug }}";

            try {
                // Step 1: Create Order via Backend API
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

                if (!response.ok || data.status === 'error' || !data.order_id) {
                    // If backend order creation fails, fallback to direct key or redirect to failure
                    console.error('Order creation error:', data);
                }

                const orderId = data.order_id || null;

                const options = {
                    "key": keyId,
                    "amount": data.amount || amountInPaise,
                    "currency": data.currency || currencyCode,
                    "name": "{{ $razorpay->name ?? 'Orbosis Reality' }}",
                    "description": "{{ $pricing_plan->plan_name ?? 'Membership Plan' }}",
                    "prefill": {
                        "name": "{{ $user->name ?? '' }}",
                        "email": "{{ $user->email ?? '' }}",
                        "contact": "{{ $user->phone ?? '' }}"
                    },
                    "theme": {
                        "color": "{{ $razorpay->color ?? '#4318ff' }}"
                    },
                    "handler": function (razorpayResponse) {
                        document.getElementById('razorpay_payment_id').value = razorpayResponse.razorpay_payment_id || ('pay_demo_' + Date.now());
                        document.getElementById('razorpay_order_id').value = razorpayResponse.razorpay_order_id || orderId || 'order_demo';
                        document.getElementById('razorpay_signature').value = razorpayResponse.razorpay_signature || 'demo_signature';
                        document.getElementById('razorpayForm').submit();
                    },
                    "modal": {
                        "ondismiss": function() {
                            window.location.href = "{{ route('webview-faild-payment') }}";
                        }
                    }
                };

                if (!data.is_demo && orderId) {
                    options.order_id = orderId;
                }

                        "ondismiss": function() {
                            window.location.href = "{{ route('webview-faild-payment') }}";
                        }
                    }
                };

                const rzp = new Razorpay(options);
                rzp.on('payment.failed', function (failureResponse) {
                    console.error('Razorpay payment failed:', failureResponse.error);
                    window.location.href = "{{ route('webview-faild-payment') }}";
                });

                rzp.open();

            } catch (err) {
                console.error('Failed to initialize Razorpay checkout:', err);
                window.location.href = "{{ route('webview-faild-payment') }}";
            }
        });
    </script>
</body>
</html>
