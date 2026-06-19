<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .email-header {
            background: linear-gradient(90deg, #2d89ef, #00bfa5);
            padding: 25px 0;
            text-align: center;
        }

        .email-header img {
            max-width: 140px;
        }

        .email-body {
            padding: 35px;
        }

        .email-body h2 {
            margin: 0 0 15px;
            color: #1a237e;
            font-size: 22px;
            font-weight: 700;
        }

        .email-body p {
            font-size: 15px;
            line-height: 1.7;
            color: #444;
            margin-bottom: 18px;
        }

        .message-box {
            background: #f8f9fc;
            border-left: 4px solid #2d89ef;
            padding: 15px 18px;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
        }

        .email-footer {
            background-color: #f1f3f8;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #e6e6e6;
        }

        .email-footer p {
            margin: 0;
        }

        @media (max-width: 600px) {
            .email-body {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="email-header">
        <img src="{{ asset('frontend/images/logo/picg-logoo.png') }}" alt="{{ config('app.name') }} Logo">
    </div>

    <div class="email-body">
        <h2>New Contact Message</h2>
        <p>You have received a new message from a user through the contact form.</p>

        <p><strong>User Details:</strong></p>
        <p>
            <strong>Name:</strong> {{ $user['name'] }} <br>
            <strong>Email:</strong> {{ $user['email'] }}
        </p>

        <p><strong>Message:</strong></p>

        <div class="message-box">
            {{ $user['subject'] }}
        </div>

        <p style="margin-top: 25px;">
            Please respond to the user at your earliest convenience.
        </p>
    </div>

    <div class="email-footer">
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</div>

</body>
</html>
