<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email - {{ config('app.name') }}</title>
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
            /* Softer, professional gradient */
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

        .verify-btn {
            display: inline-block;
            background: #198754;
            color: #fff !important;
            text-decoration: none;
            font-weight: 600;
            padding: 14px 30px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .verify-btn:hover {
            background: #157347;
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

            .verify-btn {
                width: 100%;
                text-align: center;
                display: block;
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
            <h2>Hello {{ $user['name'] }},</h2>
            <p>Welcome to <strong>{{ config('app.name') }} </strong>! We are pleased to have you with us.</p>
            <p>Your writing opportunity on "{{ $user['topic'] }}" has been approved by the admin.</p>
        </div>

        <div class="email-footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
