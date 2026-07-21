<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Payment Required</title>
</head>

<body style="margin:0;padding:20px;background:#f4f6f9;font-family:Arial,sans-serif;">
    <div style="max-width:650px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">
        <img src="{{ asset('frontend/images/timemedio-logo.png') }}" alt="Time Medico" style="max-width:180px;height:auto;margin-bottom:15px;display:block;margin-left:auto;margin-right:auto;">

        <!-- Header -->
        <div style="background:#2C2872;padding:30px;text-align:center;">
            <h1 style="margin:0;color:#ffffff;font-size:28px;">
                Order Confirmation
            </h1>
        </div>

        <!-- Content -->
        <div style="padding:35px;">

            <h3 style="margin-top:0;color:#2C2872;">
                Dear {{ $order->customer_name }},
            </h3>

            <p style="color:#555;line-height:1.8;">
                Thank you for placing your order with us.
                Your order has been reviewed and is now ready for payment.
            </p>

            <p style="color:#555;line-height:1.8;">
                Please complete your online payment and upload the payment slip by clicking the button below.
                Once our team verifies your payment, your order will be processed and dispatched.
            </p>

            <!-- Order Details -->
            <div style="background:#f8f9fc;border-left:4px solid #2C2872;padding:15px;margin:25px 0;">
                <table width="100%" cellspacing="0" cellpadding="5">
                    <tr>
                        <td width="40%"><strong>Order Number:</strong></td>
                        <td>{{ $order->order_no }}</td>
                    </tr>

                    <tr>
                        <td><strong>Total Amount:</strong></td>
                        <td>PKR {{ number_format($order->total_amount,2) }}</td>
                    </tr>

                    <tr>
                        <td><strong>Payment Method:</strong></td>
                        <td>{{ ucwords($order->payment_type) }}</td>
                    </tr>
                </table>
            </div>

            <!-- Upload Button -->
            <div style="text-align:center;margin:35px 0;">
                <a href="{{ route('frontend.dashboard.uploadPayment') }}"
                    style="background:#EE1B21;
                      color:#ffffff;
                      text-decoration:none;
                      padding:15px 35px;
                      border-radius:8px;
                      font-size:16px;
                      font-weight:bold;
                      display:inline-block;">
                    Upload Payment Slip
                </a>
            </div>

            <!-- Note -->
            <div style="background:#fff8e6;border:1px solid #ffe58f;padding:15px;border-radius:6px;">
                <strong style="color:#d48806;">Important:</strong>
                Please upload the payment slip after completing your payment.
                Orders will only be confirmed after payment verification by our accounts team.
            </div>

            <p style="margin-top:30px;color:#666;line-height:1.8;">
                If you have already submitted your payment, please ignore this email.
            </p>

            <p style="margin-top:30px;color:#666;">
                Regards,<br>
                <strong>Your Company Name</strong>
            </p>

        </div>

        <!-- Footer -->
        <div style="background:#2C2872;padding:15px;text-align:center;color:#ffffff;font-size:13px;">
            © {{ date('Y') }} Your Company Name. All Rights Reserved.
        </div>

    </div>

</body>

</html>