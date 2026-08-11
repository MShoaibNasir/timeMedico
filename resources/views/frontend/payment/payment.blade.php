<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayFast Secure Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .payment-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border: 1px solid #f1f5f9;
            transition: transform 0.3s ease;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo h2 {
            font-weight: 800;
            color: #1e293b;
            letter-spacing: -1px;
            margin: 0;
        }

        .brand-logo span {
            color: #2563eb;
            /* Professional Blue */
        }

        .order-summary {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            color: #64748b;
        }

        .total-amount {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #e2e8f0;
            margin-top: 10px;
            padding-top: 10px;
            font-weight: 700;
            font-size: 18px;
            color: #0f172a;
        }

        #submitBtn {
            width: 100%;
            background: #2563eb;
            color: white;
            border: none;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        #submitBtn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }

        #submitBtn:active {
            transform: translateY(0);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 20px;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 500;
        }

        /* Animation */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .payment-card {
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>

<body>
    @php
    $trans_amount=$trans_amount;
    @endphp
    <div class="payment-card">
        <div class="brand-logo">
            <h2>Pay<span>Fast</span></h2>
            <p class="text-muted small">Secure Checkout</p>
        </div>

        <?php
        // Aapka existing PHP logic yahan rahega
        $merchant_id = env('MERCHANT_ID');
        $secured_key = env('SECURED_ID');
        $basket_id = 'ITEM-' . generateRandomString(4);
        
       session(['bascket_id' => $basket_id]);
       session(['merchant_id' => $merchant_id]);

        $currency_code = env('CURRENCY_CODE');

        function generateRandomString($length = 4)
        {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

        function makeSignature($data, $secured_key)
        {
            ksort($data);
            $signatureString = '';
            foreach ($data as $key => $value) {
                if ($value !== '') {
                    $signatureString .= $key . '=' . $value . '&';
                }
            }
            $signatureString .= 'SECURED_KEY=' . $secured_key;
            return hash('sha256', $signatureString);
        }

        function getAccessToken($merchant_id, $secured_key, $basket_id, $trans_amount, $currency_code)
        {
            $tokenApiUrl = 'https://ipguat.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken';
            $params = sprintf(
                'MERCHANT_ID=%s&SECURED_KEY=%s&BASKET_ID=%s&TXNAMT=%s&CURRENCY_CODE=%s',
                $merchant_id,
                $secured_key,
                $basket_id,
                $trans_amount,
                $currency_code
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $tokenApiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            $response = curl_exec($ch);
            curl_close($ch);
            $payload = json_decode($response);
            return isset($payload->ACCESS_TOKEN) ? $payload->ACCESS_TOKEN : '';
        }

        $token = getAccessToken($merchant_id, $secured_key, $basket_id, $trans_amount, $currency_code);
        ?>

        <div class="order-summary">
            <div class="summary-item">
                <span>Basket ID</span>
                <span>#<?= $basket_id ?></span>
            </div>
            <div class="summary-item">
                <span>Customer</span>
                <span><?= $user->name ?></span>
            </div>
            <div class="summary-item">
                <span>Customer Email</span>
                <span><?= $user->email ?></span>
            </div>
            <div class="total-amount">
                <span>Total Amount</span>
                <span><?= $currency_code ?> <?= number_format($trans_amount, 2) ?></span>
            </div>
        </div>

        <form id="PayFast_payment_form" method="post" action="https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction">

            <?php
            $payfastData = ["TXNAMT" => $trans_amount];
            $fields = [
                "CURRENCY_CODE" => $currency_code,
                "MERCHANT_ID" => $merchant_id,
                "MERCHANT_NAME" => "Payfast Merchant",
                "TOKEN" => $token,
                "BASKET_ID" => $basket_id,
                "TXNAMT" => $trans_amount,
                "ORDER_DATE" => date('Y-m-d H:i:s'),
                "SUCCESS_URL" => env('SUCCESS_URL'),
                "FAILURE_URL" => env('FAILURE_URL'),
                "CHECKOUT_URL" => env('CHECKOUT_URL'),
                "CUSTOMER_EMAIL_ADDRESS" => $user->email,
                "CUSTOMER_MOBILE_NO" => $user->phone_number,
                "SIGNATURE" => makeSignature($payfastData, 'PAKINSOFC30'),
                "VERSION" => "MERCHANT-CART-0.1",
                "TXNDESC" => "Item Purchased from Cart",
                "PROCCODE" => "00",
                "TRAN_TYPE" => "ECOMM_PURCHASE"
            ];

            foreach ($fields as $name => $value): ?>
                <input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
            <?php endforeach; ?>

            <input type="hidden" name="MERCHANT_USERAGENT" value="Mozilla/5.0">

            <button id="submitBtn" type="submit">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Complete Payment
            </button>

            <div class="secure-badge">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                </svg>
                SSL Secured & Encrypted
            </div>
        </form>
    </div>
</body>

</html>