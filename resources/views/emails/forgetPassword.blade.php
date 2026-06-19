<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset - {{ config('app.name') }}</title>
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
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .email-header {
            background: linear-gradient(90deg, #0093E9, #80D0C7);
            padding: 25px 0;
            text-align: center;
        }

        .email-header img {
            max-width: 130px;
        }

        .email-body {
            padding: 35px;
        }

        .email-body h2 {
            margin: 0 0 10px;
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
            transition: all 0.3s ease;
        }

        .verify-btn:hover {
            background: #157347;
            transform: translateY(-2px);
        }

        .note {
            font-size: 13px;
            color: #777;
            margin-top: 20px;
            text-align: center;
            line-height: 1.6;
        }

        .email-footer {
            background-color: #f1f3f8;
            text-align: center;
            padding: 18px;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #e6e6e6;
        }

        .email-footer a {
            color: #198754;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
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
            <p>We received a request to reset your password for your <strong>{{ config('app.name') }}</strong> account.</p>
            <p>To create a new password, please click the button below:</p>
            <p style="text-align: center; margin: 30px 0;">
                <a href="{{  route('frontend.resetPassword',$user['encrypted_id']) }}" class="verify-btn">Change Password</a>
            </p>
            <p class="note">If you didn’t request a password reset, please ignore this email.</p>
        </div>

        <div class="email-footer">
        
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
