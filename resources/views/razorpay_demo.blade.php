<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Standard Checkout - Orbosis Reality</title>
    <!-- Modern UI styling -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            background-color: #f4f7fe;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 440px;
            padding: 32px;
        }
        .card-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .card-header h2 {
            font-size: 24px;
            color: #1b2559;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .card-header p {
            color: #a310ec;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #2b3674;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e5f2;
            border-radius: 10px;
            font-size: 15px;
            color: #1b2559;
            outline: none;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: #4318ff;
            box-shadow: 0 0 0 3px rgba(67, 24, 255, 0.1);
        }
        .btn-pay {
            width: 100%;
            background: #4318ff;
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-pay:hover {
            background: #3311db;
        }
        .btn-pay:disabled {
            background: #a3aed0;
            cursor: not-allowed;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-top: 20px;
            display: none;
        }
        .alert-success {
            background: #e6f9f0;
            color: #05cd99;
            border: 1px solid #05cd99;
        }
        .alert-error {
            background: #ffe8e8;
            color: #ee5d50;
            border: 1px solid #ee5d50;
        }
        .alert-info {
            background: #e9f3ff;
            color: #4318ff;
            border: 1px solid #4318ff;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            background: #f4f7fe;
            color: #4318ff;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h2>Razorpay Checkout</h2>
        <p>Orbosis Reality Standard Integration</p>
    </div>

    <form id="paymentForm" onsubmit="return false;">
        <div class="form-group">
            <label for="amountInput">Amount (in INR)</label>
            <input type="number" id="amountInput" class="form-control" value="500" min="1" step="1" required>
            <small style="color: #a3b2c7; font-size: 12px; display: block; margin-top: 4px;">
                Minimum 1 INR (100 paise)
            </small>
        </div>

        <div class="form-group">
            <label for="receiptInput">Receipt Reference</label>
            <input type="text" id="receiptInput" class="form-control" value="rcpt_orbosis_{{ time() }}" readonly>
        </div>

        <button type="button" id="payBtn" class="btn-pay">
            <span>Pay Now with Razorpay</span>
        </button>
    </form>

    <div id="statusAlert" class="alert"></div>
</div>

<!-- Razorpay Standard Checkout SDK -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('payBtn').addEventListener('click', async function() {
    const payBtn = document.getElementById('payBtn');
    const alertBox = document.getElementById('statusAlert');
    const amountInInr = parseFloat(document.getElementById('amountInput').value);
    const receipt = document.getElementById('receiptInput').value;

    function showAlert(message, type) {
        alertBox.className = 'alert alert-' + type;
        alertBox.innerText = message;
        alertBox.style.display = 'block';
    }

    if (!amountInInr || amountInInr < 1) {
        showAlert('Please enter an amount of at least 1 INR (100 paise).', 'error');
        return;
    }

    // Amount in paise (1 INR = 100 paise)
    const amountInPaise = Math.round(amountInInr * 100);

    payBtn.disabled = true;
    payBtn.innerText = 'Processing Order...';
    showAlert('Creating Razorpay order...', 'info');

    try {
        // STEP 1: BACKEND - Create Order
        const response = await fetch('/api/create-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                amount: amountInPaise,
                currency: 'INR',
                receipt: receipt
            })
        });

        const data = await response.json();

        if (!response.ok || data.status === 'error') {
            throw new Error(data.message || 'Failed to create Razorpay order.');
        }

        showAlert('Order created: ' + data.order_id + '. Opening checkout modal...', 'info');

        // STEP 2: FRONTEND - Open Razorpay Modal
        const options = {
            "key": data.key_id || "{{ env('RAZORPAY_KEY_ID') }}",
            "amount": data.amount,
            "currency": data.currency,
            "name": "Orbosis Reality",
            "description": "Property Plan Payment",
            "order_id": data.order_id,
            "handler": async function (razorpayResponse) {
                showAlert('Payment completed on Razorpay. Verifying signature...', 'info');

                try {
                    // STEP 3: BACKEND - Verify Signature
                    const verifyResponse = await fetch('/api/verify-payment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            razorpay_order_id: razorpayResponse.razorpay_order_id,
                            razorpay_payment_id: razorpayResponse.razorpay_payment_id,
                            razorpay_signature: razorpayResponse.razorpay_signature
                        })
                    });

                    const verifyData = await verifyResponse.json();

                    if (verifyResponse.ok && verifyData.status === 'success') {
                        showAlert('Success! Payment verified. Payment ID: ' + verifyData.payment_id, 'success');
                    } else {
                        showAlert('Error: ' + (verifyData.message || 'Payment verification failed!'), 'error');
                    }
                } catch (err) {
                    showAlert('Error verifying payment: ' + err.message, 'error');
                } finally {
                    payBtn.disabled = false;
                    payBtn.innerText = 'Pay Now with Razorpay';
                }
            },
            "modal": {
                "ondismiss": function() {
                    showAlert('Payment cancelled by user.', 'error');
                    payBtn.disabled = false;
                    payBtn.innerText = 'Pay Now with Razorpay';
                }
            },
            "prefill": {
                "name": "Orbosis User",
                "email": "user@orbosisreality.com",
                "contact": "9876543210"
            },
            "theme": {
                "color": "#4318ff"
            }
        };

        const rzp1 = new Razorpay(options);

        // Handle payment failure event
        rzp1.on('payment.failed', function (failureResponse){
            console.error('Payment failed details:', failureResponse.error);
            showAlert('Payment Failed: ' + (failureResponse.error.description || failureResponse.error.reason), 'error');
            payBtn.disabled = false;
            payBtn.innerText = 'Pay Now with Razorpay';
        });

        rzp1.open();

    } catch (error) {
        showAlert('Error: ' + error.message, 'error');
        payBtn.disabled = false;
        payBtn.innerText = 'Pay Now with Razorpay';
    }
});
</script>

</body>
</html>
