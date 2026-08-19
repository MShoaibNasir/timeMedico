<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteName }} verification code</title>
</head>
<body style="margin:0;padding:0;background:#f4f5fb;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f5fb;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e6e8f2;">
                    <tr>
                        <td style="background:#2C2872;padding:22px 28px;text-align:center;">
                            <img src="{{ $logoUrl }}" alt="{{ $siteName }}" style="max-width:160px;max-height:56px;height:auto;display:inline-block;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height:4px;background:#EE1B21;font-size:0;line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:32px 28px 12px;color:#2C2872;">
                            <h1 style="margin:0 0 8px;font-size:22px;line-height:1.3;">Your verification code</h1>
                            <p style="margin:0;font-size:15px;line-height:1.7;color:#555;">
                                Hello {{ $name }},
                            </p>
                            <p style="margin:12px 0 0;font-size:15px;line-height:1.7;color:#555;">
                                Use the one-time password below to verify your {{ $siteName }} account.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:20px 28px;">
                            <div style="display:inline-block;background:#f8f7ff;border:1px solid #d9d7ef;border-radius:12px;padding:18px 28px;">
                                <div style="font-size:12px;letter-spacing:1px;text-transform:uppercase;color:#6c68bf;font-weight:bold;margin-bottom:8px;">
                                    One-time password
                                </div>
                                <div style="font-size:36px;letter-spacing:10px;font-weight:700;color:#EE1B21;line-height:1.2;">
                                    {{ $otp }}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 8px;">
                            <p style="margin:0;font-size:14px;color:#555;text-align:center;line-height:1.6;">
                                This code expires in <strong>{{ $expiresInMinutes }} minutes</strong>
                                ({{ $expiresAt->timezone(config('app.timezone'))->format('d M Y, h:i A') }}).
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 28px 28px;">
                            <div style="background:#fff8e6;border:1px solid #ffe58f;border-radius:8px;padding:14px 16px;color:#8a6d3b;font-size:13px;line-height:1.6;">
                                <strong>Security notice:</strong>
                                Never share this OTP with anyone. {{ $siteName }} will never ask for your verification code by phone, email, or chat.
                            </div>
                            <p style="margin:18px 0 0;font-size:13px;color:#777;line-height:1.6;">
                                If you did not request this code, you can ignore this email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f7f6ff;padding:16px 28px;text-align:center;font-size:12px;color:#888;border-top:1px solid #eceaf8;">
                            © {{ date('Y') }} {{ $siteName }}. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
