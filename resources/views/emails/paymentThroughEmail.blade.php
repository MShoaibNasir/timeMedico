<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PayFast Payment</title>
    <style>
        body {
            background: #f4f6f8;
            font-family: Arial, sans-serif;
        }

        .payment-container {
            width: 380px;
            margin: 80px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .payment-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .payment-container label {
            font-size: 14px;
            margin-top: 10px;
            display: block;
        }

        .payment-container input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
        }

        .payment-container input:focus {
            border-color: #00a651;
        }

        .payment-container button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #00a651;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .payment-container button:hover {
            background: #008f46;
        }
    </style>
</head>

<body>

    <div class="payment-container">
        <h2>PayFast Payment</h2>

        <form action="https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction" method="post">
            @csrf
            <!-- PayFast required fields -->
            <input type="hidden" name="merchant_id" value="10000100">
            <input type="hidden" name="merchant_key" value="46f0cd694581a">

            <input type="hidden" name="return_url" value="https://yourwebsite.com/success">
            <input type="hidden" name="cancel_url" value="https://yourwebsite.com/cancel">
            <input type="hidden" name="notify_url" value="https://yourwebsite.com/notify">

            <!-- User Inputs -->
            <label>Full Name</label>
            <input type="text" name="name_first" placeholder="John" required>

            <label>Email</label>
            <input type="email" name="email_address" placeholder="john@email.com" required>

            <label>Amount (ZAR)</label>
            <input type="number" name="amount" value="100.00" step="0.01" required>

            <label>Item Name</label>
            <input type="text" name="item_name" value="Service Payment">

            <button type="submit">Pay Now</button>
        </form>
    </div>

</body>

</html>