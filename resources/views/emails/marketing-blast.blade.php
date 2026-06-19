<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email</title>
    <style>
        body {
            background-color: #f2f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f2f4f6;
            padding: 40px 0;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .email-header {
            background-color: #0d6efd;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .email-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 30px;
            color: #333333;
            font-size: 16px;
            line-height: 1.6;
        }

        .email-body p {
            margin-bottom: 20px;
        }

        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

        .email-footer strong {
            color: #0d6efd;
        }

        @media only screen and (max-width: 600px) {
            .email-content {
                width: 95% !important;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="email-header">
                <h2>👋 Hello {{ $user->name }},</h2>
            </div>

            <div class="email-body">
                <p>{!! nl2br(e($bodyText)) !!}</p>
            </div>

            <div class="email-footer">
                Thanks,<br>
                <strong>{{ config('app.name') }}</strong>
            </div>
        </div>
    </div>
</body>
</html>
