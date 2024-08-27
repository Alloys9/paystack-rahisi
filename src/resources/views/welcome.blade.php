<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paystack Payment</title>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .payment-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            box-sizing: border-box;
        }

        .branding {
            text-align: center;
            margin-bottom: 20px;
        }

        .branding img {
            width: 80px;
            height: auto;
        }

        .branding h1 {
            margin: 10px 0;
            font-size: 24px;
            color: #555;
        }

        .branding p {
            margin: 5px 0;
            font-size: 14px;
            color: #777;
        }

        .payment-form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            margin: 0 auto;
            justify-content: center;
            display: flex;
        }

        .input-field {
            width: 80%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background-color: #f9f9f9;
            margin: 0 auto;
            justify-content: center;
            display: flex;
        }

        .submit-btn {
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: gray;
        }


        /*FOOTER*/
        .footer {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            --webkit-backdrop-filter: blur(10px);
            bottom: 0;
            height: 12px;
            width: 100%;
            position: fixed;
            z-index: 1000;

        }

        .footer a,
        .footer p {
            color: white;
            text-decoration: none;
            padding-right: 20px;
            font-size: 10px;
            padding: 5px;
        }

        .footer a:hover {
            color: blue;
        }


        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto 20px auto;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-error {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>

<body>

    <div class="payment-container">
        <div class="branding">
            <h1>service by <a href="https://www.alloysamasakha.com/" target="_blank">EutopiaTech</a></h1>
            <p>All programming Solutions</p>
        </div>

        <!-- Session Message Display -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form id="paymentForm" class="payment-form">
            <div class="input-group">
                <label for="email-address">Email:</label>
                <input type="email" id="email-address" class="input-field" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <label for="amount">Amount (KES):</label>
                <input type="number" id="amount" class="input-field" placeholder="Enter amount" required>
            </div>
            <button type="submit" class="submit-btn">Pay Now</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Company Name. All rights reserved.</p>
        <p>Contact us at: <a href="mailto:eutopiatech@gmail.com">eutopiatech@gmail.com</a></p>
    </footer>

    <script>
        document.getElementById('paymentForm').addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();

            const emailInput = document.getElementById("email-address");
            const amountInput = document.getElementById("amount");

            if (!emailInput || !amountInput) {
                console.error("Email or Amount input field not found.");
                return;
            }

            const email = emailInput.value.trim();
            const amount = parseFloat(amountInput.value.trim()) * 100;

            if (!email || isNaN(amount) || amount <= 0) {
                console.error("Invalid email or amount.");
                return;
            }

            let handler = PaystackPop.setup({
                key: "{{ env('PAYSTACK_PUBLIC_KEY') }}",
                email: email,
                amount: amount,
                ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                currency: "KES",
                metadata: {
                    custom_fields: [{
                        payment_type: 'Payment',
                    }]
                },
                callback: function(response) {
                    window.location.href = "/callback?trxref=" + response.trxref + "&reference=" + response
                        .reference;
                },
                onClose: function() {
                    alert('Payment window closed.');
                }
            });

            handler.openIframe();
        }
    </script>

</body>

</html>
